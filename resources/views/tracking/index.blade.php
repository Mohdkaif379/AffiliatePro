@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-900 p-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8
                border-b border-yellow-600/40 pb-4">
        <h1 class="text-3xl font-extrabold text-yellow-500 tracking-wide">
            📊 Offer Click Tracking
        </h1>
    </div>

    <!-- Table Card -->
    <div class="backdrop-blur-xl bg-white/5 border border-white/10
                rounded-2xl shadow-2xl overflow-x-auto">

        <table class="min-w-full text-sm text-gray-200">
            <thead class="sticky top-0 bg-black/80 backdrop-blur">
                <tr class="text-yellow-500 uppercase text-xs tracking-wider">
                    <th class="px-4 py-4 text-center">#</th>
                    <th class="px-4 py-4">Type</th>
                    <th class="px-4 py-4">Offer Title</th>
                    <th class="px-4 py-4">User</th>
                    <th class="px-4 py-4">IP Address</th>
                    <th class="px-4 py-4">User Agent</th>
                    <th class="px-4 py-4">Tracked At</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clicks as $click)
                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                    <td class="px-4 py-3 text-center text-gray-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3">
                        <span class="inline-flex items-center gap-2 px-3 py-1
                                     rounded-full text-xs font-bold
                            {{ $click->type == 'view'
                                ? 'bg-blue-500/20 text-blue-400'
                                : 'bg-green-500/20 text-green-400' }}">
                            {{ ucfirst($click->type) }}
                        </span>
                    </td>

                    <td class="px-4 py-3 font-semibold text-white">
                        {{ $click->offer ? $click->offer->offer_title : 'Page View' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $click->user->full_name }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $click->ip_address }}
                    </td>

                    <td class="px-4 py-3 break-all">
                        {{ $click->user_agent }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $click->created_at->format('d M Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-yellow-400">
                        🚫 No clicks tracked yet.
                        <div class="mt-2 text-sm text-gray-400">
                            Clicks will appear here when users click on offer URLs.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection
