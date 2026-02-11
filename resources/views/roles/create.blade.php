@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="w-full max-w-3xl bg-gray-900 p-8 border-4 border-yellow-600 shadow-lg">

        <h1 class="text-2xl font-bold text-white mb-6 text-center">
            Create Role
        </h1>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <!-- Role Name -->
            <div class="mb-5">
                <label class="block text-yellow-600 mb-1 font-semibold">
                    Role Name *
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter role name"
                       class="w-full border-2 border-yellow-600 px-3 py-2 bg-gray-900 text-white">

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label class="block text-yellow-600 mb-1 font-semibold">
                    Description *
                </label>
                <textarea name="description"
                          rows="4"
                          placeholder="Enter role description"
                          class="w-full border-2 border-yellow-600 px-3 py-2 bg-gray-900 text-white">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                        class="bg-yellow-600 text-black px-8 py-2 font-bold hover:bg-yellow-500">
                    Create Role
                </button>

                <a href="{{ route('roles.index') }}"
                   class="bg-gray-700 text-white px-8 py-2 font-bold hover:bg-gray-600">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
