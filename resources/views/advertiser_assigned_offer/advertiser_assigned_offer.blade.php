@extends('layout.app')

@section('title','My Assigned Offers')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-6">

    <div class="mb-6 border-b border-slate-200 pb-4">
        <h1 class="flex items-center gap-3 text-3xl font-bold text-slate-900">
            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm">
                <i class="fa fa-handshake"></i>
            </span>
            Advertiser Assigned Offers
        </h1>
        <p class="mt-2 text-sm text-slate-500">Copy and open the assigned offer links for tracking.</p>
    </div>

    <div class="overflow-x-auto rounded-3xl border border-slate-200 bg-white shadow-sm">

        <table class="w-full text-left text-sm text-slate-700">
            <thead>
                <tr class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <th class="p-3">#</th>
                    <th class="p-3">Offer Name</th>
                    <th class="p-3">Advertiser Name</th>
                    <th class="p-3">Offer Link</th>
                    <th class="p-3">Copy</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assignedOffers as $key => $assignedOffer)
                    <tr class="border-b border-slate-100 transition hover:bg-slate-50">
                        <td class="p-3 text-slate-400">{{ $key+1 }}</td>

                        <td class="p-3 font-semibold text-slate-900">
                            {{ $assignedOffer->offer->offer_title ?? 'N/A' }}
                        </td>

                        <td class="p-3 font-medium text-slate-600">
                            {{ $assignedOffer->user->full_name ?? 'N/A' }}
                        </td>

                        <!-- Offer URL with auth user id -->
                        <td class="break-all p-3 text-blue-600">
                            <a href="{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}"
                               target="_blank"
                               class="hover:underline">
                               {{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}
                            </a>
                        </td>

                        <!-- Copy Button -->
                        <td class="p-3">
                            <button onclick="copyToClipboard('{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}', '{{ $assignedOffer->offer->offer_title ?? '' }}')"
                                class="rounded-xl bg-slate-900 px-3 py-1 font-semibold text-white transition hover:bg-slate-800">
                                Copy
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-slate-500">
                            No offers assigned yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

<!-- Toast Container -->
<div id="toast" class="fixed bottom-5 right-5 rounded-xl bg-emerald-600 px-4 py-2 text-white shadow-lg opacity-0 transition-opacity duration-300"></div>

<script>
function copyToClipboard(text, offerTitle) {
    navigator.clipboard.writeText(text).then(function() {
        showToast(`Offer "${offerTitle}" link copied!`);
    });
}

function showToast(message) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.classList.add('opacity-100');

    setTimeout(() => {
        toast.classList.remove('opacity-100');
    }, 2000); // 2 seconds
}
</script>
@endsection
