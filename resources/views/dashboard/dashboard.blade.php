@extends('layout.app')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-6">

    <!-- Heading -->
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h1 class="flex items-center gap-3 text-3xl font-bold text-slate-900">
                <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm">
                    <i class="fa fa-chart-line"></i>
                </span>
                Dashboard Analytics
            </h1>
            <p class="mt-2 text-sm text-slate-500">Overview of clicks, views and conversions.</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <form method="GET" action="{{ route('dashboard') }}"
              class="flex flex-col gap-4 md:flex-row md:flex-wrap md:items-end">

            <span class="font-semibold text-slate-700">Filter Report</span>

            <!-- Dropdown Filter -->
            <select name="filter"
                class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                <option value="today" {{ $filter=='today'?'selected':'' }}>Today</option>
                <option value="weekly" {{ $filter=='weekly'?'selected':'' }}>Weekly</option>
                <option value="monthly" {{ $filter=='monthly'?'selected':'' }}>Monthly</option>
                <option value="yearly" {{ $filter=='yearly'?'selected':'' }}>Yearly</option>
            </select>

            <!-- From Date -->
            <input type="date" name="from_date"
                   value="{{ $fromDate ?? '' }}"
                   class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">

            <!-- To Date -->
            <input type="date" name="to_date"
                   value="{{ $toDate ?? '' }}"
                   class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">

            <!-- Submit Button -->
            <button type="submit"
                class="rounded-xl bg-slate-900 px-4 py-2 font-semibold text-white transition hover:bg-slate-800">
                Apply
            </button>

            <!-- Reset Button -->
            <a href="{{ route('dashboard') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 font-semibold text-slate-700 transition hover:bg-slate-50">Reset</a>
        </form>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">

        <div class="rounded-2xl border border-emerald-100 bg-white p-4 md:p-5 shadow-sm">
            <h3 class="text-sm font-medium text-slate-500">Total Clicks</h3>
            <p class="mt-2 text-3xl font-bold text-emerald-600">{{ $clickCount }}</p>
        </div>

        <div class="rounded-2xl border border-blue-100 bg-white p-4 md:p-5 shadow-sm">
            <h3 class="text-sm font-medium text-slate-500">Total Views</h3>
            <p class="mt-2 text-3xl font-bold text-blue-600">{{ $viewCount }}</p>
        </div>

        <div class="rounded-2xl border border-violet-100 bg-white p-4 md:p-5 shadow-sm">
            <h3 class="text-sm font-medium text-slate-500">Total Conversions</h3>
            <p class="mt-2 text-3xl font-bold text-violet-600">{{ $conversionCount }}</p>
        </div>

    </div>

    <!-- Chart Card -->
    <div class="rounded-2xl border border-slate-200 bg-white p-4 md:p-6 shadow-sm">
        <h2 class="mb-4 text-xl font-semibold text-slate-900">
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
                    color: '#334155',
                    font: { size: 14 }
                }
            }
        },
        scales: {
            x: {
                ticks: { color: '#64748b' },
                grid: { color: '#e2e8f0' }
            },
            y: {
                ticks: { color: '#64748b' },
                grid: { color: '#e2e8f0' }
            }
        }
    }
});
</script>
@endsection
