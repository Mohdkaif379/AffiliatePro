@extends('layout.app')

@section('content')

<div class="min-h-screen bg-gray-900 flex items-center justify-center p-6">
    <div class="w-full max-w-6xl border-4 border-yellow-600  p-8 bg-gradient-to-br from-gray-900 to-gray-800">

        <h2 class="text-3xl font-bold text-yellow-500 mb-8 flex items-center gap-2">
            <i class="fas fa-user-edit"></i> Update Profile
        </h2>

        <form method="POST" action="{{route('update.profile')}}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Full Name --}}
                <div>
                    <label class="block text-white mb-2">Full Name</label>
                    <input type="text" name="full_name"
                        value="{{ auth()->user()->full_name ?? '' }}"
                        class="w-full px-4 py-2 bg-white border-2 border-yellow-700  focus:outline-none">
                </div>

                {{-- Company Name --}}
                <div>
                    <label class="block text-white mb-2">Company Name</label>
                    <input type="text" name="company_name"
                        value="{{ auth()->user()->company_name ?? '' }}"
                        class="w-full px-4 py-2 bg-white border-2 border-yellow-700  focus:outline-none">
                </div>

                {{-- Mobile Number --}}
                <div>
                    <label class="block text-white mb-2">Mobile Number</label>
                    <input type="text" name="mobile_no"
                        value="{{ auth()->user()->mobile_no ?? '' }}"
                        class="w-full px-4 py-2 bg-white border-2 border-yellow-700  focus:outline-none">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block text-white mb-2">Email</label>
                    <input type="email" name="email"
                        value="{{ auth()->user()->email ?? '' }}"
                        class="w-full px-4 py-2 bg-white border-2 border-yellow-700  focus:outline-none">
                </div>

            </div>

            <div class="mt-8 text-right">
                <button type="submit"
                    class="bg-yellow-500 text-gray-900 font-bold px-8 py-3  hover:bg-yellow-400 transition">
                    Update Profile
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
