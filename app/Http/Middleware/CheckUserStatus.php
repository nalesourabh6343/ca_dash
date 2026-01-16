<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // If user is not admin and status is not active, log them out immediately
            if ($user->type !== 'admin' && $user->status !== 'active') {
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                $type = $user->type ?? 'client';
                return redirect()->route("login.$type")->withErrors([
                    'email' => "Your account status is currently " . $user->status . ". Access denied.",
                ]);
            }
        }

        return $next($request);
    }
}
