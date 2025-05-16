<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ProjectMan;
use App\Models\ProjCat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use App\Mail\VerificationEmail;

use App\Models\User;

use App\Models\Role;
use Carbon\Carbon;

class SpecialitiesController extends Controller
{


    
	
	public function Mechanical() {
        // Define the terms to search for in vocations and subjects
        $searchTerms = [
           
            'department' => ['mechanical', 'automotive', 'marine'] 

        ];
    
        // Build the query
        $members = User::query();
    
     
        // Add where conditions for subjects
        foreach ($searchTerms['department'] as $term) {
            $members->orWhere('department', 'LIKE', "%{$term}%");
        }
       
    
        // Paginate the results
        $members = $members->paginate(8);
    
        // Return the view with the members data
        return view('front.research.mechanical.index', compact('members'));
    }
    

    

	public function Building() {
        // Define the terms to search for in vocations and subjects
        $searchTerms = [
           
            'department' => ['building', 'civil'],

        ];
    
        // Build the query
        $members = User::query();
    
     
        // Add where conditions for subjects
        foreach ($searchTerms['department'] as $term) {
            $members->orWhere('department', 'LIKE', "%{$term}%");
        }
       
    
        // Paginate the results
        $members = $members->paginate(8);
    
        // Return the view with the members data
        return view('front.research.building.index', compact('members'));
    }
    


    public function Electrical() {
        // Define the terms to search for in vocations and subjects
        $searchTerms = [
           
            'department' => ['electrical', 'electronics'],

        ];
    
        // Build the query
        $members = User::query();
    
     
        // Add where conditions for subjects
        foreach ($searchTerms['department'] as $term) {
            $members->orWhere('department', 'LIKE', "%{$term}%");
        }
       
    
        // Paginate the results
        $members = $members->paginate(8);
    
        // Return the view with the members data
        return view('front.research.electrical.index', compact('members'));
    }
    
 

    public function MedicalEngineering() {
        // Define the terms to search for in vocations and subjects
        $searchTerms = [
           
            'department' => ['medical', 'engineering']

        ];
    
        // Build the query
        $members = User::query();
    
     
        // Add where conditions for subjects
        foreach ($searchTerms['department'] as $term) {
            $members->orWhere('department', 'LIKE', "%{$term}%");
        }
        
    
        // Paginate the results
        $members = $members->paginate(8);
    
        // Return the view with the members data
        return view('front.research.medical.index', compact('members'));
    }



        
	
	public function Architecture() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['architecture']

    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
   

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.architecture.index', compact('members'));
}


public function AccFin() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['accounting', 'finance']

    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
    

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.accounting.index', compact('members'));
}



public function ManSci() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['management', 'science']

    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
    

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.management.index', compact('members'));
}


public function BusAdmin() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['business', 'administration']
    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
    
    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.busadmin.index', compact('members'));
}




public function PurApp() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['pure', 'applied'],
       

    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
   

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.pureapplied.index', compact('members'));
}



public function MathsPhysics() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['maths', 'physics'],
       

    ];

    // Build the query
    $members = User::query();

    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
 
    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.mathsphysics.index', compact('members'));
}



public function MedicalSciences() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['medical', 'sciences'],

    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
   

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.medsciences.index', compact('members'));
}


public function Environmental() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['environmental', 'sciences'],

    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
    

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.environmental.index', compact('members'));
}



public function CommunicationStudies()
{
    // Define the terms to search for in department and schools
    $searchTerms = [
        'department' => ['communication', 'studies']
        
    ];

    // Build the query
    $members = User::query();

   // Add where conditions for subjects
   foreach ($searchTerms['department'] as $term) {
    $members->orWhere('department', 'LIKE', "%{$term}%");
}

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.communication.index', compact('members'));
}


public function Hospitality() {
    // Define the terms to search for in vocations and subjects
    $searchTerms = [
       
        'department' => ['hospitality', 'tourism'],


    ];

    // Build the query
    $members = User::query();

 
    // Add where conditions for subjects
    foreach ($searchTerms['department'] as $term) {
        $members->orWhere('department', 'LIKE', "%{$term}%");
    }
   

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.hospitality.index', compact('members'));
}


public function SocialSciences() {
    // Define the terms to search for in departments and subjects
    $searchTerms = [
        'department' => ['social', 'sciences'],
    ];

    // Build the query
    $members = User::query();

    // Filter by department using whereIn
    $members->where(function ($query) use ($searchTerms) {
        $query->whereIn('department', $searchTerms['department']);
    });

    

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.socialsciences.index', compact('members'));
}


public function ComputingInformatics() {
    // Define the terms to search for in the "department" column
    $searchTerms = ['computer', 'science', 'information', 'technology'];

    // Build the query
    $members = User::query();

    // Group the OR conditions
    $members->where(function ($query) use ($searchTerms) {
        foreach ($searchTerms as $term) {
            $query->orWhere('department', 'LIKE', "%{$term}%");
        }
    });

    // Paginate the results
    $members = $members->paginate(8);

    // Return the view with the members data
    return view('front.research.computing.index', compact('members'));
}





}
