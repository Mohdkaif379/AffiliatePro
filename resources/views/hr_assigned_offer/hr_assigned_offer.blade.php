@extends('layout.app')

@section('title','My Assigned Offers')

@section('content')
<div class="min-h-screen bg-gray-900 p-6">

    <h1 class="text-3xl font-bold text-yellow-500 mb-6 flex items-center gap-2">
        <i class="fa fa-handshake"></i> HR Assigned Offers
    </h1>

    <div class="bg-gray-800 p-6 rounded-xl shadow overflow-x-auto">

        <table class="w-full text-left text-gray-300">
            <thead>
                <tr class="bg-gray-700 text-yellow-400">
                    <th class="p-3">#</th>
                    <th class="p-3">Offer Name</th>
                    <th class="p-3">HR Name</th>
                    <th class="p-3">Offer Link</th>
                    <th class="p-3">Copy</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assignedOffers as $key => $assignedOffer)
                    <tr class="border-b border-gray-700 hover:bg-gray-700/40">
                        <td class="p-3">{{ $key+1 }}</td>

                        <td class="p-3 font-semibold text-white">
                            {{ $assignedOffer->offer->offer_title ?? 'N/A' }}
                        </td>

                        <td class="p-3 font-medium text-gray-200">
                            {{ $assignedOffer->user->full_name ?? 'N/A' }}
                        </td>

                        <!-- Offer URL with auth user id -->
                        <td class="p-3 text-blue-400 break-all">
                            <a href="{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}"
                               target="_blank"
                               class="hover:underline">
                               {{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}
                            </a>
                        </td>

                        <!-- Copy Button -->
                        <td class="p-3">
                            <button onclick="copyToClipboard('{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}', '{{ $assignedOffer->offer->offer_title ?? '' }}')"
                                class="px-3 py-1 rounded-lg bg-yellow-600/90 hover:bg-yellow-500 text-white font-semibold transition">
                                Copy
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-400">
                            No offers assigned yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

<!-- Toast Container -->
<div id="toast" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg opacity-0 transition-opacity duration-300"></div>

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
