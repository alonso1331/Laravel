<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected Contact $contact,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Notify',
        );
    }

    /**
     * Get the message content definition.
     */
    // laravel 10
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
            with: [
                'contactname' => $this->contact->name,
                'contactphone' => $this->contact->phone,
                'contactemail' => $this->contact->email,
                'contactmessage' => $this->contact->message
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

    //laravle 8 的用法
    // /**
    //  * Build the message.
    //  *
    //  * @return $this
    //  */
    // public function build()
    // {
    //     return $this->view('emails.contact');
    // }
}
