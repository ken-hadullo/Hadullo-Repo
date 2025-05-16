<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentReview;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentApprovedMail;
use App\Mail\DocumentRejectedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DocumentApprovedNotification;
use App\Notifications\DocumentOwnerApprovedNotification;

class DocumentEvaluationController extends Controller
{

    public function approveDocument($documentId)
    {
        // Find the document
        $document = Document::findOrFail($documentId);

        // Check if a review already exists
        $review = DocumentReview::where('document_id', $documentId)->first();

        // If already approved, prevent duplication
        if ($review && $review->status === 'approved') {
            return redirect()->route('documents.index')->with('status', 'This document is already approved.');
        }

        // Approve the document review
        $review = DocumentReview::updateOrCreate(
            ['document_id' => $documentId], // Search by document_id
            [
                'title' => $document->title,
                'approved_at' => now(),
                'status' => 'approved',
                //'reviewer_id' => auth()->id(), // Assuming logged-in user is approving
            ]
        );

        // Send email notification to document owner
    Mail::to($document->user->email)->send(new DocumentApprovedMail($document));

     
// Send notifications to admins (role_id 1) and reviewers (role_id 3)
$notifiableUsers = User::whereIn('role_id', [1, 3])->get();
Notification::send($notifiableUsers, new DocumentApprovedNotification($document, auth()->user()));

// Also notify the document owner
$document->user->notify(new DocumentOwnerApprovedNotification($document));

    return redirect()->route('documents.index')->with('success', 'Document approved successfully. An email notification has been sent.');
}

public function reviewStatus()
{
    // Get the latest review status for each document
    $latestReviews = DocumentReview::with(['document', 'reviewer'])
        ->select('document_id', DB::raw('MAX(created_at) as latest_review'))
        ->groupBy('document_id')
        ->get()
        ->keyBy('document_id');

    // Get the full review records for these latest entries
    $documentReviews = DocumentReview::with(['document', 'reviewer'])
        ->whereIn('id', function($query) {
            $query->select(DB::raw('MAX(id)'))
                  ->from('document_reviews')
                  ->groupBy('document_id');
        })
        ->get();

    // Group documents by their current status
    $groupedDocuments = $documentReviews->groupBy('status');

    return view('dashboard.admin-dashboard.documents.review-status', [
        'groupedDocuments' => $groupedDocuments,
    ]);
}

   

    public function rejectDocument(Request $request, $documentId)
{
    // Validate the rejection message
    $request->validate([
        'rejection_message' => 'required|string|max:1000',
    ]);

    // Find the document
    $document = Document::find($documentId);

    if (!$document) {
        return response()->json(['message' => 'Document not found'], 404);
    }

    // Create a new document review with status 'rejected'
    $review = new DocumentReview();
    $review->document_id = $document->id;
    $review->reviewer_id = auth()->id(); // Assuming reviewer is authenticated
    $review->status = 'rejected';
    $review->rejection_message = $request->input('rejection_message'); // Save the message
    $review->save();

   // return response()->json(['message' => 'Document rejected successfully.'], 200);

     // Send email notification only if the document has a related user
     if ($document->user) {
        Mail::to($document->user->email)
            ->send(new DocumentRejectedMail($document, $request->rejection_message));
    }

    return redirect()->route('documents.index')
        ->with('success', 'Document review rejected successfully. The author has been notified.');
}
   
    

public function viewDocRequirements($id)
{
    $document = Document::findOrFail($id);

    $review = DocumentReview::with('document')->where('document_id', $id)->first();

    return view('dashboard.admin-dashboard.documents.requirements', compact('document', 'review'));
}


}
