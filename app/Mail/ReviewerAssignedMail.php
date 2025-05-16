<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Document;

class ReviewerAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $document;

    /**
     * Create a new message instance.
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Document Has Been Assigned a Reviewer')
                    ->view('emails.document-assigned')
                    ->with([
                        'documentTitle' => $this->document->title,
                        'assignedAt' => $this->document->assigned_at,
                    ]);
    }
}
