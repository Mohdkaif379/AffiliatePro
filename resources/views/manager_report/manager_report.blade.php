@extends('layout.app')

@section('title', 'Manager Report')

@section('conten<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-6xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="flex items-center gap-2 text-3xl font-bold text-slate-900">
                    <i class="fa fa-chart-bar text-slate-700"></i> Manager Report
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Performance summary by manager and offer.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="w-full border-collapse text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Sr No.</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Manager Name</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Offer Name</th>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">Total Clicks</th>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">Total Views</th>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">Total Conversions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @php $srNo = 1; @endphp
                    @forelse($reports as $userId => $offers)
                        @foreach($offers as $offerId => $rows)
                            @php
                                $clicks = $rows->where('type', 'click')->first()->total ?? 0;
                                $views = $rows->where('type', 'view')->first()->total ?? 0;
                                $conversions = $rows->where('type', 'conversion')->first()->total ?? 0;
                                $offerName = $rows->first()->offer->offer_title ?? 'N/A';
                            @endphp
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-4 text-slate-500">{{ $srNo++ }}</td>
                                <td class="px-4 py-4 font-medium text-slate-900">{{ $rows->first()->user->full_name ?? 'N/A' }}</td>
                                <td class="px-4 py-4 text-slate-700">{{ $offerName }}</td>
                                <td class="px-4 py-4 text-center font-semibold text-emerald-600">{{ $clicks }}</td>
                                <td class="px-4 py-4 text-center font-semibold text-sky-600">{{ $views }}</td>
                                <td class="px-4 py-4 text-center font-semibold text-indigo-600">{{ $conversions }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                                No data found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <a href="{{ url()->previous() }}"
               class="inline-flex items-center rounded-lg border border-slate-300 bg-white px-4 py-2 font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
               <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>
mr-2"></i> Back
            </a>
        </div>

    </div>

</div>
@endsection
