<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\School;
use App\Models\Department;
use App\Models\ResearchTheme;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class ProfileManagerController extends Controller
{
    //Opens Edit Personal Profile Page
    public function editProfile(User $user){
    $user = auth()->user();
    $data['user'] = $user;

    $schools = School::orderBy('name', 'ASC')->get();
    $research_themes = ResearchTheme::all();
   // $departments = Department::all();
    $departments = Department::where('id', '<=', 17)->get();
    return view('dashboard.profiles.index', compact('user', 'data', 'schools', 'research_themes', 'departments'));

    }

    public function updateField(Request $request, $id, $field)
    {
        
        // Debug: Check the incoming request data
        //($request->all());
        $user = User::findOrFail($id);

        // Define allowed fields for update to prevent mass assignment or malicious updates
        $allowedFields = ['title', 'name',  'phone', 'specialization'];

        if (!in_array($field, $allowedFields)) {
            return redirect()->back()->with('error', 'Invalid field update attempt.');
        }

        // Validation rules per field
        $validationRules = [
            'title' => 'required|in:Mr.,Mrs.,Miss,Dr.,Prof.',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
        ];

        // Validate only the field being updated
        $request->validate([
            $field => $validationRules[$field],
        ]);

        // Update the specific field
        $user->$field = $request->input($field);
        $user->save();

        return redirect()->back()->with('success', ucfirst($field) . ' updated successfully.');
    }

    // Uploads Profile Picture
public function updatePhoto(Request $request)
{
    $request->validate([
        'avatar' => 'sometimes|file|image|max:2048', // Ensure it's a valid image file with a reasonable size limit
    ]);

    // Check if a file was uploaded
    if ($request->hasFile('avatar')) {
        $image = $request->file('avatar');

        // Generate a unique filename
        $filename = 'uasu' . time() . '.' . $image->getClientOriginalExtension();

        // Save the full-size image
        $fullSizePath = public_path('uploads/avatar_full/');
        $image->move($fullSizePath, $filename);

        // Resize and save the avatar
        $resizedAvatarPath = public_path('uploads/avatars/');
        $avatarResize = Image::make($fullSizePath . $filename)
            ->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
        $avatarResize->save($resizedAvatarPath . $filename);

        // Update user's avatar in the database
        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();

        return redirect()->back()->with('success', 'Profile Photo Updated Successfully');
    }

    return redirect()->back()->with('error', 'No avatar uploaded. Please try again.');
}

      // Update School 
      public function updateSchool(Request $request)
      {
          $request->validate([
              'school_id' => 'sometimes|nullable',
              
          ]);
      
          $user_id = Auth::id(); // Simplified user ID retrieval
          $user = User::findOrFail($user_id);
      
          // Update only the provided inputs
          if ($request->filled('school_id')) {
              $user->school_id = $request->input('school_id');
          }   
      
          $user->save();
          return redirect()->back()->with('success', 'School or Institute has been successfully updated');
      }

            // Update Department 
            public function updateDepartment(Request $request)
            {
                $request->validate([
                    'department_id' => 'sometimes|nullable',
                    
                ]);
            
                $user_id = Auth::id(); // Simplified user ID retrieval
                $user = User::findOrFail($user_id);
            
                // Update only the provided inputs
                if ($request->filled('department_id')) {
                    $user->department_id = $request->input('department_id');
                }   
            
                $user->save();
                return redirect()->back()->with('success', 'Department has been successfully updated');
            }


            public function updateSpecialization(Request $request)
            {
                // Debugging: Dump the raw request data before validation
               // dd('Raw Request Data:', $request->all());
            
                // Validate that specialization is a valid input, but make it optional
                $validated = $request->validate([
                    'research_theme_id' => 'sometimes|nullable|string',  // Allows empty input or a valid string
                ]);
            
                // Debugging: Check the validated data
               // dd('Validated Data:', $validated);
            
                $user_id = Auth::id(); // Get the authenticated user's ID
                
                // Debugging: Check the authenticated user's ID
              //  dd('Authenticated User ID:', $user_id);
            
                $user = User::findOrFail($user_id);
            
                // Debugging: Dump the user's data before update
                //dd('User Data before update:', $user);
            
                 // Only update specialization_id if it's provided
                 if ($request->filled('research_theme_id')) {
                    // Update the user's research_theme_id
                    $user->research_theme_id = $request->input('research_theme_id');
            
                    // Save the updated data to the database
                    $user->save();  // This is where the user data gets saved
                }
            
                // Return a success message
                return redirect()->back()->with('success', 'Thematic area has been successfully updated');
            }

            // Update Education
public function updateEducation(Request $request)
{
    // Validate the education field, making it optional
    $request->validate([
        'education' => 'sometimes|nullable|string', // Allows education field to be optionally updated with a string
    ]);

    $user_id = Auth::id(); // Cleaner and more concise way to get the authenticated user's ID
    $user = User::findOrFail($user_id);

    // Only update the education field if it is provided
    if ($request->filled('education')) {
        $user->education = $request->input('education');
    }

    $user->save();

    return redirect()->back()->with('success', 'Your Academic Qualifications have been successfully updated');
}
            
      
public function updateResearchInterests(Request $request)
{
    $request->validate([
        'research_interests' => 'nullable|string|max:5000',
    ]);

    $user = auth()->user(); // or fetch user as needed
    $user->research_interests = $request->input('research_interests');
    $user->save();

    return redirect()->back()->with('success', 'Research interests updated successfully.');
}



    public function confirmProfileUpdate(Request $request)
{
    $user = Auth::user();

    // Debug current user values before any condition
   // dd([
      //  'department_id' => $user->department_id,
      //  'school_id' => $user->school_id,
    //]);

    // Check if either field is null or empty
    if (empty($user->department_id) || empty($user->school_id)) {
        return redirect()->back()->with('warning', 'Please complete your profile before confirming.');
    }

    $user->profile_updated = 1;

    if ($user->save()) {
        return redirect()->route('dashboard')->with('success', 'Profile update confirmed.You can now proceed to upload document
        !');
    } else {
        return redirect()->back()->with('error', 'Failed to confirm profile update.');
    }
}

    public function updateStaffStdID(Request $request, $id) {
        $request->validate([
            'staff_std_id' => "required|unique:users,staff_std_id|regex:/^[A-Za-z0-9_-]+$/",
        ]);
    
        $user = User::findOrFail($id);
        $user->staff_std_id = $request->staff_std_id;
        $user->save();
    
        return redirect()->back()->with('success', 'Staff/Student ID updated successfully!');
    }
    
}