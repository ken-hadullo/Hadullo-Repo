<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Mail\SignupEmail;
use Illuminate\Support\Facades\Mail;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['userVerification']);
    }

    // View Registered Users
    public function ViewUsers(User $user)
    {
        $users = User::latest()->paginate(6);
        return view('dashboard.admin.users.index', compact('users'));
    }

    // Opens the Edit User Form
    public function EditUser(User $user)
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('dashboard.admin.users.edit', compact('user', 'roles'));
    }

    // Edit and Save User Data
    public function UpdateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:role,id',
        ]);

        $name = $request->input('name');
        $userId = User::latest()->first() ? User::latest()->first()->id + 1 : 1;
        $slug = Str::slug($name, '-') . '-' . $userId;
        $email = $request->input('email');
        $role_id = $request->input('role_id');

        $user->name = $name;
        $user->email = $email;
        $user->role_id = $role_id;
        $user->save();

        return redirect()->route('users.index')->with('status', 'User updated successfully');
    }

    public function DestroyUser(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('status', 'User Deleted Successfully');
    }

    // Create a New User by Admin
    public function createUser()
    {
        $roles = Role::orderBy('name', 'ASC')->get();
        return view('dashboard.admin.users.create', compact('roles'));
    }

    public function RegisterUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'role_id' => 'required|exists:roles,id',
    ]);

    $password = Str::random(8);
    $verification_code = Str::random(8);

    try {
        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make($password),
            'verification_code' => $verification_code,
        ]);

        // Ensure the user was saved before proceeding
        if (!$user->exists) {
            DB::rollBack();
            return redirect()->back()->with('status', 'Something went wrong while creating the user');
        }

        DB::commit();

        // Send Email Asynchronously
        Mail::to($user->email)->send(new SignupEmail($user, $password));

        return redirect()->route('users.index')->with('status', 'The User has been Created and Email Sent');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('status', 'Something went wrong: ' . $e->getMessage());
    }
}

}
