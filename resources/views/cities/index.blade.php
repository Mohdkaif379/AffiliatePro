@extends('layout.app')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-6xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 flex flex-col gap-4 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    All Cities
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    Manage your city records in a clean light layout.
                </p>
            </div>

            <a href="{{ route('cities.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-6 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                + Create City
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-center font-semibold text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="w-full table-auto border-collapse text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">Sr No.</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">City Name</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Description</th>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($cities as $city)
                <tr>
                    <td class="px-4 py-4 text-center text-slate-500">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-4 font-semibold text-slate-900">
                        {{ $city->name }}
                    </td>

                    <td class="px-4 py-4 text-slate-600">
                        {{ $city->description }}
                    </td>

                    <td class="px-4 py-4">
                        <div class="flex justify-center gap-3">
                            <a href="{{ route('cities.edit', $city->id) }}"
                               class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                                Edit
                            </a>

                            <form action="{{ route('cities.destroy', $city->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this city?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center justify-center rounded-lg bg-rose-600 px-4 py-2 font-semibold text-white transition hover:bg-rose-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-slate-500">
                        No cities found.
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
