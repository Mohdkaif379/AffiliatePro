@extends('layout.app')

@section('title','My Assigned Offers')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-6xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="flex items-center gap-2 text-3xl font-bold text-slate-900">
                    <i class="fa fa-handshake text-slate-700"></i> Employee Assigned Offers
                </h1>
                <p class="mt-1 text-sm text-slate-500">
                    View and copy the assigned offer links for employees.
                </p>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-slate-200">
            <table class="w-full table-auto border-collapse text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">#</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Offer Name</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Employee Name</th>
                        <th class="px-4 py-3 text-left font-semibold uppercase tracking-wide">Offer Link</th>
                        <th class="px-4 py-3 text-center font-semibold uppercase tracking-wide">Copy</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($assignedOffers as $key => $assignedOffer)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-4 text-slate-500">{{ $key + 1 }}</td>

                            <td class="px-4 py-4 font-semibold text-slate-900">
                                {{ $assignedOffer->offer->offer_title ?? 'N/A' }}
                            </td>

                            <td class="px-4 py-4 font-medium text-slate-600">
                                {{ $assignedOffer->user->full_name ?? 'N/A' }}
                            </td>

                            <td class="px-4 py-4">
                                <a href="{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}"
                                   target="_blank"
                                   class="break-all text-slate-700 underline decoration-slate-300 underline-offset-4 transition hover:text-slate-900 hover:decoration-slate-900">
                                   {{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}
                                </a>
                            </td>

                            <td class="px-4 py-4 text-center">
                                <button onclick="copyToClipboard('{{ url('/offers/' . ($assignedOffer->offer->random_url ?? '')) }}?user_id={{ auth()->id() }}', '{{ $assignedOffer->offer->offer_title ?? '' }}')"
                                    class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-2 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                                    Copy
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500">
                                No offers assigned yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast" class="fixed bottom-5 right-5 rounded-lg bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-lg opacity-0 transition-opacity duration-300"></div>
</div>

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
