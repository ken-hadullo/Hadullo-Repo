<?php

namespace App\Http\Controllers;

use App\Notifications\DocumentUploaded;
use App\Models\User;
use App\Models\Document;
use App\Models\School;
use App\Models\Department;
use App\Models\PropoLevel;
use App\Models\ResearchRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;


class DocumentsManagementController extends Controller
{


    public function viewDocuments()
    {
        $user = auth()->user();
    
        // Eager load all necessary relationships
        $query = Document::with(['review', 'review.reviewer', 'user', 'pLevel', 'researchRole']);
    
        // Admins see all documents, others only their own or assigned ones
        $documents = $user->role_id == 1
            ? $query->latest()->cursorPaginate(6)
            : $query->where(function($q) use ($user) {
                $q->where('user_id', $user->id)
                  ->orWhereHas('review', function($q) use ($user) {
                      $q->where('reviewer_id', $user->id);
                  });
              })->latest()->cursorPaginate(100);
    
        $documentCount = Document::count();
        $isDocumentOwner = $user->role_id == 1 || Document::where('user_id', $user->id)->exists();
    
        return view('dashboard.admin-dashboard.documents.index', compact('documents', 'documentCount', 'isDocumentOwner'));
    }



    // Show Form1
public function showForm1()
{
    $proposal_levels = PropoLevel::all();  
    $research_roles = ResearchRole::all();
    $schools = School::orderBy('name', 'ASC')->get();
    $departments = Department::where('id', '<=', 17)->get();
   // return view('dashboard.profiles.index', compact('user', 'data', 'schools', 'research_themes', 'departments'));

    return view('dashboard.admin-dashboard.documents.form1', compact('proposal_levels', 'research_roles', 'schools', 'departments'));
}     


// Process Form1 and redirect to Form2
public function processForm1(Request $request)
{
    $validatedData = $request->validate([
        'proposal_title' => 'required|string|max:255',
        'abstract' => 'required|string|max:4000', // allow longer abstract
        'proposal_level_id' => 'required|integer',
        'research_role_id' => 'required|integer',
        'school_id' => 'required|integer',
        'department_id' => 'required|integer',
    ]);
    

    // Store form data in session
    session(['form1_data' => $validatedData]);

    //return redirect()->route('dashboard.admin.documents.form2');
    //return redirect()->route('form2');
    return redirect()->route('form2')->with('success', 'Form 1 Processed. Proceed to upload documents.');
}

// Show Form2
public function showForm2()
{
    // Retrieve Form1 data from session
    $form1Data = session('form1_data');

    if (!$form1Data) {
        return redirect()->route('form1')->with('error', 'Please complete Form 1 first.');
    }

    return view('dashboard.admin-dashboard.documents.form2');
}


      

    // Handle Uploads and Save All Data
    public function storeDocuments(Request $request)
    {
        $form1Data = session('form1_data');

        if (!$form1Data) {
            return redirect()->route('form1')->with('error', 'Please fill in Form 1 first.');
        }

        // Validate file inputs
        $validatedData = $request->validate([
            'proposal_doc' => 'required|file|mimes:pdf,doc,docx',
            'ethical_approval' => 'required|file|mimes:pdf,doc,docx',
            'payment_receipt' => 'required|file|mimes:pdf,jpg,jpeg,png,gif',
            'plagiarism_report' => 'required|file|mimes:pdf,doc,docx',
            'applicants_cvs' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png,gif',
            'comments' => 'nullable|string',
        ]);
        

        // Authenticated user
        $user_id = auth()->id();

        // Upload directory
        $uploadPath = public_path('uploads/documents');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // File paths
        $filePaths = [
            'proposal_doc_path' => $request->hasFile('proposal_doc') ?
                'uploads/documents/' . time() . '_proposal.' . $request->file('proposal_doc')->getClientOriginalExtension() : null,

            'ethical_approval_path' => $request->hasFile('ethical_approval') ?
                'uploads/documents/' . time() . '_ethical.' . $request->file('ethical_approval')->getClientOriginalExtension() : null,

            'payment_receipt_path' => $request->hasFile('payment_receipt') ?
                'uploads/documents/' . time() . '_receipt.' . $request->file('payment_receipt')->getClientOriginalExtension() : null,

            'plagiarism_report_path' => $request->hasFile('plagiarism_report') ?
                'uploads/documents/' . time() . '_plagiarism.' . $request->file('plagiarism_report')->getClientOriginalExtension() : null,

            'applicants_cv_path' => $request->hasFile('applicants_cvs') ?
                'uploads/documents/' . time() . '_cv.' . $request->file('applicants_cvs')->getClientOriginalExtension() : null,
        ];

        // Move files
        foreach ($filePaths as $key => $path) {
            if ($path && $request->hasFile(str_replace('_path', '', $key))) {
                $request->file(str_replace('_path', '', $key))->move($uploadPath, basename($path));
            }
        }

        // Save to DB
        $document = new Document();
        $document->user_id = $user_id;
        $document->proposal_title = $form1Data['proposal_title'];
        $document->abstract = $form1Data['abstract'];
        $document->research_role_id = $form1Data['research_role_id'];
        $document->school_id = $form1Data['school_id'];
        $document->department_id = $form1Data['department_id'];
        $document->proposal_level_id = $form1Data['proposal_level_id'];
        $document->proposal_doc_path = $filePaths['proposal_doc_path'];
        $document->ethical_approval_path = $filePaths['ethical_approval_path'];
        $document->payment_receipt_path = $filePaths['payment_receipt_path'];
        $document->plagiarism_report_path = $filePaths['plagiarism_report_path'];
        $document->applicants_cv_path = $filePaths['applicants_cv_path'];
        $document->comments = $validatedData['comments'];

        if ($document->save()) {
            $users = User::whereIn('role_id', [1, 3])->get();
            Notification::send($users, new DocumentUploaded($document));

            session()->forget('form1_data');

            return redirect()->route('documents.index')->with('success', 'Research Document post created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to upload the document.');
        }
    }
}





