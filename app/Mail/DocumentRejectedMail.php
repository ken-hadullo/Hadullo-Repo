<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;

class DocumentRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $document;
    public $rejection_message;

    public function __construct(Document $document, $rejection_message)
    {
        $this->document = $document;
        $this->rejection_message = $rejection_message;
    }

    public function build()
    {
        return $this->subject('Your Document Has Been Rejected')
                    ->view('emails.document-rejected')
                    ->with([
                        'documentTitle' => $this->document->proposal_title,
                        'rejectionReason' => $this->rejection_message,
                        'rejectedAt' => $this->document->rejected_at,
                    ]);
    }
}
