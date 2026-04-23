@extends('layout.app')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-5xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 border-b border-slate-200 pb-5">
            <h2 class="text-3xl font-bold text-slate-900">
                Update Profile
            </h2>
            <p class="mt-2 text-sm text-slate-500">
                Keep your account details up to date.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('update.profile') }}">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Full Name</label>
                    <input
                        type="text"
                        name="full_name"
                        value="{{ old('full_name', auth()->user()->full_name ?? '') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Company Name</label>
                    <input
                        type="text"
                        name="company_name"
                        value="{{ old('company_name', auth()->user()->company_name ?? '') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Mobile Number</label>
                    <input
                        type="text"
                        name="mobile_no"
                        value="{{ old('mobile_no', auth()->user()->mobile_no ?? '') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                    >
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email ?? '') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"
                    >
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-end">
                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-6 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg"
                >
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
