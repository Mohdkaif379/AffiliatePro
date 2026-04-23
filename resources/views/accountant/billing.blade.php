@extends('layout.app')

@section('title', 'Billing')

@section('content')
<div class="min-h-screen rounded-3xl bg-slate-50 p-4 md:p-6">
    <div class="mx-auto max-w-2xl rounded-3xl border border-slate-200 bg-white p-4 shadow-sm md:p-6">
        <h1 class="mb-6 text-2xl font-bold text-slate-900">Billing Form</h1>

        <form method="POST" action="{{ route('accountant.invoice.generate') }}" target="_blank" class="space-y-5">
            @csrf
            <input type="hidden" name="pdf" value="1">

            <div>
                <label for="user_id" class="mb-1 block text-sm text-slate-600">Select User</label>
                <select id="user_id" name="user_id" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" required>
                    <option value="">Choose user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->full_name }} ({{ $user->roleDetail->name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="from_date" class="mb-1 block text-sm text-slate-600">From Date</label>
                    <input id="from_date" type="date" name="from_date" value="{{ old('from_date') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                    @error('from_date')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="to_date" class="mb-1 block text-sm text-slate-600">To Date</label>
                    <input id="to_date" type="date" name="to_date" value="{{ old('to_date') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                    @error('to_date')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="payment_method" class="mb-1 block text-sm text-slate-600">Payment Method</label>
                <select id="payment_method" name="payment_method" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                    <option value="">Choose payment method</option>
                    <option value="upi" {{ old('payment_method')=='upi' ? 'selected' : '' }}>UPI</option>
                    <option value="cash" {{ old('payment_method')=='cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank" {{ old('payment_method')=='bank' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="card" {{ old('payment_method')=='card' ? 'selected' : '' }}>Card</option>
                </select>
                @error('payment_method')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div id="payment-fields" class="mt-4 space-y-4">
                <div class="payment-block hidden" data-method="upi">
                    <label class="mb-1 block text-sm text-slate-600">UPI ID</label>
                    <input type="text" name="upi_id" value="{{ old('upi_id') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="example@bank">
                </div>

                <div class="payment-block hidden" data-method="cash">
                    <label class="mb-1 block text-sm text-slate-600">Receipt # / Notes</label>
                    <input type="text" name="cash_receipt" value="{{ old('cash_receipt') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="Receipt number or notes">
                </div>

                <div class="payment-block hidden" data-method="bank">
                    <label class="mb-1 block text-sm text-slate-600">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="Bank name">
                    <label class="mb-1 mt-2 block text-sm text-slate-600">Account Number</label>
                    <input type="text" name="bank_account" value="{{ old('bank_account') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="Account number">
                    <label class="mb-1 mt-2 block text-sm text-slate-600">IFSC / Routing</label>
                    <input type="text" name="bank_ifsc" value="{{ old('bank_ifsc') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="IFSC code">
                </div>

                <div class="payment-block hidden" data-method="card">
                    <label class="mb-1 block text-sm text-slate-600">Cardholder Name</label>
                    <input type="text" name="card_name" value="{{ old('card_name') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="Name on card">

                    <label class="mb-1 mt-2 block text-sm text-slate-600">Card Number</label>
                    <input type="text" name="card_number" value="{{ old('card_number') }}" maxlength="19" inputmode="numeric" autocomplete="cc-number" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="4242 4242 4242 4242">

                    <div class="mt-2 grid grid-cols-2 gap-4">
                        <div>
                            <label class="mb-1 block text-sm text-slate-600">Expiry Month</label>
                            <select name="card_exp_month" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                                <option value="">MM</option>
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ sprintf('%02d', $m) }}" {{ old('card_exp_month') == sprintf('%02d', $m) ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="mb-1 block text-sm text-slate-600">Expiry Year</label>
                            <select name="card_exp_year" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200">
                                <option value="">YYYY</option>
                                @php $year = now()->year; @endphp
                                @for($y = $year; $y <= $year + 10; $y++)
                                    <option value="{{ $y }}" {{ old('card_exp_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <label class="mb-1 mt-2 block text-sm text-slate-600">CVV / CVC</label>
                    <input type="password" name="card_cvv" value="{{ old('card_cvv') }}" maxlength="4" inputmode="numeric" autocomplete="cc-csc" class="w-1/3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="3 or 4 digits">

                    <label class="mb-1 mt-2 block text-sm text-slate-600">Transaction ID (optional)</label>
                    <input type="text" name="card_txn" value="{{ old('card_txn') }}" class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-slate-700 outline-none transition focus:border-slate-300 focus:bg-white focus:ring-2 focus:ring-slate-200" placeholder="Transaction id or last 4 digits">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="rounded-xl bg-slate-900 px-5 py-2 font-semibold text-white transition hover:bg-slate-800">
                    Generate Invoice
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    (function(){
        const select = document.getElementById('payment_method');
        const blocks = document.querySelectorAll('.payment-block');

        function showFor(method){
            blocks.forEach(b => {
                if (b.getAttribute('data-method') === method) {
                    b.classList.remove('hidden');
                } else {
                    b.classList.add('hidden');
                }
            });
        }

        if (select) {
            const current = select.value || '{{ old('payment_method') }}';
            if (current) showFor(current);
            select.addEventListener('change', e => showFor(e.target.value));
        }
    })();
</script>
@endsection
