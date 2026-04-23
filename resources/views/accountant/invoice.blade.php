@extends('layout.app')

@section('title', 'Invoice')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-6">
    <div class="mx-auto max-w-6xl rounded-3xl border border-slate-200 bg-white p-4 text-slate-700 shadow-sm md:p-6">
        <div class="flex flex-col gap-4 border-b border-slate-200 pb-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Invoice</h1>
                <p class="mt-1 text-sm text-slate-500">Invoice No: {{ $invoiceNumber }}</p>
                <p class="text-sm text-slate-500">Invoice Date: {{ $invoiceDate->format('d M Y') }}</p>
            </div>

            <div class="text-sm text-slate-600">
                <p><span class="text-slate-400">Client:</span> {{ $invoiceUser->full_name }}</p>
                <p><span class="text-slate-400">Email:</span> {{ $invoiceUser->email }}</p>
                <p><span class="text-slate-400">Role:</span> {{ $invoiceUser->roleDetail->name ?? 'N/A' }}</p>
            </div>
        </div>

        <form method="GET" action="{{ route('accountant.invoice', $invoiceUser->id) }}" class="mt-6 flex flex-col gap-3 md:flex-row md:items-end">
            <div>
                <label class="mb-1 block text-sm text-slate-600">From Date</label>
                <input type="date" name="from_date" value="{{ $fromDate }}" class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
            </div>
            <div>
                <label class="mb-1 block text-sm text-slate-600">To Date</label>
                <input type="date" name="to_date" value="{{ $toDate }}" class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
            </div>
            <button type="submit" class="rounded-xl bg-slate-900 px-4 py-2 font-semibold text-white transition hover:bg-slate-800">Apply Filter</button>
            <a href="{{ route('accountant.invoice', $invoiceUser->id) }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-center font-semibold text-slate-700 transition hover:bg-slate-50">Reset</a>
        </form>

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full border border-slate-200 text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="border border-slate-200 px-3 py-2 text-left">Offer</th>
                        <th class="border border-slate-200 px-3 py-2 text-right">Clicks</th>
                        <th class="border border-slate-200 px-3 py-2 text-right">Advertiser Rate</th>
                        <th class="border border-slate-200 px-3 py-2 text-right">Affiliate Rate</th>
                        <th class="border border-slate-200 px-3 py-2 text-right">Advertiser Amount</th>
                        <th class="border border-slate-200 px-3 py-2 text-right">Affiliate Amount</th>
                        <th class="border border-slate-200 px-3 py-2 text-right">Margin</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700">
                    @forelse($lineItems as $item)
                        <tr class="transition hover:bg-slate-50">
                            <td class="border border-slate-200 px-3 py-2">{{ $item->offer_title }}</td>
                            <td class="border border-slate-200 px-3 py-2 text-right">{{ $item->total_clicks }}</td>
                            <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($item->advertiser_rate, 2) }}</td>
                            <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($item->affiliate_rate, 2) }}</td>
                            <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($item->advertiser_amount, 2) }}</td>
                            <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($item->affiliate_amount, 2) }}</td>
                            <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($item->platform_margin, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border border-slate-200 px-3 py-5 text-center text-slate-500">
                                No billable click data found for this user in selected range.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-slate-50 font-semibold text-slate-700">
                    <tr>
                        <td class="border border-slate-200 px-3 py-2">Total</td>
                        <td class="border border-slate-200 px-3 py-2 text-right">{{ $invoiceSummary['total_clicks'] }}</td>
                        <td class="border border-slate-200 px-3 py-2 text-right">-</td>
                        <td class="border border-slate-200 px-3 py-2 text-right">-</td>
                        <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($invoiceSummary['advertiser_total'], 2) }}</td>
                        <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($invoiceSummary['affiliate_total'], 2) }}</td>
                        <td class="border border-slate-200 px-3 py-2 text-right">Rs {{ number_format($invoiceSummary['platform_margin_total'], 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
