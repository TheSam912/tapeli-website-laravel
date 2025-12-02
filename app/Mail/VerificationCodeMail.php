<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// (optional but nice for IDEs)
// use Illuminate\Mail\Mailables\Attachment;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var int|string */
    public $verificationCode;

    /**
     * Create a new message instance.
     */
    public function __construct($verificationCode) // or: int $verificationCode
    {
        $this->verificationCode = $verificationCode;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Login  Verification Code Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // change this to your actual view:
            view: 'email.verification-code',
            // and explicitly pass data (optional but clear)
            with: [
                'verificationCode' => $this->verificationCode,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
