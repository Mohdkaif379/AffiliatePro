@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 px-4 py-10">
    <div class="w-full max-w-3xl rounded-2xl border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(15,23,42,0.12)]">
        <h1 class="mb-2 text-center text-3xl font-bold text-slate-900">
            Edit Country
        </h1>
        <p class="mb-8 text-center text-sm text-slate-500">
            Update country details using the light theme form style.
        </p>

        <form action="{{ route('countries.update', $country->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Country Name *</label>
                <input type="text" name="country_name" value="{{ old('country_name', $country->country_name) }}"
                       class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                       placeholder="Enter country name">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Country Code</label>
                <input type="text" name="country_code" value="{{ old('country_code', $country->country_code) }}"
                       class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                       placeholder="Enter country code">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Status *</label>
                <select name="status" required class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                    <option value="">Select</option>
                    <option value="active" {{ $country->status=='active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $country->status=='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button type="submit" class="rounded-lg bg-slate-900 px-8 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                    Update Country
                </button>

                <a href="{{ route('countries.index') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-8 py-3 font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
