<?php

namespace App\Http\Controllers;
use App\Models\Document; // Import the model

use Illuminate\Http\Request;

use App\Models\ReviewerResponse;
use App\Models\DocumentReview;

class ReviewResponseController extends Controller
{
   
   // Function to display the form
   

public function showSDCSForm($id)
{
    $document = Document::findOrFail($id); // Fetch the document

    // Assuming the logged-in user is the reviewer
    $review = DocumentReview::where('document_id', $id)
        ->where('reviewer_id', auth()->id())
        ->firstOrFail();

    return view('dashboard.reviewers.documents.check-list', [
        'documentTitle' => $document->proposal_title,
        'review' => $review
    ]);
}



public function submitSDCS(Request $request, $reviewId)
{
    // Step 1: Dump the request data
    //dd($request->all()); 

    $request->validate([
        'sdcs_response' => 'required|string|max:5000',
    ]);

    // Step 2: Check if the review record exists
    $review = DocumentReview::findOrFail($reviewId);
    //dd($review); // Dump the retrieved review

    // Step 3: Dump the response before updating
    $sdcsResponse = $request->input('sdcs_response');
   // dd($sdcsResponse); // Dump user input before saving

    // Step 4: Perform the update and dump the result
    $review->update([
        'sdcs_response' => $sdcsResponse,
        'status' => 'in_review', // Optional: You can update status here
    ]);
    //dd($review); // Dump the review after update

    // Step 5: Redirect back
    return redirect()->back()->with('success', 'Your response has been submitted.');
}


}
