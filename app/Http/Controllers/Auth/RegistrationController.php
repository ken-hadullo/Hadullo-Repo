<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class RegistrationController extends Controller
{
    // View Registered Users
    public function regPage(){
        return view('auth.register');
    }
    
    // Create and Store a User as a self-registered user
    public function store(Request $request)
    {
        // Validate form input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'staff_std_id' => 'required|string|unique:users,staff_std_id',
        'role_id' => 'required|in:2,3,4', // 2 = Applicant, 3 = Reviewer, 4= Committee
        'password' => [
            'required',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[A-Z])(?=.*\d).+$/', // At least one uppercase and one number
        ],
    ], [
        'password.regex' => 'Password must contain at least one uppercase letter and one number.',
    ]);
	

        // Grabbing Required user Data
        $name = $request->input('name');
        $email = $request->input('email');
		$staff_std_id = $request->input('staff_std_id');
		$role_id = $request->input('role_id');
        $password = $request->input('password');

        // Enabling CRUD operations with table
        $user = new User();
        $user->name = $name;
        $user->email = $email;
		$user->staff_std_id = $staff_std_id;
		$user->role_id = $role_id;
        $user->password = Hash::make($password); // Hash the password
        $user->verification_code = Str::random(32);
        $user->save();

        if($user !== null){
            // Send Email
        RegistrationMailController::sendUserSignEmail($user->name, $user->email, $password, $user->verification_code);
            // Show a message to the user(verification link)

            return redirect()->route('register')->with('status', 'The User has been Created and Email Sent');
        }

        return redirect()->back()->with('status', 'Something went wrong');
    }

    public function userVerification(Request $request, $code)
    {
        Log::info("Verification attempt for code: {$code}");

        $user = User::where(['verification_code' => $code])->first();

        if ($user) {
            if ($user->verified) {
                return redirect()->route('login')->with('status', 'Your account is already verified. Please login.');
            }

            DB::transaction(function () use ($user) {
                $user->verified = 1;
                $user->email_verified_at = Carbon::now();
                $user->save();
            });

            Log::info("User {$user->id} verified successfully.");

            return redirect()->route('login')->with('status', 'Your account is verified. Please login.');
        }

        Log::warning("Verification failed for code: {$code}");

        return redirect()->route('login')->with('status', 'Invalid verification code. Please try again.');
    }



    // Deleting a User
    public function AdminDestroyUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('status', 'User Deleted Successfully');
    }

    // Opens the Edit User Form
    public function AdminEditUser(User $user)
    {
        // Grabbing all roles and Displaying them on users page in Admin Dashboard
        // $roles = UserRole::all();
        return view('dashboard.users.edit', compact('user'));
    }

    // Create and Store a User by Admin
    public function adminCreate(Request $request)
    {
        // Debug the request data
    Log::info('Admin create user request:', $request->all());
    // or
    dd($request->all());
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role_id' => 'required|exists:roles,id', // Assuming you have a roles table
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $role_id = $request->input('role_id');
        $password = Str::random(8); // Automatically generate a password

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->role_id = $role_id;
        $user->password = Hash::make($password);
        $user->verification_code = Str::random(32);
        $user->save();

        if ($user !== null) {
            // Send Email with the generated password
            RegistrationMailController::sendUserSignEmail($user->name, $user->email, $password, $user->verification_code);
            return redirect()->route('users.index')->with('status', 'The User has been Created and Email Sent');
        }

        return redirect()->back()->with('status', 'Something went wrong');
    }
}

     