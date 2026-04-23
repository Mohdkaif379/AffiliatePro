@extends('layout.app')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-8">

    <!-- Header -->
    <div class="mb-8 flex flex-col items-start justify-between border-b border-slate-200 pb-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-3xl font-extrabold tracking-wide text-slate-900">
                <i class="fas fa-users mr-2 text-slate-700"></i> All Users
            </h1>
            <p class="mt-2 text-sm text-slate-500">Manage users, roles, and access from one place.</p>
        </div>

        <a href="{{ route('admin.create') }}"
            class="mt-4 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-2 font-bold text-white shadow-sm transition hover:bg-slate-800 md:mt-0">
            + Create New User
        </a>
    </div>

    <!-- Success and Error Messages -->
    @if(session('success'))
    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-700">
        There were some errors:
        <ul class="mt-2 list-inside list-disc">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Table Card -->
    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full text-sm text-slate-700">
            <thead class="sticky top-0 bg-slate-50">
                <tr class="text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-2 py-2 text-center md:px-4 md:py-4">#</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Full Name</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Email</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Mobile</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Role</th>
                    <th class="px-2 py-2 text-center md:px-4 md:py-4">Status</th>
                    <th class="px-2 py-2 text-center md:px-4 md:py-4">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr class="border-b border-slate-100 transition hover:bg-slate-50">
                    <td class="px-2 py-2 text-center text-slate-400 md:px-4 md:py-3">{{ $loop->iteration }}</td>

                    <td class="px-2 py-2 font-semibold text-slate-900 md:px-4 md:py-3">{{ $user->full_name }}</td>
                    <td class="px-2 py-2 text-slate-600 md:px-4 md:py-3">{{ $user->email }}</td>
                    <td class="px-2 py-2 md:px-4 md:py-3">{{ $user->mobile_no ?? '—' }}</td>
                    <td class="px-2 py-2 md:px-4 md:py-3">{{ $user->roleDetail ? ucfirst($user->roleDetail->name) : '—' }}</td>

                    <td class="px-2 py-2 text-center md:px-4 md:py-3">
                        <span class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-bold
                            {{ $user->status == 'active'
                                ? 'border border-emerald-200 bg-emerald-50 text-emerald-700'
                                : 'border border-rose-200 bg-rose-50 text-rose-700' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>

                    <td class="px-2 py-2 md:px-4 md:py-3">
                        <div class="flex justify-center gap-1 md:gap-2">
                            <a href="{{ route('admin.edit', $user->id) }}"
                                class="rounded-xl bg-slate-900 px-3 py-1 font-semibold text-white transition hover:bg-slate-800">
                               <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-xl bg-rose-600 px-3 py-1 font-semibold text-white transition hover:bg-rose-500">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-10 text-center text-slate-500">
                        No users found.
                        <div class="mt-2 text-sm text-slate-400">Create your first user to get started.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
