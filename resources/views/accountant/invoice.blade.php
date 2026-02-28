@extends('layout.app')

@section('title', 'Invoice')

@section('content')
<div class="min-h-screen bg-gray-900 p-6">
    <div class="max-w-6xl mx-auto bg-gray-800 rounded-xl shadow-lg p-6 text-white">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-700 pb-4">
            <div>
                <h1 class="text-2xl font-bold text-yellow-500">Invoice</h1>
                <p class="text-sm text-gray-300 mt-1">Invoice No: {{ $invoiceNumber }}</p>
                <p class="text-sm text-gray-300">Invoice Date: {{ $invoiceDate->format('d M Y') }}</p>
            </div>

            <div class="text-sm text-gray-200">
                <p><span class="text-gray-400">Client:</span> {{ $invoiceUser->full_name }}</p>
                <p><span class="text-gray-400">Email:</span> {{ $invoiceUser->email }}</p>
                <p><span class="text-gray-400">Role:</span> {{ $invoiceUser->roleDetail->name ?? 'N/A' }}</p>
            </div>
        </div>

        <form method="GET" action="{{ route('accountant.invoice', $invoiceUser->id) }}" class="mt-6 flex flex-col md:flex-row gap-3 md:items-end">
            <div>
                <label class="block text-sm text-gray-300 mb-1">From Date</label>
                <input type="date" name="from_date" value="{{ $fromDate }}" class="bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
            </div>
            <div>
                <label class="block text-sm text-gray-300 mb-1">To Date</label>
                <input type="date" name="to_date" value="{{ $toDate }}" class="bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
            </div>
            <button type="submit" class="bg-yellow-600 hover:bg-yellow-500 text-white px-4 py-2 rounded font-semibold">Apply Filter</button>
            <a href="{{ route('accountant.invoice', $invoiceUser->id) }}" class="bg-gray-600 hover:bg-gray-500 text-white px-4 py-2 rounded font-semibold text-center">Reset</a>
        </form>

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full border border-gray-700 text-sm">
                <thead class="bg-gray-700 text-yellow-400">
                    <tr>
                        <th class="border border-gray-600 px-3 py-2 text-left">Offer</th>
                        <th class="border border-gray-600 px-3 py-2 text-right">Clicks</th>
                        <th class="border border-gray-600 px-3 py-2 text-right">Advertiser Rate</th>
                        <th class="border border-gray-600 px-3 py-2 text-right">Affiliate Rate</th>
                        <th class="border border-gray-600 px-3 py-2 text-right">Advertiser Amount</th>
                        <th class="border border-gray-600 px-3 py-2 text-right">Affiliate Amount</th>
                        <th class="border border-gray-600 px-3 py-2 text-right">Margin</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lineItems as $item)
                        <tr class="hover:bg-gray-700/50">
                            <td class="border border-gray-600 px-3 py-2">{{ $item->offer_title }}</td>
                            <td class="border border-gray-600 px-3 py-2 text-right">{{ $item->total_clicks }}</td>
                            <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($item->advertiser_rate, 2) }}</td>
                            <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($item->affiliate_rate, 2) }}</td>
                            <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($item->advertiser_amount, 2) }}</td>
                            <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($item->affiliate_amount, 2) }}</td>
                            <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($item->platform_margin, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border border-gray-600 px-3 py-5 text-center text-gray-300">
                                No billable click data found for this user in selected range.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-700 font-semibold">
                    <tr>
                        <td class="border border-gray-600 px-3 py-2">Total</td>
                        <td class="border border-gray-600 px-3 py-2 text-right">{{ $invoiceSummary['total_clicks'] }}</td>
                        <td class="border border-gray-600 px-3 py-2 text-right">-</td>
                        <td class="border border-gray-600 px-3 py-2 text-right">-</td>
                        <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($invoiceSummary['advertiser_total'], 2) }}</td>
                        <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($invoiceSummary['affiliate_total'], 2) }}</td>
                        <td class="border border-gray-600 px-3 py-2 text-right">Rs {{ number_format($invoiceSummary['platform_margin_total'], 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
