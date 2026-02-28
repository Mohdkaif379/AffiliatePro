@extends('layout.app')

@section('title', 'Billing')

@section('content')
<div class="min-h-screen bg-gray-900 p-6">
    <div class="max-w-2xl mx-auto bg-gray-800 rounded-xl shadow-lg p-6 text-white">
        <h1 class="text-2xl font-bold text-yellow-500 mb-6">Billing Form</h1>

        <form method="POST" action="{{ route('accountant.invoice.generate') }}" target="_blank" class="space-y-5">
            @csrf
            <input type="hidden" name="pdf" value="1">

            <div>
                <label for="user_id" class="block text-sm text-gray-300 mb-1">Select User</label>
                <select id="user_id" name="user_id" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" required>
                    <option value="">Choose user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->full_name }} ({{ $user->roleDetail->name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="from_date" class="block text-sm text-gray-300 mb-1">From Date</label>
                    <input id="from_date" type="date" name="from_date" value="{{ old('from_date') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
                    @error('from_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="to_date" class="block text-sm text-gray-300 mb-1">To Date</label>
                    <input id="to_date" type="date" name="to_date" value="{{ old('to_date') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
                    @error('to_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="payment_method" class="block text-sm text-gray-300 mb-1">Payment Method</label>
                <select id="payment_method" name="payment_method" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
                    <option value="">Choose payment method</option>
                    <option value="upi" {{ old('payment_method')=='upi' ? 'selected' : '' }}>UPI</option>
                    <option value="cash" {{ old('payment_method')=='cash' ? 'selected' : '' }}>Cash</option>
                    <option value="bank" {{ old('payment_method')=='bank' ? 'selected' : '' }}>Bank Transfer</option>
                    <option value="card" {{ old('payment_method')=='card' ? 'selected' : '' }}>Card</option>
                </select>
                @error('payment_method')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div id="payment-fields" class="space-y-4 mt-4">
                <div class="payment-block hidden" data-method="upi">
                    <label class="block text-sm text-gray-300 mb-1">UPI ID</label>
                    <input type="text" name="upi_id" value="{{ old('upi_id') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="example@bank">
                </div>

                <div class="payment-block hidden" data-method="cash">
                    <label class="block text-sm text-gray-300 mb-1">Receipt # / Notes</label>
                    <input type="text" name="cash_receipt" value="{{ old('cash_receipt') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="Receipt number or notes">
                </div>

                <div class="payment-block hidden" data-method="bank">
                    <label class="block text-sm text-gray-300 mb-1">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="Bank name">
                    <label class="block text-sm text-gray-300 mb-1 mt-2">Account Number</label>
                    <input type="text" name="bank_account" value="{{ old('bank_account') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="Account number">
                    <label class="block text-sm text-gray-300 mb-1 mt-2">IFSC / Routing</label>
                    <input type="text" name="bank_ifsc" value="{{ old('bank_ifsc') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="IFSC code">
                </div>

                <div class="payment-block hidden" data-method="card">
                    <label class="block text-sm text-gray-300 mb-1">Cardholder Name</label>
                    <input type="text" name="card_name" value="{{ old('card_name') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="Name on card">

                    <label class="block text-sm text-gray-300 mb-1 mt-2">Card Number</label>
                    <input type="text" name="card_number" value="{{ old('card_number') }}" maxlength="19" inputmode="numeric" autocomplete="cc-number" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="4242 4242 4242 4242">

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Expiry Month</label>
                            <select name="card_exp_month" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
                                <option value="">MM</option>
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ sprintf('%02d', $m) }}" {{ old('card_exp_month') == sprintf('%02d', $m) ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Expiry Year</label>
                            <select name="card_exp_year" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white">
                                <option value="">YYYY</option>
                                @php $year = now()->year; @endphp
                                @for($y = $year; $y <= $year + 10; $y++)
                                    <option value="{{ $y }}" {{ old('card_exp_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <label class="block text-sm text-gray-300 mb-1 mt-2">CVV / CVC</label>
                    <input type="password" name="card_cvv" value="{{ old('card_cvv') }}" maxlength="4" inputmode="numeric" autocomplete="cc-csc" class="w-1/3 bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="3 or 4 digits">

                    <label class="block text-sm text-gray-300 mb-1 mt-2">Transaction ID (optional)</label>
                    <input type="text" name="card_txn" value="{{ old('card_txn') }}" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" placeholder="Transaction id or last 4 digits">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-500 px-5 py-2 rounded font-semibold text-white">
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
            blocks.forEach(b=>{
                if(b.getAttribute('data-method')===method){
                    b.classList.remove('hidden');
                } else {
                    b.classList.add('hidden');
                }
            });
        }

        // initialize from old value if present
        if(select){
            const current = select.value || '{{ old('payment_method') }}';
            if(current) showFor(current);
            select.addEventListener('change', e=> showFor(e.target.value));
        }
    })();
</script>
@endsection
