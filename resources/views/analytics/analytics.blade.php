@extends('layout.app')

@section('title','Analytics')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-6">

    <div class="mb-6 flex items-center gap-3 border-b border-slate-200 pb-4">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm">
            <i class="fa fa-chart-bar"></i>
        </span>
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Analytics Report</h1>
            <p class="mt-1 text-sm text-slate-500">Filter by user or offer and compare clicks, views, and conversions.</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="mb-6 rounded-3xl border border-slate-200 bg-white p-4 shadow-sm">
        <form method="GET" action="{{ route('analytics.index') }}"
              class="flex flex-col gap-4 md:flex-row md:flex-wrap md:items-center">

            <span class="font-semibold text-slate-700">Filter</span>

            <!-- User Dropdown -->
            <select name="user_id"
                onchange="this.form.submit()"
                class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($userId) && $userId==$user->id?'selected':'' }}>
                        {{ $user->full_name }}
                    </option>
                @endforeach
            </select>

            <!-- Offer Dropdown -->
            <select name="offer_id"
                onchange="this.form.submit()"
                class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                <option value="">Select Offer</option>
                @foreach($offers as $offer)
                    <option value="{{ $offer->id }}" {{ isset($offerId) && $offerId==$offer->id?'selected':'' }}>
                        {{ $offer->offer_title }}
                    </option>
                @endforeach
            </select>

            <!-- Reset Button -->
            <a href="{{ route('analytics.index') }}"
               class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-slate-700 transition hover:bg-slate-50">
                Reset
            </a>
        </form>
    </div>

    <!-- Bar Chart Card -->
    <div class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:p-6">
        <h2 class="mb-4 text-xl font-semibold text-slate-900">
            Click / View / Conversion Analytics
        </h2>

        <div class="h-64">
            <canvas id="barChart"></canvas>
        </div>
    </div>

</div>

<!-- Chart JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = ['Clicks', 'Views', 'Conversions'];

const dataValues = [
    @json(array_sum($clickValues ?? [])),
    @json(array_sum($viewValues ?? [])),
    @json(array_sum($conversionValues ?? []))
];

const ctx = document.getElementById('barChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Analytics Data',
            data: dataValues,
            backgroundColor: ['#22c55e', '#3b82f6', '#a855f7'],
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: { color: '#334155', font: { size: 14 } }
            }
        },
        scales: {
            x: {
                ticks: { color: '#64748b' },
                grid: { color: '#e2e8f0' }
            },
            y: {
                beginAtZero: true,
                ticks: { color: '#64748b' },
                grid: { color: '#e2e8f0' }
            }
        }
    }
});
</script>
@endsection
