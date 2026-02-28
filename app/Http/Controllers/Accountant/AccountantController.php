<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\OfferClick;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AccountantController extends Controller
{
    private function getBillableUsers()
    {
        return User::with('roleDetail')
            ->whereHas('roleDetail', function ($query) {
                $query->whereNotIn('name', ['Admin', 'Accountant']);
            })
            ->orderBy('full_name')
            ->get();
    }

    public function index()
    {
        $accountants = $this->getBillableUsers();

        return view('accountant.index', compact('accountants'));
    }

    public function billingForm()
    {
        $users = $this->getBillableUsers();

        return view('accountant.billing', compact('users'));
    }

    public function generateInvoiceFromForm(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'from_date' => ['nullable', 'date'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
            'pdf' => ['nullable', 'boolean'],
            'payment_method' => ['nullable', 'in:upi,cash,bank,card'],

            // UPI
            'upi_id' => ['nullable', 'string'],

            // Cash
            'cash_receipt' => ['nullable', 'string'],

            // Bank
            'bank_name' => ['nullable', 'string'],
            'bank_account' => ['nullable', 'string'],
            'bank_ifsc' => ['nullable', 'string'],

            // Card
            'card_name' => ['nullable', 'string'],
            'card_number' => ['nullable', 'string'],
            'card_exp_month' => ['nullable', 'string'],
            'card_exp_year' => ['nullable', 'string'],
            'card_cvv' => ['nullable', 'string'],
            'card_txn' => ['nullable', 'string'],
        ]);

        // Conditional validation for required fields based on payment method
        if (!empty($validated['payment_method'])) {
            switch ($validated['payment_method']) {
                case 'upi':
                    $request->validate(['upi_id' => ['required', 'string']]);
                    break;
                case 'cash':
                    $request->validate(['cash_receipt' => ['required', 'string']]);
                    break;
                case 'bank':
                    $request->validate([
                        'bank_name' => ['required', 'string'],
                        'bank_account' => ['required', 'string'],
                        'bank_ifsc' => ['required', 'string'],
                    ]);
                    break;
                case 'card':
                    $request->validate([
                        'card_name' => ['required', 'string'],
                        'card_number' => ['required', 'string', 'min:12', 'max:19'],
                        'card_exp_month' => ['required', 'string'],
                        'card_exp_year' => ['required', 'string'],
                        'card_cvv' => ['required', 'string', 'min:3', 'max:4'],
                    ]);

                    // Move CVV to session to avoid exposing it in URL
                    $cvv = $request->input('card_cvv');
                    if ($cvv) {
                        $request->session()->put('invoice_payment_cvv', $cvv);
                    }
                    break;
            }
        }

        // Build params for redirect but avoid sensitive fields (cvv)
        $params = array_filter([
            'from_date' => $validated['from_date'] ?? null,
            'to_date' => $validated['to_date'] ?? null,
            'pdf' => (int) ($validated['pdf'] ?? true),
            'payment_method' => $validated['payment_method'] ?? null,
            'upi_id' => $validated['upi_id'] ?? null,
            'cash_receipt' => $validated['cash_receipt'] ?? null,
            'bank_name' => $validated['bank_name'] ?? null,
            'bank_account' => $validated['bank_account'] ?? null,
            'bank_ifsc' => $validated['bank_ifsc'] ?? null,
            'card_name' => $validated['card_name'] ?? null,
            'card_number' => $validated['card_number'] ?? null,
            'card_exp_month' => $validated['card_exp_month'] ?? null,
            'card_exp_year' => $validated['card_exp_year'] ?? null,
            'card_txn' => $validated['card_txn'] ?? null,
        ]);

        return redirect()->route('accountant.invoice', [
            'user' => $validated['user_id'],
            ...$params,
        ]);
    }

    public function generateInvoice(Request $request, User $user)
    {
        $validated = $request->validate([
            'from_date' => ['nullable', 'date'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
            'pdf' => ['nullable', 'boolean'],
        ]);
        // Accept payment fields from query (non-sensitive) and CVV from session
        $paymentMethod = $request->input('payment_method');
        $payment = [];
        if ($paymentMethod) {
            $payment = $request->only([
                'payment_method', 'upi_id', 'cash_receipt',
                'bank_name', 'bank_account', 'bank_ifsc',
                'card_name', 'card_number', 'card_exp_month', 'card_exp_year', 'card_txn'
            ]);

            // Attach CVV from session if present (and then forget it)
            $cvv = $request->session()->pull('invoice_payment_cvv');
            if ($cvv) {
                $payment['card_cvv'] = $cvv;
            }
        }

        $fromDate = $validated['from_date'] ?? null;
        $toDate = $validated['to_date'] ?? null;
        $asPdf = (bool) ($validated['pdf'] ?? false);

        $lineItemsQuery = OfferClick::query()
            ->join('offers', 'offers.id', '=', 'offer_clicks.offer_id')
            ->where('offer_clicks.user_id', $user->id)
            ->where('offer_clicks.type', 'click')
            ->selectRaw('
                offers.id as offer_id,
                offers.offer_title,
                COALESCE(offers.advertiser_price, 0) as advertiser_rate,
                COALESCE(offers.affiliate_price, 0) as affiliate_rate,
                COUNT(*) as total_clicks
            ')
            ->groupBy('offers.id', 'offers.offer_title', 'offers.advertiser_price', 'offers.affiliate_price')
            ->orderBy('offers.offer_title');

        if ($fromDate) {
            $lineItemsQuery->whereDate('offer_clicks.created_at', '>=', Carbon::parse($fromDate)->startOfDay());
        }

        if ($toDate) {
            $lineItemsQuery->whereDate('offer_clicks.created_at', '<=', Carbon::parse($toDate)->endOfDay());
        }

        $lineItems = $lineItemsQuery->get()->map(function ($item) {
            $clicks = (int) $item->total_clicks;
            $advertiserRate = (float) $item->advertiser_rate;
            $affiliateRate = (float) $item->affiliate_rate;

            $item->advertiser_amount = $clicks * $advertiserRate;
            $item->affiliate_amount = $clicks * $affiliateRate;
            $item->platform_margin = $item->advertiser_amount - $item->affiliate_amount;

            return $item;
        });

        $invoiceSummary = [
            'total_clicks' => $lineItems->sum('total_clicks'),
            'advertiser_total' => $lineItems->sum('advertiser_amount'),
            'affiliate_total' => $lineItems->sum('affiliate_amount'),
            'platform_margin_total' => $lineItems->sum('platform_margin'),
        ];

        $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        $invoiceData = [
            'invoiceUser' => $user,
            'lineItems' => $lineItems,
            'invoiceSummary' => $invoiceSummary,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'invoiceNumber' => $invoiceNumber,
            'invoiceDate' => now(),
            'payment' => $payment,
        ];

        if ($asPdf) {
            $pdf = Pdf::loadView('accountant.invoice_pdf', $invoiceData)->setPaper('a4', 'portrait');
            return $pdf->stream("invoice-{$invoiceNumber}.pdf");
        }

        return view('accountant.invoice', $invoiceData);
    }

    /**
     * Generate invoice using headless Chrome (Browsershot) for full CSS support.
     */
    public function generateInvoiceBrowsershot(Request $request, User $user)
    {
        $validated = $request->validate([
            'from_date' => ['nullable', 'date'],
            'to_date' => ['nullable', 'date', 'after_or_equal:from_date'],
        ]);

        $fromDate = $validated['from_date'] ?? null;
        $toDate = $validated['to_date'] ?? null;

        $lineItemsQuery = OfferClick::query()
            ->join('offers', 'offers.id', '=', 'offer_clicks.offer_id')
            ->where('offer_clicks.user_id', $user->id)
            ->where('offer_clicks.type', 'click')
            ->selectRaw('
                offers.id as offer_id,
                offers.offer_title,
                COALESCE(offers.advertiser_price, 0) as advertiser_rate,
                COALESCE(offers.affiliate_price, 0) as affiliate_rate,
                COUNT(*) as total_clicks
            ')
            ->groupBy('offers.id', 'offers.offer_title', 'offers.advertiser_price', 'offers.affiliate_price')
            ->orderBy('offers.offer_title');

        if ($fromDate) {
            $lineItemsQuery->whereDate('offer_clicks.created_at', '>=', Carbon::parse($fromDate)->startOfDay());
        }

        if ($toDate) {
            $lineItemsQuery->whereDate('offer_clicks.created_at', '<=', Carbon::parse($toDate)->endOfDay());
        }

        $lineItems = $lineItemsQuery->get()->map(function ($item) {
            $clicks = (int) $item->total_clicks;
            $advertiserRate = (float) $item->advertiser_rate;
            $affiliateRate = (float) $item->affiliate_rate;

            $item->advertiser_amount = $clicks * $advertiserRate;
            $item->affiliate_amount = $clicks * $affiliateRate;
            $item->platform_margin = $item->advertiser_amount - $item->affiliate_amount;

            return $item;
        });

        $invoiceSummary = [
            'total_clicks' => $lineItems->sum('total_clicks'),
            'advertiser_total' => $lineItems->sum('advertiser_amount'),
            'affiliate_total' => $lineItems->sum('affiliate_amount'),
            'platform_margin_total' => $lineItems->sum('platform_margin'),
        ];

        $invoiceNumber = 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

        $invoiceData = [
            'invoiceUser' => $user,
            'lineItems' => $lineItems,
            'invoiceSummary' => $invoiceSummary,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'invoiceNumber' => $invoiceNumber,
            'invoiceDate' => now(),
        ];

        $html = view('accountant.invoice_pdf', $invoiceData)->render();

        $pdfBinary = Browsershot::html($html)
            ->showBackground()
            ->format('A4')
            ->pdf();

        return response($pdfBinary, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"invoice-{$invoiceNumber}.pdf\"",
        ]);
    }
}
