@extends('layout.app')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-6xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="flex items-center gap-2 text-3xl font-bold text-slate-900">
                    <i class="fas fa-id-badge text-slate-700"></i>
                    HRS List
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    View HR details in a clean light layout.
                </p>
            </div>
        </div>

        <div class="max-h-[28rem] overflow-x-auto overflow-y-auto rounded-xl border border-slate-200">
            <table class="min-w-full border-collapse text-sm">
                <thead class="sticky top-0 bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">#</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Name</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Email</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Role</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Created At</th>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($hrs as $hr)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-4 text-center text-slate-500">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-4 py-4 font-semibold text-slate-900">
                            {{ $hr->full_name }}
                        </td>

                        <td class="px-4 py-4 text-slate-600">
                            {{ $hr->email }}
                        </td>

                        <td class="px-4 py-4 font-medium text-slate-700">
                            {{ $hr->roleDetail->name }}
                        </td>

                        <td class="px-4 py-4 text-slate-500">
                            {{ $hr->created_at->format('d M Y, H:i') }}
                        </td>

                        <td class="px-4 py-4 text-center">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                {{ strtolower($hr->status) === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-700' }}">
                                {{ $hr->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-slate-500">
                            No hrs found.
                            <div class="mt-2 text-sm text-slate-400">
                                hrs will appear here.
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
