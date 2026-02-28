@extends('layout.app')

@section('title', 'Billing')

@section('content')
<div class="min-h-screen bg-gray-900 p-6">
    <div class="max-w-2xl mx-auto bg-gray-800 rounded-xl shadow-lg p-6 text-white">
        <h1 class="text-2xl font-bold text-yellow-500 mb-6">Billing Form</h1>

        <form method="POST" action="{{ route('accountant.invoice.generate') }}" target="_blank" class="space-y-5">
            @csrf
            <input type="hidden" name="pdf" value="1">

            <div>
                <label for="user_id" class="block text-sm text-gray-300 mb-1">Select User</label>
                <select id="user_id" name="user_id" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" required>
                    <option value="">Choose user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->full_name }} ({{ $user->roleDetail->name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="from_date" class="block text-sm text-gray-300 mb-1">From Date</label>
                    <input id="from_date" type="date" name="from_date" value="{{ old('from_date') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
                    @error('from_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="to_date" class="block text-sm text-gray-300 mb-1">To Date</label>
                    <input id="to_date" type="date" name="to_date" value="{{ old('to_date') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
                    @error('to_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-500 px-5 py-2 rounded font-semibold text-white">
                    Generate Invoice
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
