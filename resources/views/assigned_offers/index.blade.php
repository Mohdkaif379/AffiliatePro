@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gray-900 p-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-8
                border-b border-yellow-600/40 pb-4">
        <h1 class="text-3xl font-extrabold text-yellow-500 tracking-wide">
            📋 Assigned Offers
        </h1>
    </div>

    <!-- Table Card -->
    <div class="backdrop-blur-xl bg-white/5 border border-white/10
                rounded-2xl shadow-2xl overflow-x-auto overflow-y-auto max-h-96">

        <table class="min-w-full text-sm text-gray-200">
            <thead class="sticky top-0 bg-black/80 backdrop-blur">
                <tr class="text-yellow-500 uppercase text-xs tracking-wider">
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
                <tr class="border-b border-white/10 hover:bg-white/5 transition">
                    <td class="px-4 py-3 text-center text-gray-400">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-4 py-3 font-semibold text-white">
                        {{ $assignedOffer->offer->offer_title ?? 'N/A' }}
                    </td>

                    <td class="px-4 py-3">
                        {{ $assignedOffer->user->full_name ?? 'N/A' }}
                    </td>

                    <td class="px-4 py-3">
                        <a href="{{ route('offers.show', $assignedOffer->offer->random_url ?? '') }}?user_id={{ auth()->id() }}"
                            target="_blank"
                            class="text-blue-400 hover:text-blue-300 break-all">
                            {{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}
                        </a>

                    </td>

                    <td class="px-4 py-3 text-gray-400">
                        {{ $assignedOffer->created_at->format('d M Y, H:i') }}
                    </td>

                    <td class="px-4 py-3">
                        <div class="flex justify-center">
                            <button onclick="copyToClipboard('{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}')"
                                class="px-3 py-1 rounded-lg bg-yellow-600/90
                              hover:bg-yellow-500 text-white font-semibold transition">
                                Copy
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-yellow-400">
                        🚫 No assigned offers found in the last 12 hours.
                        <div class="mt-2 text-sm text-gray-400">
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
<div id="toast" class="fixed top-28 right-4 bg-yellow-500 text-white px-4 py-2 rounded-lg shadow-lg opacity-0 transition-opacity duration-300">
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