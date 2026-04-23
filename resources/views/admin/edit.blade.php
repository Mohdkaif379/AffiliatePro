@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="w-full max-w-5xl rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:p-8">

        <h1 class="mb-6 text-left text-2xl font-bold text-slate-900">
            <i class="fas fa-edit mr-2"></i>Edit User
        </h1>

        <!-- Display Success -->
        @if(session('success'))
        <div class="relative mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-700">
            <button type="button" onclick="this.parentElement.style.display='none'" class="absolute right-2 top-2 text-emerald-700 hover:text-emerald-900">&times;</button>
            {{ session('success') }}
        </div>
        @endif

        <!-- Display Errors -->
        @if ($errors->any())
        <div class="relative mb-4 rounded-xl border border-rose-200 bg-rose-50 p-4 text-rose-700">
            <button type="button" onclick="this.parentElement.style.display='none'" class="absolute right-2 top-2 text-rose-700 hover:text-rose-900">&times;</button>
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
                    <label for="full_name" class="mb-1 block font-medium text-slate-700">Full Name</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" required>
                </div>
                <div class="flex-1">
                    <label for="company_name" class="mb-1 block font-medium text-slate-700">Company Name</label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $user->company_name) }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                </div>
            </div>

            <!-- Row 2: Mobile Number + Email -->
            <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
                <div class="flex-1">
                    <label for="mobile_no" class="mb-1 block font-medium text-slate-700">Mobile Number</label>
                    <input type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" required>
                </div>
                <div class="flex-1">
                    <label for="email" class="mb-1 block font-medium text-slate-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" required>
                </div>
            </div>

            <!-- Row 3: Password + Status -->
            <div class="flex flex-col md:flex-row md:space-x-4 space-y-4 md:space-y-0">
                <div class="relative flex-1">
                    <label for="password" class="mb-1 block font-medium text-slate-700">Password (Leave blank to keep current)</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 pr-10 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 mt-8 flex items-center pr-3 text-slate-500 hover:text-slate-700">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="flex-1">
                    <label for="status" class="mb-1 block font-medium text-slate-700">Status</label>
                    <select name="status" id="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <!-- Row 4: Role -->
            <div>
                <label for="role" class="mb-1 block font-medium text-slate-700">Role</label>

                <select
                    name="role"
                    id="role"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
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
                <label class="mb-2 block font-medium text-slate-700"><i class="fas fa-user-shield mr-2"></i>Assign Permissions</label>

                <div class="space-y-2 rounded-2xl border border-slate-200 bg-slate-50 p-4">
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
                    <div class="ml-8 mr-8 flex items-center justify-center gap-20 text-md text-slate-700">
                        <span class="flex w-40 items-center gap-2">
                            <i class="{{ $module['icon'] }} w-4 text-slate-500"></i>
                            {{ $module['label'] }}
                        </span>
                        <label class="flex items-center gap-2"><input type="checkbox" name="permissions[{{ $key }}][]" value="create" {{ in_array('create', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="rounded border-slate-300 text-slate-900 focus:ring-slate-300"> Create</label>
                        <label class="flex items-center gap-2"><input type="checkbox" name="permissions[{{ $key }}][]" value="read" {{ in_array('read', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="rounded border-slate-300 text-slate-900 focus:ring-slate-300"> Read</label>
                        <label class="flex items-center gap-2"><input type="checkbox" name="permissions[{{ $key }}][]" value="update" {{ in_array('update', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="rounded border-slate-300 text-slate-900 focus:ring-slate-300"> Edit</label>
                        <label class="flex items-center gap-2"><input type="checkbox" name="permissions[{{ $key }}][]" value="delete" {{ in_array('delete', old('permissions.' . $key, $permissions[$key] ?? [])) ? 'checked' : '' }} class="rounded border-slate-300 text-slate-900 focus:ring-slate-300"> Delete</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-[150px] rounded-xl bg-slate-900 px-4 py-2 font-medium text-white transition hover:bg-slate-800">
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
