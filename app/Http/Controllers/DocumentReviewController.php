<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\User;
use App\Models\DocumentReview;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentApprovedMail;
use App\Mail\DocumentAssignedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;


class DocumentReviewController extends Controller
{
  
   
 public function showPotentialReviewers($documentId)
{
    // Retrieve the document by its ID or fail with 404
    $document = Document::findOrFail($documentId);

    // Combine the title and abstract, convert to lowercase for keyword extraction
    $text = strtolower($document->title . ' ' . $document->abstract);

    // Remove punctuation, split into words, filter short words, and ensure uniqueness
    $keywords = collect(explode(' ', preg_replace('/[^a-zA-Z0-9\s]/', '', $text)))
        ->filter(fn($word) => strlen($word) > 4)
        ->unique();

    // Fetch users from the same department and school, excluding the document's author
    $users = User::where('id', '!=', $document->user_id)
        ->where('department_id', $document->department_id)
        ->where('school_id', $document->school_id)
        ->get();

    // Define the theoretical maximum score for normalization
    $maxScore = 10 + (count($keywords) * (5 + 3 + 4));

    // Score each user based on keyword matches
    $scoredReviewers = $users->map(function ($user) use ($keywords, $maxScore) {
        $score = 10; // Base score

        foreach ($keywords as $keyword) {
            if (stripos($user->specialization, $keyword) !== false) $score += 5;
            if (stripos($user->education, $keyword) !== false) $score += 3;
            if (stripos($user->research_interests, $keyword) !== false) $score += 4;
        }

        // Normalize score to 0–100
        $normalizedScore = ($maxScore > 0) ? round(($score / $maxScore) * 100) : 0;
        $user->match_score = $normalizedScore;

        return $user;
    });

    // Sort reviewers by match score
    $sortedReviewers = $scoredReviewers->sortByDesc('match_score')->values();

    // Count potential reviewers
    $reviewerCount = $sortedReviewers->count();

    // Return view with scored potential reviewers (not saved to DB)
    return view('dashboard.admin-dashboard.documents.potential-reviewers', [
        'document' => $document,
        'potentialReviewers' => $sortedReviewers,
        'reviewerCount' => $reviewerCount,
    ]);
}


public function assignReviewer(Request $request)
{
    // Step 1: Validate request
    $request->validate([
        'document_id' => 'required|exists:documents,id',
        'reviewer_id' => 'required|exists:users,id',
    ]);
  //  dd('Validation passed', $request->all());

    // Step 2: Find document and reviewer
    $document = Document::with('user')->findOrFail($request->document_id);
    //dd('Document found', $document);

    $reviewer = User::findOrFail($request->reviewer_id);
   // dd('Reviewer found', $reviewer);

    // Step 3: Check if user has a valid reviewer role_id (1, 3, or 4)
    $validReviewerRoleIds = [1, 3, 4];

if (!in_array($reviewer->role_id, $validReviewerRoleIds)) {
  //  dd('User is not a valid reviewer', $reviewer->role_id);
    return redirect()->back()->with('error', 'Selected user is not a valid reviewer.');
}

    //dd('User is a valid reviewer');


// Step 4: Check if document already has a reviewer assigned
$existingReviewer = DocumentReview::where('document_id', $document->id)
    ->whereNotNull('reviewer_id') // ensure it's truly assigned
    ->first();

if ($existingReviewer) {
    $assignedReviewer = User::find($existingReviewer->reviewer_id);
    $reviewerName = $assignedReviewer ? $assignedReviewer->name : 'Unknown';
    return redirect()->back()->with('warning', 'This document has already been assigned to reviewer: ' . $reviewerName);
}

    // Step 5: Create assignment
    $newAssignment = DocumentReview::create([
        'document_id' => $document->id,
        'reviewer_id' => $reviewer->id,
        'assigned_at' => now(),
        'status' => 'assigned',
    ]);
    //dd('Assignment created', $newAssignment);

    // Step 6: Send email
    try {
        Mail::to($document->user->email)->send(new DocumentAssignedMail($document, $reviewer));
        //dd('Email sent');
    } catch (\Exception $e) {
       // dd('Email sending failed', $e->getMessage());
        return redirect()->back()->with('warning', 'Reviewer assigned, but email failed to send.');
    }

    // Step 7: Done
   // dd('Everything successful');
    //return redirect()->back()->with('success', 'Reviewer assigned successfully and notified.');
    return redirect()->route('assigned.documents', ['documentId' => $document->id])
    ->with('success', 'Reviewer assigned successfully and notified.');

   
}





public function assignedDocuments($documentId)
{
    // Fetch the document along with its assigned reviewers
    $document = Document::with('assignedReviewers')->findOrFail($documentId);

    return view('dashboard.admin-dashboard.documents.assigned-reviewers', [
        'document' => $document,
        'reviewers' => $document->assignedReviewers
    ]);
}



}





