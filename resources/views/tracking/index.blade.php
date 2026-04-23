@extends('layout.app')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-7xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Offer Click Tracking
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Monitor page views, clicks, and user activity in one place.
                </p>
            </div>
            <div class="inline-flex items-center rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700">
                Total Clicks: {{ $clicks->count() }}
            </div>
        </div>

        <div class="max-h-[32rem] overflow-x-auto overflow-y-auto rounded-xl border border-slate-200 shadow-sm">
            <table class="min-w-full border-collapse text-sm">
                <thead class="sticky top-0 bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">#</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Type</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Offer Title</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">User</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">IP Address</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">User Agent</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Tracked At</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($clicks as $click)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-4 text-center text-slate-500">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-4 py-4">
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                {{ $click->type == 'view' ? 'bg-sky-100 text-sky-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ ucfirst($click->type) }}
                            </span>
                        </td>

                        <td class="px-4 py-4 font-semibold text-slate-900">
                            {{ $click->offer ? $click->offer->offer_title : 'Page View' }}
                        </td>

                        <td class="px-4 py-4 text-slate-600">
                            {{ $click->user->full_name }}
                        </td>

                        <td class="px-4 py-4 text-slate-600">
                            {{ $click->ip_address }}
                        </td>

                        <td class="px-4 py-4 break-all text-slate-600">
                            {{ $click->user_agent }}
                        </td>

                        <td class="px-4 py-4 text-slate-500">
                            {{ $click->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-slate-500">
                            No clicks tracked yet.
                            <div class="mt-2 text-sm text-slate-400">
                                Clicks will appear here when users click on offer URLs.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
