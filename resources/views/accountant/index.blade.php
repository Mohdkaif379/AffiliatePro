@extends('layout.app')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-8">
    <div class="mb-8 flex flex-col items-start justify-between border-b border-slate-200 pb-4 md:flex-row md:items-center">
        <div>
            <h1 class="flex items-center gap-2 text-3xl font-extrabold tracking-wide text-slate-900">
                <i class="fas fa-file-invoice-dollar text-slate-700"></i> Accountant Dashboard
            </h1>
            <p class="mt-2 text-sm text-slate-500">Invoice-ready overview of user billing and account activity.</p>
        </div>
    </div>

    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white shadow-sm">
        <table class="min-w-full text-sm text-slate-700">
            <thead class="sticky top-0 bg-slate-50">
                <tr class="text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-4 py-4 text-center">#</th>
                    <th class="px-4 py-4">Name</th>
                    <th class="px-4 py-4">Email</th>
                    <th class="px-4 py-4">Mobile</th>
                    <th class="px-4 py-4">Role</th>
                    <th class="px-4 py-4 text-center">Status</th>
                    <th class="px-4 py-4 text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($accountants as $user)
                <tr class="border-b border-slate-100 transition hover:bg-slate-50">
                    <td class="px-4 py-3 text-center text-slate-400">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-semibold text-slate-900">{{ $user->full_name }}</td>
                    <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                    <td class="px-4 py-3 text-slate-600">{{ $user->mobile_no ?? '—' }}</td>
                    <td class="px-4 py-3 font-medium text-slate-700">{{ $user->roleDetail ? ucfirst($user->roleDetail->name) : '—' }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="inline-flex rounded-full border px-3 py-1 text-xs font-semibold
                            {{ $user->status == 'active'
                                ? 'border-emerald-200 bg-emerald-50 text-emerald-700'
                                : 'border-rose-200 bg-rose-50 text-rose-700' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('accountant.invoice', $user->id) }}"
                           class="inline-flex items-center rounded-xl bg-slate-900 px-3 py-1 text-xs font-semibold text-white transition hover:bg-slate-800">
                            View Invoice
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-10 text-center text-slate-500">
                        No users found.
                        <div class="mt-2 text-sm text-slate-400">Add a user to generate invoices.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
