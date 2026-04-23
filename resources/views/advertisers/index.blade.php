@extends('layout.app')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-8">

    <!-- Header -->
    <div class="mb-8 flex flex-col items-start justify-between border-b border-slate-200 pb-4 md:flex-row md:items-center">
        <h1 class="flex items-center gap-3 text-3xl font-extrabold tracking-wide text-slate-900">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm">
                <i class="fas fa-bullhorn"></i>
            </span>
            Advertisers List
        </h1>
    </div>

    <!-- Table Card -->
    <div class="max-h-96 overflow-x-auto overflow-y-auto rounded-3xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full text-sm text-slate-700">
            <thead class="sticky top-0 bg-slate-50">
                <tr class="text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-4 py-4 text-center">#</th>
                    <th class="px-4 py-4">Name</th>
                    <th class="px-4 py-4">Email</th>
                    <th class="px-4 py-4">Role</th>
                    <th class="px-4 py-4">Created At</th>
                    <th class="px-4 py-4 text-center">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($advertisers as $advertiser)
                <tr class="border-b border-slate-100 transition hover:bg-slate-50">
                    <td class="px-4 py-3 text-center text-slate-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-slate-900">
                        {{ $advertiser->full_name }}
                    </td>

                    <td class="px-4 py-3 text-slate-600">
                        {{ $advertiser->email }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-slate-700">
                        {{ $advertiser->roleDetail->name }}
                    </td>

                    <td class="px-4 py-3 text-slate-500">
                        {{ $advertiser->created_at->format('d M Y, H:i') }}
                    </td>

                    <td class="px-4 py-3 text-center">
                        <span class="inline-flex rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                            {{ $advertiser->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-slate-500">
                        No advertisers found.
                        <div class="mt-2 text-sm text-slate-400">
                            Advertisers will appear here.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>
@endsection
