@extends('layout.app')

@section('title','Analytics')

@section('content')
<div class="min-h-screen bg-gray-900 p-6">

    <h1 class="text-3xl font-bold text-yellow-500 mb-6 flex items-center gap-2">
        <i class="fa fa-chart-bar"></i> Analytics Report
    </h1>

    <!-- Filter Card -->
    <div class="bg-gray-800 p-4 rounded-xl shadow mb-6">
        <form method="GET" action="{{ route('analytics.index') }}"
              class="flex flex-col md:flex-row gap-4 items-center">

            <span class="text-white font-semibold">Filter</span>

            <!-- User Dropdown -->
            <select name="user_id"
                onchange="this.form.submit()"
                class="bg-gray-600 text-yellow-400 border border-yellow-500 p-2 rounded-lg">
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
                class="bg-gray-600 text-yellow-400 border border-yellow-500 p-2 rounded-lg">
                <option value="">Select Offer</option>
                @foreach($offers as $offer)
                    <option value="{{ $offer->id }}" {{ isset($offerId) && $offerId==$offer->id?'selected':'' }}>
                        {{ $offer->offer_title }}
                    </option>
                @endforeach
            </select>

            <!-- Reset Button -->
            <a href="{{ route('analytics.index') }}"
               class="bg-gray-600 hover:bg-gray-600 text-yellow-400 px-4 py-2 rounded-lg ">
                Reset
            </a>

        </form>
    </div>

    <!-- Bar Chart Card -->
    <div class="bg-gray-800 p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold text-yellow-400 mb-4">
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
                labels: { color: 'white', font: { size: 14 } }
            }
        },
        scales: {
            x: {
                ticks: { color: 'white' },
                grid: { color: '#374151' }
            },
            y: {
                beginAtZero: true,
                ticks: { color: 'white' },
                grid: { color: '#374151' }
            }
        }
    }
});
</script>
@endsection
