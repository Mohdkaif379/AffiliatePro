@extends('layout.app')

@section('title', 'Send Email')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 border-b border-slate-200 pb-5">
            <h2 class="text-3xl font-bold text-slate-900">
                <i class="fas fa-envelope mr-2 text-slate-700"></i>
                Send Offer Email
            </h2>
            <p class="mt-1 text-sm text-slate-500">Pick recipients and send the offer message in a clean, simple flow.</p>
        </div>

        @if(session('success'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-700">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-rose-700">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-rose-700">
            <ul class="list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form id="emailForm" action="{{ route('send.email.send.post', $offer) }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Select Recipients</label>
                <select id="emailSelect" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                    <option value="">Select an Email...</option>
                    <option value="__select_all__">Select All Emails</option>
                    @foreach($users as $user)
                        <option value="{{ $user->email }}">{{ $user->email }}</option>
                    @endforeach
                </select>

                <div class="mt-3 rounded-xl border border-slate-200 bg-slate-50 p-3">
                    <div class="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-500">Selected Emails</div>
                    <div id="selectedEmails" class="flex flex-wrap gap-2"></div>
                    <p id="emptyHint" class="text-sm text-slate-400">No recipients selected yet.</p>
                </div>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">Email Message</label>
                <textarea name="message" rows="8" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">I am {{ auth()->user()->full_name }}, and I hope this message finds you well.
We are delighted to inform you that a special offer has been created exclusively for you. This offer has been designed to provide you with maximum value and benefits, and we encourage you to take advantage of it at your earliest convenience.</textarea>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <button type="submit" id="submitBtn" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-6 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                    Send Email
                </button>

                <div class="text-sm text-slate-500">
                    Selected recipients are added as removable tags.
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const emailSelect = document.getElementById('emailSelect');
        const selectedEmailsDiv = document.getElementById('selectedEmails');
        const emptyHint = document.getElementById('emptyHint');
        const form = document.getElementById('emailForm');
        const submitBtn = document.getElementById('submitBtn');

        emailSelect.addEventListener('change', function() {
            const selectedEmail = this.value;

            if (selectedEmail === '__select_all__') {
                selectAllEmails();
                this.value = '';
                return;
            }

            if (selectedEmail && !isEmailAlreadySelected(selectedEmail)) {
                addSelectedEmail(selectedEmail);
                this.value = '';
            }
        });

        submitBtn.addEventListener('click', function(e) {
            const hiddenInputs = form.querySelectorAll('input[name="recipient_emails[]"]');
            if (hiddenInputs.length === 0) {
                e.preventDefault();
                alert('Please select at least one recipient email.');
                return false;
            }
        });

        function isEmailAlreadySelected(email) {
            const hiddenInputs = form.querySelectorAll('input[name="recipient_emails[]"]');
            return Array.from(hiddenInputs).some(input => input.value === email);
        }

        function addSelectedEmail(email) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'recipient_emails[]';
            hiddenInput.value = email;
            form.appendChild(hiddenInput);

            const emailTag = document.createElement('div');
            emailTag.className = 'inline-flex items-center gap-2 rounded-full bg-slate-900 px-3 py-2 text-sm font-medium text-white';
            emailTag.innerHTML = `<span>${email}</span>`;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'flex h-5 w-5 items-center justify-center rounded-full bg-white/15 text-xs font-bold text-white transition hover:bg-white/25';
            removeBtn.textContent = '×';
            removeBtn.addEventListener('click', function() {
                removeEmail(emailTag, email);
            });

            emailTag.appendChild(removeBtn);
            selectedEmailsDiv.appendChild(emailTag);
            emptyHint.classList.add('hidden');
        }

        function selectAllEmails() {
            Array.from(emailSelect.options).forEach(option => {
                const email = option.value;
                if (!email || email === '__select_all__') {
                    return;
                }

                if (!isEmailAlreadySelected(email)) {
                    addSelectedEmail(email);
                }
            });
        }

        window.removeEmail = function(tag, email) {
            const hiddenInputs = form.querySelectorAll('input[name="recipient_emails[]"]');
            hiddenInputs.forEach(input => {
                if (input.value === email) {
                    input.remove();
                }
            });

            tag.remove();

            if (!form.querySelector('input[name="recipient_emails[]"]')) {
                emptyHint.classList.remove('hidden');
            }
        };
    });
</script>
@endsection
