<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginLogoutController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View
     */
    public function openLoginPage(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function logMeIn(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Login failed: ' . $e->getMessage());

            // Redirect back to login page with an error message
            return redirect()->route('lopenloginpage')->withErrors([
                'login' => 'An error occurred during login. Please try again.',
            ]);
        }
    }

    /**
     * Destroy an authenticated session and log the user out.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logMeOut(Request $request): RedirectResponse
    {
        try {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('lopenloginpage');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Logout failed: ' . $e->getMessage());

            // Redirect to a fallback page
            return redirect('/')->withErrors([
                'logout' => 'An error occurred during logout. Please try again.',
            ]);
        }
    }
}
