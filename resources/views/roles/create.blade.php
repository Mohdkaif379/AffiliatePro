@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 px-4 py-10">
    <div class="w-full max-w-3xl rounded-2xl border border-slate-200 bg-white p-8 shadow-[0_24px_60px_rgba(15,23,42,0.12)]">
        <h1 class="mb-2 text-center text-3xl font-bold text-slate-900">
            Create Role
        </h1>
        <p class="mb-8 text-center text-sm text-slate-500">
            Add a new role using the same light form style.
        </p>

        <form action="{{ route('roles.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Role Name *</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter role name"
                       class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">

                @error('name')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Description *</label>
                <textarea name="description"
                          rows="4"
                          placeholder="Enter role description"
                          class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">
                <button type="submit"
                        class="rounded-lg bg-slate-900 px-8 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                    Create Role
                </button>

                <a href="{{ route('roles.index') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-8 py-3 font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
