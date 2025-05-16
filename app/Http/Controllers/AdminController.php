<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
class AdminController extends Controller

{

    public function ViewProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('users.view_profile', compact('userData'));

    }

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('users.edit_profile', compact('editData'));

    }

}

