@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 px-4 py-10">
    <div class="w-full max-w-3xl rounded-2xl border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(15,23,42,0.12)]">
        <h1 class="mb-2 text-center text-3xl font-bold text-slate-900">
            Edit City
        </h1>
        <p class="mb-8 text-center text-sm text-slate-500">
            Update city details using the same light form styling.
        </p>

        <form action="{{ route('cities.update', $city->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    City Name *
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $city->name) }}"
                       class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                       placeholder="Enter city name">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Description *
                </label>
                <textarea name="description"
                          rows="4"
                          class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                          placeholder="Enter description">{{ old('description', $city->description) }}</textarea>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button type="submit"
                        class="rounded-lg bg-slate-900 px-8 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                    Update City
                </button>

                <a href="{{ route('cities.index') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-8 py-3 font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
