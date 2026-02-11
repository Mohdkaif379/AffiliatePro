@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="w-full max-w-3xl bg-gray-900 p-8 border-4 border-yellow-600 shadow-lg">

        <h1 class="text-2xl font-bold text-white mb-6 text-center">
            Edit Language
        </h1>

        <form action="{{ route('languages.update', $language->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Language Name -->
            <div class="mb-5">
                <label class="block text-yellow-600 mb-1 font-semibold">Language Name *</label>
                <input type="text" name="language_name" 
                       value="{{ old('name', $language->name) }}"
                       class="w-full border-2 border-yellow-600 px-3 py-2 bg-gray-900 text-white" required>
            </div>

            <!-- Language Code -->
            <div class="mb-6">
                <label class="block text-yellow-600 mb-1 font-semibold">Language Code</label>
                <input type="text" name="language_code" 
                       value="{{ old('code', $language->code) }}"
                       class="w-full border-2 border-yellow-600 px-3 py-2 bg-gray-900 text-white">
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="bg-yellow-600 text-black px-8 py-2 font-bold hover:bg-yellow-500">
                    Update Language
                </button>

                <a href="{{ route('languages.index') }}"
                   class="bg-gray-700 text-white px-8 py-2 font-bold hover:bg-gray-600">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
