@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-900 p-4 md:p-6">

    <!-- Heading -->
    <h1 class="text-3xl font-bold text-yellow-500 mb-6 flex items-center gap-2">
        <i class="fa fa-chart-line"></i> Dashboard Analytics
    </h1>

    <!-- Filter Card -->
    <div class="bg-gray-800 p-3 md:p-4 rounded-xl shadow mb-6">
        <form method="GET" action="{{ route('dashboard') }}"
              class="flex flex-col md:flex-row gap-4 items-center">

            <span class="text-white font-semibold">Filter Report</span>

            <!-- Dropdown Filter -->
            <select name="filter"
                class="bg-gray-600 text-yellow-400 border border-yellow-500 p-2 rounded-lg">
                <option value="today" {{ $filter=='today'?'selected':'' }}>Today</option>
                <option value="weekly" {{ $filter=='weekly'?'selected':'' }}>Weekly</option>
                <option value="monthly" {{ $filter=='monthly'?'selected':'' }}>Monthly</option>
                <option value="yearly" {{ $filter=='yearly'?'selected':'' }}>Yearly</option>
            </select>

            <!-- From Date -->
            <input type="date" name="from_date"
                   value="{{ $fromDate ?? '' }}"
                   class="bg-gray-600 text-yellow-400 border border-yellow-500 p-2 rounded-lg">

            <!-- To Date -->
            <input type="date" name="to_date"
                   value="{{ $toDate ?? '' }}"
                   class="bg-gray-600 text-yellow-400 border border-yellow-500 p-2 rounded-lg">

            <!-- Submit Button -->
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-semibold">
                Apply
            </button>

            <!-- Reset Button -->
            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold">Reset</a>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">

        <div class="bg-gradient-to-r from-green-600 to-green-400 p-4 md:p-5 rounded-xl shadow text-white">
            <h3 class="text-lg">Total Clicks</h3>
            <p class="text-3xl font-bold">{{ $clickCount }}</p>
        </div>

        <div class="bg-gradient-to-r from-blue-600 to-blue-400 p-4 md:p-5 rounded-xl shadow text-white">
            <h3 class="text-lg">Total Views</h3>
            <p class="text-3xl font-bold">{{ $viewCount }}</p>
        </div>

        <div class="bg-gradient-to-r from-purple-600 to-purple-400 p-4 md:p-5 rounded-xl shadow text-white">
            <h3 class="text-lg">Total Conversions</h3>
            <p class="text-3xl font-bold">{{ $conversionCount }}</p>
        </div>

    </div>

    <!-- Chart Card -->
    <div class="bg-gray-800 p-4 md:p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold text-yellow-400 mb-4">
            Clicks vs Views vs Conversions
        </h2>
        <canvas id="lineChart" height="120"></canvas>
    </div>

</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const clickCount = {{ $clickCount }};
const viewCount  = {{ $viewCount }};
const conversionCount = {{ $conversionCount }};

const ctx = document.getElementById('lineChart').getContext('2d');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Clicks', 'Views', 'Conversions'],
        datasets: [
            {
                label: 'Clicks',
                data: [clickCount, 0, 0],
                borderColor: '#22c55e',
                backgroundColor: 'rgba(34,197,94,0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointBackgroundColor: '#22c55e'
            },
            {
                label: 'Views',
                data: [0, viewCount, 0],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointBackgroundColor: '#3b82f6'
            },
            {
                label: 'Conversions',
                data: [0, 0, conversionCount],
                borderColor: '#a855f7',
                backgroundColor: 'rgba(168,85,247,0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 6,
                pointBackgroundColor: '#a855f7'
            }
        ]
    },
    options: {
        plugins: {
            legend: {
                labels: {
                    color: 'white',
                    font: { size: 14 }
                }
            }
        },
        scales: {
            x: {
                ticks: { color: 'white' },
                grid: { color: '#374151' }
            },
            y: {
                ticks: { color: 'white' },
                grid: { color: '#374151' }
            }
        }
    }
});
</script>
@endsection
