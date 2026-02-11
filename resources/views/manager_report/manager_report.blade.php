@extends('layout.app')

@section('title', 'Manager Report')

@section('content')
<div class="min-h-screen bg-gray-900 p-8">

    <div class="max-w-5xl mx-auto bg-gray-800 p-6 rounded-xl shadow-lg text-white">

        <!-- Heading -->
        <h2 class="text-2xl font-bold mb-6 text-yellow-500">
            <i class="fa fa-chart-bar mr-2"></i> Manager Report
        </h2>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-600 text-sm">
                <thead class="bg-gray-700 text-yellow-400">
                    <tr>
                        <th class="border border-gray-600 px-4 py-2">Sr No.</th>
                        <th class="border border-gray-600 px-4 py-2">Manager Name</th>
                        <th class="border border-gray-600 px-4 py-2">Offer Name</th>
                        <th class="border border-gray-600 px-4 py-2">Total Clicks</th>
                        <th class="border border-gray-600 px-4 py-2">Total Views</th>
                            <th class="border border-gray-600 px-4 py-2">Total Conversions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $srNo = 1; @endphp
                    @forelse($reports as $userId => $offers)
                        @foreach($offers as $offerId => $rows)
                            @php
                                $clicks = $rows->where('type', 'click')->first()->total ?? 0;
                                $views  = $rows->where('type', 'view')->first()->total ?? 0;
                                $conversions  = $rows->where('type', 'conversion')->first()->total ?? 0;
                                $offerName = $rows->first()->offer->offer_title ?? 'N/A';
                            @endphp
                            <tr class="text-center hover:bg-gray-700">
                                <td class="border border-gray-600 px-4 py-2">{{ $srNo++ }}</td>
                                <td class="border border-gray-600 px-4 py-2">{{ $rows->first()->user->full_name ?? 'N/A' }}</td>
                                <td class="border border-gray-600 px-4 py-2">{{ $offerName }}</td>
                                <td class="border border-gray-600 px-4 py-2 text-green-400 font-bold">{{ $clicks }}</td>
                                <td class="border border-gray-600 px-4 py-2 text-blue-400 font-bold">{{ $views }}</td>
                                  <td class="border border-gray-600 px-4 py-2 text-blue-400 font-bold">{{ $conversions }}</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5" class="border border-gray-600 px-4 py-3 text-center text-red-400">
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
               class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-500">
               <i class="fa fa-arrow-left mr-2"></i> Back
            </a>
        </div>

    </div>

</div>
@endsection
