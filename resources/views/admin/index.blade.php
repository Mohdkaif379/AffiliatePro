@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-900 p-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 border-b border-yellow-600/40 pb-4">
        <h1 class="text-3xl font-extrabold text-yellow-500 tracking-wide"><i class="fas fa-users"></i> All Users</h1>

        <a href="{{ route('admin.create') }}"
            class="mt-4 md:mt-0 inline-flex items-center gap-2 bg-yellow-600 hover:bg-yellow-500 text-white px-5 py-2 rounded-lg font-bold shadow-xl transition">
            ➕ Create New User
        </a>
    </div>

    <!-- Success and Error Messages -->
    @if(session('success'))
    <div class="bg-green-500/20 text-green-400 p-4 rounded-lg mb-4 border border-green-500/30">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-500/20 text-red-400 p-4 rounded-lg mb-4 border border-red-500/30">
        ❌ There were some errors:
        <ul class="mt-2 list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Table Card -->
    <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl shadow-2xl overflow-x-auto">

        <table class="min-w-full text-sm text-gray-200">
            <thead class="sticky top-0 bg-black/80 backdrop-blur">
                <tr class="text-yellow-500 uppercase text-xs tracking-wider">
                    <th class="px-2 py-2 md:px-4 md:py-4 text-center">#</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Full Name</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Email</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Mobile</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Role</th>
                    <th class="px-2 py-2 md:px-4 md:py-4 text-center">Status</th>
                    <th class="px-2 py-2 md:px-4 md:py-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                    <td class="px-2 py-2 md:px-4 md:py-3 text-center text-gray-400">{{ $loop->iteration }}</td>

                    <td class="px-2 py-2 md:px-4 md:py-3 font-semibold text-white">{{ $user->full_name }}</td>
                    <td class="px-2 py-2 md:px-4 md:py-3">{{ $user->email }}</td>
                    <td class="px-2 py-2 md:px-4 md:py-3">{{ $user->mobile_no ?? '—' }}</td>
                    <td class="px-2 py-2 md:px-4 md:py-3">{{ $user->roleDetail ? ucfirst($user->roleDetail->name) : '—' }}</td>

                    <td class="px-2 py-2 md:px-4 md:py-3 text-center">
                        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold
                            {{ $user->status == 'active'
                                ? 'bg-green-500/20 text-green-400'
                                : 'bg-red-500/20 text-red-400' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>

                    <td class="px-2 py-2 md:px-4 md:py-3">
                        <div class="flex justify-center gap-1 md:gap-2">
                            <a href="{{ route('admin.edit', $user->id) }}"
                                class="px-3 py-1 rounded-lg bg-yellow-600/90 hover:bg-yellow-500 text-black font-semibold transition">
                               <i class="fas fa-edit"></i> Edit
                            </a>

                            <form action="{{ route('admin.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 rounded-lg bg-red-600/90 hover:bg-red-500 text-white font-semibold transition">
                                    <i class="fas fa-trash mr-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-10 text-center text-yellow-400">
                        🚫 No users found.
                        <div class="mt-2 text-sm text-gray-400">Create your first user to get started.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection