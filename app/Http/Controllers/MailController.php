<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MailController extends Controller
{
    public function verifyUser($code)
    {
        $user = User::where('verification_code', $code)->first();

        if (!$user) {
            abort(404, 'Invalid verification code.');
        }

        // Check if user is already verified
        if ($user->email_verified_at) {
            return redirect()->route('openloginpage')->with('status', 'Your account is already verified. You may log in.');
        }

        // Update the user record
        $user->update([
            'email_verified_at' => Carbon::now(),
            'verified' => 1,
            'verification_code' => null,
        ]);

        return redirect()->route('login')->with('status', 'Your account has been verified successfully. You may now log in.');
    }
}
