<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\OfferClick;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
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
        ]);

        $params = array_filter([
            'from_date' => $validated['from_date'] ?? null,
            'to_date' => $validated['to_date'] ?? null,
            'pdf' => (int) ($validated['pdf'] ?? true),
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
        ];

        if ($asPdf) {
            $pdf = Pdf::loadView('accountant.invoice_pdf', $invoiceData)->setPaper('a4', 'portrait');
            return $pdf->stream("invoice-{$invoiceNumber}.pdf");
        }

        return view('accountant.invoice', $invoiceData);
    }
}
