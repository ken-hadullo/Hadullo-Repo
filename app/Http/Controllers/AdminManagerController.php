<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegistrationMailController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class AdminManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['userVerification']);
    }

    // View Registered Users
    public function viewUsers(User $user)
    {
        $users = User::latest()->paginate(6);
        return view('dashboard.admin-dashboard.users.index', compact('users'));
    }

      // Show User Creation Page
      public function createUser()
      {
          $roles = Role::orderBy('name', 'ASC')->get();
          return view('dashboard.admin-dashboard.users.create', compact('roles'));
      }

      // Create and Store a User by Admin
      public function adminStore(Request $request)
      {
          // Debug: Check if the request data is being received
          //dd($request->all()); // Inspect the entire request payload
      
          // Validate the request data
          $validatedData = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|max:255|unique:users,email',
              'role_id' => 'required|exists:roles,id', // Assuming you have a roles table
          ]);
      
          // Debug: Check if validation passed and the validated data
          //dd($validatedData); // Inspect the validated data

          // Debug: Check if validation passed and the validated data
        //dd('Validation Test Passed: Data is valid.', $validatedData); // Inspect the validated data
      
          // Extract validated data
          $name = $request->input('name');
          $email = $request->input('email');
          $role_id = $request->input('role_id');
          $password = Str::random(8); // Automatically generate a password
      
                // Debug: Check extracted data
       //       dd('Extracted Data Test Passed: Data extracted successfully.', [
         //    'name' => $name,
         //   'email' => $email,
         //   'role_id' => $role_id,
         //    'password' => $password,
        //    ]); // Inspect the extracted data
      
          // Create a new user
          $user = new User();
          $user->name = $name;
          $user->email = $email;
          $user->role_id = $role_id;
          $user->password = Hash::make($password);
          $user->verification_code = Str::random(32);
      
          // Debug: Check the user object before saving
          //dd($user); // Inspect the user object
      
          // Save the user to the database
          $user->save();
      
          // Debug: Check if the user was saved successfully
          //dd(User::find($user->id)); // Inspect the saved user from the database
      
          // Send Email (if applicable)
          try {
              RegistrationMailController::sendUserSignEmail($user->name, $user->email, $password, $user->verification_code);
          } catch (\Exception $e) {
              Log::error('Failed to send verification email: ' . $e->getMessage());
              return redirect()->back()->with('status', 'User created, but failed to send verification email.');
          }
      
          return redirect()->route('users.index')->with('status', 'The User has been Created and Email Sent');
      }







    public function DestroyUser(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('status', 'User Deleted Successfully');
    }




 
}

     