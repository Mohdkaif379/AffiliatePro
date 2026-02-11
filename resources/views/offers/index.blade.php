@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-900 p-4 md:p-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 
                border-b border-yellow-600/40 pb-4">
        <h1 class="text-3xl font-extrabold text-yellow-500 tracking-wide">
            🎯 All Offers
        </h1>

        <a href="{{ route('offers.create') }}"
            class="mt-4 md:mt-0 inline-flex items-center gap-2 
                  bg-yellow-600 hover:bg-yellow-500 text-white 
                  px-5 py-2 rounded-lg font-bold shadow-xl transition">
            ➕ Create New Offer
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-500/20 border border-green-500 text-green-300
                p-4 rounded-lg mb-6 text-center font-semibold shadow">
        ✅ {{ session('success') }}
    </div>
    @endif

    <!-- Error Message -->
    @if(session('error'))
    <div class="bg-red-500/20 border border-red-500 text-red-300
                p-4 rounded-lg mb-6 text-center font-semibold shadow">
        ❌ {{ session('error') }}
    </div>
    @endif

    <!-- Table Card -->
    <div class="backdrop-blur-xl bg-white/5 border border-white/10
                rounded-2xl shadow-2xl overflow-x-auto overflow-y-auto max-h-96">

        <table class="min-w-full text-sm text-gray-200">
            <thead class="sticky top-0 bg-black/80 backdrop-blur">
                <tr class="text-yellow-500 uppercase text-xs tracking-wider">
                    <th class="px-2 py-2 md:px-4 md:py-4 text-center">#</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Title</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Advertiser Name</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Affiliate Price</th>
                    <th class="px-2 py-2 md:px-4 md:py-4">Offer URL</th>
                    <th class="px-2 py-2 md:px-4 md:py-4 text-center">Status</th>
                    <th class="px-2 py-2 md:px-4 md:py-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($offers as $offer)
                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                    <td class="px-2 py-2 md:px-4 md:py-3 text-center text-gray-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-2 py-2 md:px-4 md:py-3 font-semibold text-white">
                        {{ $offer->offer_title }}
                    </td>



                    <td class="px-2 py-2 md:px-4 md:py-3">
                        {{ $offer->advertiser ? $offer->advertiser->full_name : '—' }}
                    </td>


                    <td class="px-2 py-2 md:px-4 md:py-3 font-bold text-green-400">
                        ₹ {{ $offer->affiliate_price ?? '—' }}
                    </td>

                    <td class="px-2 py-2 md:px-4 md:py-3">
                        <a href="{{ route('offers.show', $offer->random_url) }}?user_id={{ auth()->id() }}"
                            target="_blank"
                            class="text-blue-400 hover:text-blue-300  break-all">
                            {{ url('/offers/' . $offer->random_url) }}?user_id={{ auth()->id() }}
                        </a>
                    </td>

                    <td class="px-2 py-2 md:px-4 md:py-3 text-center">
                        <span class="inline-flex items-center gap-2 px-3 py-1
                                     rounded-full text-xs font-bold
                            {{ $offer->status == 'active'
                                ? 'bg-green-500/20 text-green-400'
                                : 'bg-red-500/20 text-red-400' }}">
                            {{ ucfirst($offer->status) }}
                        </span>
                    </td>

                    <td class="px-2 py-2 md:px-4 md:py-3">
                        <div class="flex justify-center gap-1 md:gap-2">
                            <!-- <a href="{{ route('offers.edit', $offer->id) }}"
                                class="px-3 py-1 rounded-lg bg-yellow-600/90
                                      hover:bg-yellow-500 text-black font-semibold transition">
                                Edit
                            </a> -->

                            <button type="button"
                                onclick="openAssignModal({{ $offer->id }}, '{{ $offer->offer_title }}', '{{ \App\Models\AssignedOffer::where('offer_id', $offer->id)->pluck('user_id')->implode(',') }}')"
                                class="px-3 py-1 rounded-lg bg-blue-600/90
                                       hover:bg-blue-500 text-white font-semibold transition">
                                Assign
                            </button>

                            <a href="{{ route('send.email.send', $offer->id) }}"
                                class="px-3 py-1 rounded-lg bg-green-600/90
                              hover:bg-green-500 text-white font-semibold transition">
                                Send
                            </a>

                            <form action="{{ route('offers.destroy', $offer->id) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this offer?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 rounded-lg bg-red-600/90
                                               hover:bg-red-500 text-white font-semibold transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="py-10 text-center text-yellow-400">
                        🚫 No offers found.
                        <div class="mt-2 text-sm text-gray-400">
                            Create your first offer to get started.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Assign Modal -->
    <div id="assignModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-bold text-white mb-4">Assign Offer</h2>
            <p class="text-gray-300 mb-4">Assign "<span id="modalOfferTitle"></span>" to a user:</p>
            <form action="{{ route('assigned_offers.store') }}" method="POST">
                @csrf
                <input type="hidden" name="offer_id" id="modalOfferId">
                <div class="mb-4">
                    <label class="block text-yellow-600 mb-1">Filter by Role</label>
                    <select id="roleFilter" class="w-full border-2 border-yellow-600 px-3 py-2 bg-white">
                        <option value="">All Roles</option>
                        @php
                        $adminRole = \App\Models\Role::where('name', 'admin')->first();
                        $adminRoleId = $adminRole ? $adminRole->id : null;
                        @endphp
                        @foreach(\App\Models\Role::where('id', '!=', $adminRoleId)->get() as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-yellow-600 mb-1">Select Users</label>
                    <div class="border-2 border-yellow-600 p-2 bg-white">
                        <label class="flex items-center gap-2 py-1 border-b border-gray-300">
                            <input type="checkbox" id="selectAll" class="form-checkbox">
                            <span class="font-bold">Select All</span>
                        </label>
                        <div id="userList" class="max-h-40 overflow-y-auto">
                            @foreach(\App\Models\User::where('role', '!=', $adminRoleId)->get() as $user)
                            <label class="flex items-center gap-2 py-1 user-item" data-role="{{ $user->role }}">
                                <input type="checkbox" name="user_id[]" value="{{ $user->id }}" class="form-checkbox user-checkbox">
                                <span>{{ $user->full_name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeAssignModal()" class="px-4 py-2 bg-gray-600 text-white rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded">Assign</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function openAssignModal(offerId, offerTitle, assignedUserIds) {
        document.getElementById('modalOfferId').value = offerId;
        document.getElementById('modalOfferTitle').textContent = offerTitle;
        document.getElementById('assignModal').classList.remove('hidden');
        // Reset filters and selections
        document.getElementById('roleFilter').value = '';
        document.getElementById('selectAll').checked = false;
        // Disable already assigned users
        const assignedIds = assignedUserIds ? assignedUserIds.split(',').map(id => parseInt(id)) : [];
        document.querySelectorAll('.user-checkbox').forEach(checkbox => {
            const userId = parseInt(checkbox.value);
            if (assignedIds.includes(userId)) {
                checkbox.disabled = true;
                checkbox.checked = true;
                checkbox.parentElement.style.opacity = '0.5';
            } else {
                checkbox.disabled = false;
                checkbox.checked = false;
                checkbox.parentElement.style.opacity = '1';
            }
        });
        filterUsers();
    }

    function closeAssignModal() {
        document.getElementById('assignModal').classList.add('hidden');
    }

    function filterUsers() {
        const roleFilter = document.getElementById('roleFilter').value;
        const userItems = document.querySelectorAll('.user-item');
        const selectAllCheckbox = document.getElementById('selectAll');

        userItems.forEach(item => {
            const userRole = item.getAttribute('data-role');
            if (roleFilter === '' || userRole == roleFilter) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
                item.querySelector('.user-checkbox').checked = false;
            }
        });

        // Update select all checkbox state
        updateSelectAllState();
    }

    function updateSelectAllState() {
        const visibleCheckboxes = document.querySelectorAll('.user-item[style*="display: flex"] .user-checkbox');
        const checkedVisibleCheckboxes = document.querySelectorAll('.user-item[style*="display: flex"] .user-checkbox:checked');
        const selectAllCheckbox = document.getElementById('selectAll');

        if (visibleCheckboxes.length > 0 && checkedVisibleCheckboxes.length === visibleCheckboxes.length) {
            selectAllCheckbox.checked = true;
        } else {
            selectAllCheckbox.checked = false;
        }
    }

    function toggleSelectAll() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const visibleCheckboxes = document.querySelectorAll('.user-item[style*="display: flex"] .user-checkbox');

        visibleCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }

    // Event listeners
    document.getElementById('roleFilter').addEventListener('change', filterUsers);
    document.getElementById('selectAll').addEventListener('change', toggleSelectAll);

    // Update select all state when individual checkboxes change
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('user-checkbox')) {
            updateSelectAllState();
        }
    });
</script>
@endsection