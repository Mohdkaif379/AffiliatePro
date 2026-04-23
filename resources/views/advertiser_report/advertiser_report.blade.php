@extends('layout.app')

@section('title', 'Advertiser Report')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-8">

    <div class="mx-auto max-w-5xl rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:p-6">

        <!-- Heading -->
        <div class="mb-6 border-b border-slate-200 pb-4">
            <h2 class="text-2xl font-bold text-slate-900">
                <i class="fa fa-chart-bar mr-2 text-slate-700"></i> Advertiser Report
            </h2>
            <p class="mt-2 text-sm text-slate-500">Aggregated clicks, views, and conversions by advertiser and offer.</p>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-2xl border border-slate-200">
            <table class="w-full border-collapse text-sm text-slate-700">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="border border-slate-200 px-4 py-3">Sr No.</th>
                        <th class="border border-slate-200 px-4 py-3">Advertiser Name</th>
                        <th class="border border-slate-200 px-4 py-3">Offer Name</th>
                        <th class="border border-slate-200 px-4 py-3">Total Clicks</th>
                        <th class="border border-slate-200 px-4 py-3">Total Views</th>
                        <th class="border border-slate-200 px-4 py-3">Total Conversions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $srNo = 1; @endphp
                    @forelse($reports as $userId => $offers)
                    @foreach($offers as $offerId => $rows)
                    @php
                    $clicks = $rows->where('type', 'click')->first()->total ?? 0;
                    $views = $rows->where('type', 'view')->first()->total ?? 0;
                    $conversions = $rows->where('type', 'conversion')->first()->total ?? 0;
                    $offerName = $rows->first()->offer->offer_title ?? 'N/A';
                    @endphp
                    <tr class="text-center transition hover:bg-slate-50">
                        <td class="border border-slate-200 px-4 py-2 text-slate-400">{{ $srNo++ }}</td>
                        <td class="border border-slate-200 px-4 py-2 text-slate-700">{{ $rows->first()->user->full_name ?? 'N/A' }}</td>
                        <td class="border border-slate-200 px-4 py-2 text-slate-700">{{ $offerName }}</td>
                        <td class="border border-slate-200 px-4 py-2 font-bold text-emerald-600">{{ $clicks }}</td>
                        <td class="border border-slate-200 px-4 py-2 font-bold text-blue-600">{{ $views }}</td>
                        <td class="border border-slate-200 px-4 py-2 font-bold text-violet-600">{{ $conversions }}</td>
                    </tr>
                    @endforeach
                    @empty
                    <tr>
                        <td colspan="6" class="border border-slate-200 px-4 py-6 text-center text-slate-500">
                            No data found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center rounded-xl bg-slate-900 px-4 py-2 text-white transition hover:bg-slate-800">
                <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
        </div>

    </div>

</div>
@endsection
