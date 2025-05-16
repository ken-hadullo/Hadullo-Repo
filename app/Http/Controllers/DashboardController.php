<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Document;

class DashboardController extends Controller
{
    public function redirect()
    {
        // Check if user is authenticated first
        if (!Auth::check()) {
            return redirect()->route('login')->with('status', 'Your session expired. Please log in again.');
        }

        $user = Auth::user(); // Safe to use now
        $users = User::latest()->simplePaginate(8);
        $users->count(); // This line is unnecessary as it's not stored or used

        switch ($user->role_id) {
            case '1': // Admin
                $documentCount = Document::count();
                return view('dashboard.admin-dashboard.index', compact('documentCount'));
        
            case '2': // Applicant
            case null:
                return view('dashboard.applicant-dashboard.index');
        
            case '3': // Reviewer
                return view('dashboard.reviewer-dashboard.index');
        
            case '4': // Committee
                return view('dashboard.committee-dashboard.index');
        
            default:
                // Unknown role, redirect or handle appropriately
                return redirect()->route('login')->with('status', 'Unknown role. Please contact support.');
        }
        
    }
}

