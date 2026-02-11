<?php

namespace App\Http\Controllers\SendEmail;

use App\Http\Controllers\Controller;
use App\Mail\OfferMail;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function send(Offer $offer)
    {
        $loggedInUserId = Auth::id(); // Currently logged-in user

        // Fetch users whose role is NOT admin and exclude logged-in user
        $users = User::whereHas('roleDetail', function ($query) {
            $query->where('name', '!=', 'admin');
        })
            ->where('id', '!=', $loggedInUserId)
            ->get();

        return view('sendemail.send', compact('offer', 'users'));
    }

    public function sendEmail(Request $request, Offer $offer)
    {
        $request->validate([
            'recipient_emails' => 'required|array|min:1',
            'recipient_emails.*' => 'email',
            'message' => 'required|string',
        ]);

        $recipientEmails = $request->input('recipient_emails');
        $message = $request->input('message');

        // Generate the random URL link for the email with user_id
        $randomUrlLink = route('offers.show', $offer->random_url) . '?user_id=' . auth()->id();

        // Send the email to all selected recipients
        foreach ($recipientEmails as $email) {
            Mail::to($email)->send(new OfferMail($message, $randomUrlLink));
        }

        return redirect()->back()->with('success', 'Emails sent successfully!');
    }
}
