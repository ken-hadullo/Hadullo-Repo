<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProfileIsUpdated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Debugging optional
        // dd([
        //     'User ID' => $user->id,
        //     'Role ID' => $user->role_id,
        //     'Profile Updated' => $user->profile_updated,
        // ]);

        // Include role_id 1, 2, 3, or null
        if ($user && (in_array($user->role_id, [1, 3, 4]) || is_null($user->role_id)) && !$user->profile_updated) {
            return redirect()->route('profile.index')
                             ->with('warning', 'Please update your profile before proceeding.');
        }

        return $next($request);
    }
}
