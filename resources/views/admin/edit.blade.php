@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-5xl bg-gray-900 p-8 border-4 border-yellow-600 shadow-lg">

        <h1 class="text-2xl font-bold text-yellow-500 mb-6 text-left">
            <i class="fas fa-edit mr-2"></i>Edit User</h1>

        <!-- Display Success -->
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded relative">
            <button type="button" onclick="this.parentElement.style.display='none'" class="absolute top-2 right-2 text-green-700 hover:text-green-900">&times;</button>
            {{ session('success') }}
        </div>
        @endif

        <!-- Display Errors -->
        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded relative">
            <button type="button" onclick="this.parentElement.style.display='none'" class="absolute top-2 right-2 text-red-700 hover:text-red-900">&times;</button>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.update', $user->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Row 1: Full Name + Company Name -->
            <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
                <div class="flex-1">
                    <label for="full_name" class="block font-medium mb-1 text-white">Full Name</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}"
                        class="w-full border-yellow-700 border-2 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-700" required>
                </div>
                <div class="flex-1">
                    <label for="company_name" class="block font-medium mb-1 text-white">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $user->company_name) }}"
                        class="w-full border-yellow-700 border-2 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-700">
                </div>
            </div>

            <!-- Row 2: Mobile Number + Email -->
            <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
                <div class="flex-1">
                    <label for="mobile_no" class="block font-medium mb-1 text-white">Mobile Number</label>
                    <input type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}"
                        class="w-full border-yellow-700 border-2 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-700" required>
                </div>
                <div class="flex-1">
                    <label for="email" class="block font-medium mb-1 text-white">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full border-yellow-700 border-2 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-700" required>
                </div>
            </div>

            <!-- Row 3: Password + Status -->
            <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
                <div class="flex-1 relative">
                    <label for="password" class="block font-medium mb-1 text-white">Password (Leave blank to keep current)</label>
                    <input type="password" name="password" id="password"
                        class="w-full border-yellow-700 border-2 px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-yellow-700">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 mt-8 right-0 pr-3 flex items-center text-yellow-700 hover:text-yellow-900">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="flex-1">
                    <label for="status" class="block font-medium mb-1 text-white">Status</label>
                    <select name="status" id="status"
                        class="w-full border-yellow-700 border-2 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-700">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Row 4: Role -->
            <div>
                <label for="role" class="block font-medium mb-1 text-white">Role</label>

                <select
                    name="role"
                    id="role"
                    class="w-full border-yellow-700 border-2 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-700">
                    <option value="">Select Role</option>

                    @foreach($roles as $role)
                    <option
                        value="{{ $role->name }}"
                        {{ old('role', $user->roleDetail->name ?? '') == $role->name ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                    @endforeach
                </select>
            </div>


            <!-- Row 5: Permissions (CRUD) -->
            <div class="mt-4">
                <label class="block font-medium mb-2 text-white"><i class="fas fa-user-shield mr-2"></i>Assign Permissions</label>

                <div class="space-y-2 bg-gray-900 p-3 border border-yellow-700 rounded">

                    @php
                    $modules = [
                    'dashboard' => ['label' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt'],
                    'management' => ['label' => 'NHI Access', 'icon' => 'fas fa-cogs'],
                    'offers' => ['label' => 'Offers', 'icon' => 'fas fa-cogs'],
                    'reports' => ['label' => 'Reports', 'icon' => 'fas fa-chart-line'],
                    'dataManagement' => ['label' => 'Data Management', 'icon' => 'fas fa-database'],
                    'managers' => ['label' => 'Managers', 'icon' => 'fas fa-users'],
                    'advertisers' => ['label' => 'Advertisers', 'icon' => 'fas fa-ad'],
                    'hr' => ['label' => 'HR', 'icon' => 'fas fa-user-friends'],
                    'employee' => ['label' => 'Employee', 'icon' => 'fas fa-user-tie'],
                    'accounts' => ['label' => 'Accounts', 'icon' => 'fas fa-wallet'],
                    ];
                    @endphp

                    @foreach($modules as $key => $module)
                    <div class="flex items-center justify-center gap-20 text-white text-md ml-8 mr-8">
                        <span class="flex items-center gap-2 w-40">
                            <i class="{{ $module['icon'] }} w-4"></i>
                            {{ $module['label'] }}
                        </span>
                        <label><input type="checkbox" name="permissions[{{ $key }}][]" value="create" {{ in_array('create', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="text-yellow-600"> Create</label>
                        <label><input type="checkbox" name="permissions[{{ $key }}][]" value="read" {{ in_array('read', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="text-yellow-600"> Read</label>
                        <label><input type="checkbox" name="permissions[{{ $key }}][]" value="update" {{ in_array('update', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="text-yellow-600"> Edit</label>
                        <label><input type="checkbox" name="permissions[{{ $key }}][]" value="delete" {{ in_array('delete', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="text-yellow-600"> Delete</label>
                    </div>
                    @endforeach

                </div>
            </div>



            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-[150px] bg-yellow-700 text-white font-medium py-2 px-4 hover:bg-yellow-600 transition">
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Password Toggle JS -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>
@endsection
