<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageText;
    public $offerUrl;

    public function __construct($messageText, $offerUrl)
    {
        $this->messageText = $messageText;
        $this->offerUrl = $offerUrl;
    }

    public function build()
    {
        return $this->subject('Offer Details')
            ->view('emails.offer')
            ->with([
                'messageText' => $this->messageText,
                'offerUrl' => $this->offerUrl
            ]);
    }
}
