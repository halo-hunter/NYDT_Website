<?php

namespace App\Mail\Crm;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendRequestedDocumentListToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $mail_data;

    /**
     * Create a new message instance.
     */
    public function __construct($mail_data)
    {
        $this->mail_data = $mail_data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Document upload requested at NYDT.Law - Case ID: ' . $this->mail_data['case_id'] . ' - ' . config('app.name') . ' - ' . date('d-m-Y h:i'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'crm.mail.requested_documents.template',
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
