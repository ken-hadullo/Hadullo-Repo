<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DocumentUploaded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $document;

    // Inject the document information into the notification
    public function __construct($document)
    {
        // Debug: Check the document being passed to the notification constructor
        // dd($document, 'Debugging: Document passed to notification constructor');

        $this->document = $document;
    }

    // Determine which channels the notification should be delivered on
    public function via($notifiable)
    {
        // Debug: Check the notifiable entity (e.g., User model)
        // dd($notifiable, 'Debugging: Notifiable entity in via method');

        return ['mail', 'database']; // Add 'database' channel
    }

    // Build the email notification
    public function toMail($notifiable)
    {
        // Debug: Check the document and notifiable entity before building the email
        // dd($this->document, $notifiable, 'Debugging: Document and Notifiable in toMail method');

        // Determine the recipient's role dynamically
        $recipientRole = match ($notifiable->role_id) {
            1 => 'Admin',
            3 => 'Reviewer',
            default => 'User',
        };

        return (new MailMessage)
            ->subject('New Document Uploaded: ' . $this->document->proposal_title)
            ->view('emails.document_uploaded', [
                'document' => $this->document,
                'recipientRole' => $recipientRole, // Pass the role to the email template
            ]);
    }

    // Store notification in the database
    public function toArray($notifiable)
    {
        // Define the notification data
        $notificationData = [
            'title' => 'New Document Uploaded',
            'message' => 'A new document titled "' . $this->document->proposal_title . '" has been uploaded.',
            'user' => $this->document->user->name,
            'department' => $this->document->user->department->name ?? 'Unknown Department',
            'research_role' => $this->document->researchRole->name,
            'proposal_level' => $this->document->proposalLevel->name,
            'document_url' => asset('uploads/documents/' . basename($this->document->proposal_doc_path)),
            'timestamp' => now(),
        ];

        // Debug: Check the data being stored in the database
        // dd($notificationData, 'Debugging: Data being stored in the database');

        // Return the notification data
        return $notificationData;
    }
}