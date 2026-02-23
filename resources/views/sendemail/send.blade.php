@extends('layout.app')

@section('title', 'Send Email')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-gray-900 p-6 rounded-xl border border-yellow-600/40">

    <h2 class="text-2xl font-extrabold mb-6 text-yellow-500">
        <i class="fas fa-envelope mr-2"></i>
        Send Offer Email
    </h2>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-900/40 text-green-400 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-3 bg-red-900/40 text-red-400 rounded">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="mb-4 p-3 bg-red-900/40 text-red-400 rounded">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="emailForm" action="{{ route('send.email.send.post', $offer) }}" method="POST">
        @csrf

        <!-- Recipient Emails -->
        <div class="mb-4">
            <label class="text-gray-300">Select Recipients</label>
            <select id="emailSelect" name="emails" class="w-full bg-gray-800 text-white border border-gray-700 rounded px-4 py-2">
                <option value="">Select an Email...</option>
                <option value="__select_all__">Select All Emails</option>
                @foreach($users as $user)
                <option value="{{ $user->email }}">{{ $user->email }}</option>
                @endforeach
            </select>
            <div id="selectedEmails" class="mt-2"></div>
        </div>

        <!-- Message -->
        <div class="mb-4">
            <label class="text-gray-300">Email Message</label>
            <textarea name="message" rows="8"
                class="w-full bg-gray-800 text-white border border-gray-700 rounded px-4 py-2">
I am {{ auth()->user()->full_name }}, and I hope this message finds you well.
We are delighted to inform you that a special offer has been created exclusively for you. This offer has been designed to provide you with maximum value and benefits, and we encourage you to take advantage of it at your earliest convenience.
</textarea>

        </div>

        <button type="submit"
            class="bg-yellow-500 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-400">
            Send Email
        </button>

    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailSelect = document.getElementById('emailSelect');
    const selectedEmailsDiv = document.getElementById('selectedEmails');
    const form = document.getElementById('emailForm');
    const submitBtn = document.getElementById('submitBtn');

    emailSelect.addEventListener('change', function() {
        const selectedEmail = this.value;
        if (selectedEmail === '__select_all__') {
            selectAllEmails();
            this.value = ''; // Reset dropdown
            return;
        }

        if (selectedEmail && !isEmailAlreadySelected(selectedEmail)) {
            addSelectedEmail(selectedEmail);
            this.value = ''; // Reset dropdown
        }
    });

    if (submitBtn) {
        submitBtn.addEventListener('click', function(e) {
            const hiddenInputs = form.querySelectorAll('input[name="recipient_emails[]"]');
            if (hiddenInputs.length === 0) {
                e.preventDefault();
                alert('Please select at least one recipient email.');
                return false;
            }
        });
    }

    function isEmailAlreadySelected(email) {
        const hiddenInputs = form.querySelectorAll('input[name="recipient_emails[]"]');
        return Array.from(hiddenInputs).some(input => input.value === email);
    }

    function addSelectedEmail(email) {
        // Create hidden input
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'recipient_emails[]';
        hiddenInput.value = email;
        form.appendChild(hiddenInput);

        // Create display element
        const emailDiv = document.createElement('div');
        emailDiv.className = 'inline-block bg-yellow-600 text-white px-2 py-1 rounded mr-2 mb-2';
        emailDiv.innerHTML = `${email} <span class="cursor-pointer ml-1" onclick="removeEmail(this, '${email}')">&times;</span>`;
        selectedEmailsDiv.appendChild(emailDiv);
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

    window.removeEmail = function(span, email) {
        // Remove hidden input
        const hiddenInputs = form.querySelectorAll('input[name="recipient_emails[]"]');
        hiddenInputs.forEach(input => {
            if (input.value === email) {
                input.remove();
            }
        });

        // Remove display element
        span.parentElement.remove();
    };
});
</script>
@endsection
