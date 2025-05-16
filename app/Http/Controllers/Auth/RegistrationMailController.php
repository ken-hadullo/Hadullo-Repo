<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\UserSignEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class RegistrationMailController extends Controller
{
    public static function sendUserSignEmail($name, $email, $password, $verification_code)

    {

    //Define your Admin Email
    //$admin_email = "info@uasutum.net";

    // Call mailable
    //Pass Data from Form
    $data = [
        'name'=>$name,
        'email'=>$email,
        'password'=>$password,
        'verification_code'=>$verification_code,
    ];

    Mail::to($email)->send(new UserSignEmail($data));

    return back()->with('success','Your account has been successfuly created and an email sent to your inbox. Please Log into
     your email account to activate your account');
}


}

