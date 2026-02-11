@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="w-full max-w-3xl bg-gray-900 p-8 border-4 border-yellow-600 shadow-lg">

        <h1 class="text-2xl font-bold text-white mb-6 text-center">
            Edit Country
        </h1>

        <form action="{{ route('countries.update', $country->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-yellow-600 mb-1 font-semibold">Country Name *</label>
                <input type="text" name="country_name" value="{{ old('country_name', $country->country_name) }}"
                       class="w-full border-2 border-yellow-600 px-3 py-2 bg-gray-900 text-white">
            </div>

            <div class="mb-5">
                <label class="block text-yellow-600 mb-1 font-semibold">Country Code</label>
                <input type="text" name="country_code" value="{{ old('country_code', $country->country_code) }}"
                       class="w-full border-2 border-yellow-600 px-3 py-2 bg-gray-900 text-white">
            </div>

            <div class="mb-6">
                <label class="block text-yellow-600 mb-1 font-semibold">Status *</label>
                <select name="status" required class="w-full border-2 border-yellow-600 px-3 py-2 bg-gray-900 text-white">
                    <option value="active" {{ $country->status=='active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $country->status=='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-yellow-600 text-black px-8 py-2 font-bold hover:bg-yellow-500">
                    Update Country
                </button>

                <a href="{{ route('countries.index') }}"
                   class="bg-gray-700 text-white px-8 py-2 font-bold hover:bg-gray-600">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
