<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User; // Import the User model if not already imported

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if 'is_admin' is set in the session
        if (Session::has('is_admin')) {
            // Retrieve the user ID from the session
            $user_id = Session::get('user_id');
            // Retrieve the user by their ID
            $user = User::find($user_id);
            // Check if the user is an admin
            if ($user && $user->is_admin == 1) {
                // If the user is an admin, allow access to the route
                return $next($request);
            }
        }
        
        // If 'is_admin' is not set or user is not an admin, redirect to '/'
        return redirect('/');
    }
}
