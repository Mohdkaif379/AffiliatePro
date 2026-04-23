@extends('layout.app')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-8">

    <!-- Header -->
    <div class="mb-8 border-b border-slate-200 pb-4">
        <h1 class="text-3xl font-extrabold tracking-wide text-slate-900">
            <i class="fas fa-list-check mr-2 text-slate-700"></i> Assigned Offers
        </h1>
        <p class="mt-2 text-sm text-slate-500">View recently assigned offers and copy tracking links.</p>
    </div>

    <!-- Table Card -->
    <div class="max-h-96 overflow-x-auto overflow-y-auto rounded-3xl border border-slate-200 bg-white shadow-sm">

        <table class="min-w-full text-sm text-slate-700">
            <thead class="sticky top-0 bg-slate-50">
                <tr class="text-xs uppercase tracking-wider text-slate-500">
                    <th class="px-4 py-4 text-center">#</th>
                    <th class="px-4 py-4">Offer Title</th>
                    <th class="px-4 py-4">Assigned User</th>
                    <th class="px-4 py-4">Offer URL</th>
                    <th class="px-4 py-4">Assigned At</th>
                    <th class="px-4 py-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($assignedOffers as $assignedOffer)
                <tr class="border-b border-slate-100 transition hover:bg-slate-50">
                    <td class="px-4 py-3 text-center text-slate-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-slate-900">
                        {{ $assignedOffer->offer->offer_title ?? 'N/A' }}
                    </td>

                    <td class="px-4 py-3 text-slate-600">
                        {{ $assignedOffer->user->full_name ?? 'N/A' }}
                    </td>

                    <td class="break-all px-4 py-3">
                        <a href="{{ route('offers.show', $assignedOffer->offer->random_url ?? '') }}?user_id={{ auth()->id() }}"
                            target="_blank"
                            class="text-blue-600 hover:text-blue-700 hover:underline">
                            {{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}
                        </a>
                    </td>

                    <td class="px-4 py-3 text-slate-500">
                        {{ $assignedOffer->created_at->format('d M Y, H:i') }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex justify-center">
                            <button onclick="copyToClipboard('{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}')"
                                class="rounded-xl bg-slate-900 px-3 py-1 font-semibold text-white transition hover:bg-slate-800">
                                Copy
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-slate-500">
                        No assigned offers found in the last 12 hours.
                        <div class="mt-2 text-sm text-slate-400">
                            Assignments will appear here.
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>

</div>

<!-- Toast Notification -->
<div id="toast" class="fixed right-4 top-28 rounded-xl bg-emerald-600 px-4 py-2 text-white shadow-lg opacity-0 transition-opacity duration-300">
    Copied to clipboard!
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            showToast();
        }, function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    function showToast() {
        const toast = document.getElementById('toast');
        toast.classList.remove('opacity-0');
        toast.classList.add('opacity-100');
        setTimeout(() => {
            toast.classList.remove('opacity-100');
            toast.classList.add('opacity-0');
        }, 2000);
    }
</script>
@endsection
