@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-900 p-8 shadow-xl">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6 p-4 border-b-2 border-yellow-600">
        <h1 class="text-3xl text-white font-bold">
            All Countries
        </h1>

        <a href="{{ route('countries.create') }}"
           class="bg-yellow-600 text-black px-6 py-2 font-bold hover:bg-yellow-500 shadow">
            + Create Country
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-400 text-black p-3 rounded mb-4 text-center font-semibold shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Countries Table -->
    <div class="overflow-x-auto rounded-lg shadow-2xl">
        <table class="w-full table-auto text-white text-sm border-collapse">
            <thead class="bg-gray-800 text-yellow-600 uppercase">
                <tr>
                    <th class="px-4 py-3 text-center">Sr No.</th>
                    <th class="px-4 py-3">Country Name</th>
                    <th class="px-4 py-3">Country Code</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($countries as $country)
                <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                    <td class="px-4 py-2 text-center text-gray-400">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 font-semibold">{{ $country->country_name }}</td>
                    <td class="px-4 py-2 text-gray-300">{{ $country->country_code ?? '-' }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded 
                            {{ $country->status == 'active' ? 'bg-green-500 text-black' : 'bg-red-600 text-white' }}">
                            {{ ucfirst($country->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('countries.edit', $country->id) }}"
                               class="bg-yellow-600 text-black px-4 py-1 rounded font-semibold hover:bg-yellow-500">
                                Edit
                            </a>

                            <form action="{{ route('countries.destroy', $country->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this country?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 text-white px-4 py-1 rounded font-semibold hover:bg-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-yellow-400">No countries found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
