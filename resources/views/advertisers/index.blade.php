@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-900 p-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8
                border-b border-yellow-600/40 pb-4">
        <h1 class="flex items-center gap-2 text-3xl font-extrabold text-yellow-500 tracking-wide">
            <i class="fas fa-bullhorn text-yellow-400 text-3xl"></i>
            Advertisers List
        </h1>

    </div>

    <!-- Table Card -->
    <div class="backdrop-blur-xl bg-white/5 border border-white/10
                rounded-2xl shadow-2xl overflow-x-auto overflow-y-auto max-h-96">

        <table class="min-w-full text-sm text-gray-200">
            <thead class="sticky top-0 bg-black/80 backdrop-blur">
                <tr class="text-yellow-500 uppercase text-xs tracking-wider">
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
                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                    <td class="px-4 py-3 text-center text-gray-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-white">
                        {{ $advertiser->full_name }}
                    </td>

                    <td class="px-4 py-3 text-gray-300">
                        {{ $advertiser->email }}
                    </td>


                    <td class="px-4 py-3 font-semibold text-white">
                        {{ $advertiser->roleDetail->name }}
                    </td>

                    <td class="px-4 py-3 text-gray-400">
                        {{ $advertiser->created_at->format('d M Y, H:i') }}
                    </td>

                    <td class="px-4 py-3 text-center">
                        <span class="px-3 py-1 rounded-full bg-green-600 text-white text-xs font-semibold">
                            {{ $advertiser->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-yellow-400">
                        🚫 No advertisers found.
                        <div class="mt-2 text-sm text-gray-400">
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