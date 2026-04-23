@extends('layout.app')

@section('content')
<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-7xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 flex flex-col gap-4 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">All Offers</h1>
                <p class="mt-1 text-sm text-slate-500">Manage and assign offers from one place.</p>
            </div>

            <a href="{{ route('offers.create') }}"
               class="inline-flex items-center gap-2 rounded-lg bg-slate-900 px-5 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                + Create New Offer
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-center font-semibold text-emerald-700">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-center font-semibold text-rose-700">
            {{ session('error') }}
        </div>
        @endif

        <div class="scrollbar-hide max-h-[32rem] overflow-x-auto overflow-y-auto rounded-xl border border-slate-200">
            <table class="min-w-full border-collapse text-sm">
                <thead class="sticky top-0 bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-3 py-3 text-center font-semibold uppercase tracking-wide md:px-4">#</th>
                        <th class="px-3 py-3 text-left font-semibold uppercase tracking-wide md:px-4">Title</th>
                        <th class="px-3 py-3 text-left font-semibold uppercase tracking-wide md:px-4">Advertiser Name</th>
                        <th class="px-3 py-3 text-left font-semibold uppercase tracking-wide md:px-4">Affiliate Price</th>
                        <th class="px-3 py-3 text-left font-semibold uppercase tracking-wide md:px-4">Offer URL</th>
                        <th class="px-3 py-3 text-center font-semibold uppercase tracking-wide md:px-4">Status</th>
                        <th class="px-3 py-3 text-center font-semibold uppercase tracking-wide md:px-4">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($offers as $offer)
                    <tr class="hover:bg-slate-50">
                        <td class="px-3 py-4 text-center text-slate-500 md:px-4">{{ $loop->iteration }}</td>
                        <td class="px-3 py-4 font-semibold text-slate-900 md:px-4">{{ $offer->offer_title }}</td>
                        <td class="px-3 py-4 text-slate-600 md:px-4">{{ $offer->advertiser ? $offer->advertiser->full_name : '-' }}</td>
                        <td class="px-3 py-4 font-semibold text-emerald-600 md:px-4">INR {{ $offer->affiliate_price ?? '-' }}</td>
                        <td class="px-3 py-4 md:px-4">
                            <a href="{{ route('offers.show', $offer->random_url) }}?user_id={{ auth()->id() }}"
                               target="_blank"
                               class="break-all text-slate-700 underline decoration-slate-300 underline-offset-4 transition hover:text-slate-900 hover:decoration-slate-900">
                                {{ url('/offers/' . $offer->random_url) }}?user_id={{ auth()->id() }}
                            </a>
                        </td>
                        <td class="px-3 py-4 text-center md:px-4">
                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                {{ $offer->status == 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                {{ ucfirst($offer->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-4 md:px-4">
                            <div class="flex justify-center gap-2">
                                <button type="button"
                                    onclick="copyOfferLink('{{ url('/offers/' . $offer->random_url) }}?user_id={{ auth()->id() }}')"
                                    class="inline-flex items-center justify-center rounded-lg bg-slate-700 px-3 py-2 font-semibold text-white transition hover:bg-slate-600">
                                    Copy
                                </button>

                                <button type="button"
                                    onclick="openAssignModal({{ $offer->id }}, '{{ $offer->offer_title }}', '{{ \App\Models\AssignedOffer::where('offer_id', $offer->id)->pluck('user_id')->implode(',') }}')"
                                    class="inline-flex items-center justify-center rounded-lg bg-sky-600 px-3 py-2 font-semibold text-white transition hover:bg-sky-500">
                                    Assign
                                </button>

                                <a href="{{ route('send.email.send', $offer->id) }}"
                                   class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-3 py-2 font-semibold text-white transition hover:bg-emerald-500">
                                    Send
                                </a>

                                <form action="{{ route('offers.destroy', $offer->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this offer?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center rounded-lg bg-rose-600 px-3 py-2 font-semibold text-white transition hover:bg-rose-500">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-10 text-center text-slate-500">
                            No offers found.
                            <div class="mt-2 text-sm text-slate-400">
                                Create your first offer to get started.
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="assignModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/60 px-4">
            <div class="w-full max-w-md rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.18)]">
                <h2 class="mb-2 text-2xl font-bold text-slate-900">Assign Offer</h2>
                <p class="mb-5 text-sm text-slate-500">Assign "<span id="modalOfferTitle"></span>" to a user:</p>
                <form action="{{ route('assigned_offers.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="offer_id" id="modalOfferId">

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Filter by Role</label>
                        <select id="roleFilter" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
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
                        <label class="mb-2 block text-sm font-semibold text-slate-700">Select Users</label>
                        <div class="rounded-lg border border-slate-300 bg-slate-50 p-3">
                            <label class="flex items-center gap-2 border-b border-slate-200 pb-2">
                                <input type="checkbox" id="selectAll" class="rounded border-slate-300">
                                <span class="font-semibold text-slate-700">Select All</span>
                            </label>
                            <div id="userList" class="scrollbar-hide max-h-40 overflow-y-auto pt-2">
                                @foreach(\App\Models\User::where('role', '!=', $adminRoleId)->get() as $user)
                                <label class="user-item flex items-center gap-2 py-1" data-role="{{ $user->role }}">
                                    <input type="checkbox" name="user_id[]" value="{{ $user->id }}" class="user-checkbox rounded border-slate-300">
                                    <span class="text-slate-700">{{ $user->full_name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeAssignModal()" class="rounded-lg border border-slate-300 bg-white px-4 py-2 font-semibold text-slate-700 transition hover:bg-slate-50">Cancel</button>
                        <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 font-semibold text-white transition hover:bg-slate-800">Assign</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="toast" class="fixed bottom-5 right-5 z-50 rounded-lg bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-lg opacity-0 transition-opacity duration-300"></div>

<script>
    function copyOfferLink(url) {
        navigator.clipboard.writeText(url).then(function() {
            showToast('Offer link copied!');
        });
    }

    function showToast(message) {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.classList.add('opacity-100');

        setTimeout(() => {
            toast.classList.remove('opacity-100');
        }, 2000);
    }

    function openAssignModal(offerId, offerTitle, assignedUserIds) {
        document.getElementById('modalOfferId').value = offerId;
        document.getElementById('modalOfferTitle').textContent = offerTitle;
        document.getElementById('assignModal').classList.remove('hidden');
        document.getElementById('assignModal').classList.add('flex');
        document.getElementById('roleFilter').value = '';
        document.getElementById('selectAll').checked = false;

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
        document.getElementById('assignModal').classList.remove('flex');
    }

    function filterUsers() {
        const roleFilter = document.getElementById('roleFilter').value;
        const userItems = document.querySelectorAll('.user-item');

        userItems.forEach(item => {
            const userRole = item.getAttribute('data-role');
            if (roleFilter === '' || userRole == roleFilter) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
                item.querySelector('.user-checkbox').checked = false;
            }
        });

        updateSelectAllState();
    }

    function updateSelectAllState() {
        const visibleCheckboxes = document.querySelectorAll('.user-item[style*="display: flex"] .user-checkbox');
        const checkedVisibleCheckboxes = document.querySelectorAll('.user-item[style*="display: flex"] .user-checkbox:checked');
        const selectAllCheckbox = document.getElementById('selectAll');

        selectAllCheckbox.checked = visibleCheckboxes.length > 0 && checkedVisibleCheckboxes.length === visibleCheckboxes.length;
    }

    function toggleSelectAll() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const visibleCheckboxes = document.querySelectorAll('.user-item[style*="display: flex"] .user-checkbox');

        visibleCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
    }

    document.getElementById('roleFilter').addEventListener('change', filterUsers);
    document.getElementById('selectAll').addEventListener('change', toggleSelectAll);

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('user-checkbox')) {
            updateSelectAllState();
        }
    });
</script>
@endsection
