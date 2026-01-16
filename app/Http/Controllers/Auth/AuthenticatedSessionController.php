<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /** Display Role-Specific Login Views */
    public function createAdmin(): View
    {
        return view('auth.login-admin');
    }
    public function createClient(): View
    {
        return view('auth.login-client');
    }
    public function createStaff(): View
    {
        return view('auth.login-staff');
    }

    /** Handle Role-Specific Login Requests */
    public function storeAdmin(LoginRequest $request): RedirectResponse
    {
        return $this->processLogin($request, 'admin');
    }
    public function storeClient(LoginRequest $request): RedirectResponse
    {
        return $this->processLogin($request, 'client');
    }
    public function storeStaff(LoginRequest $request): RedirectResponse
    {
        return $this->processLogin($request, 'staff');
    }

    /** Unified Login Logic with Role and Status Check */
    protected function processLogin(LoginRequest $request, $expectedType): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();

        // 1. Role Match Check
        if ($user->type !== $expectedType) {
            Auth::guard('web')->logout();
            return redirect()->route("login.$expectedType")->withErrors(['email' => "This login is for $expectedType only."]);
        }

        // 2. Status Approval Check (Admin is always active)
        if ($user->status !== 'active' && $user->type !== 'admin') {
            Auth::guard('web')->logout();
            return redirect()->route("login.$expectedType")->withErrors(['email' => "Your account is currently $user->status. Please wait for Admin approval."]);
        }

        // 3. Success Redirect
        return match ($user->type) {
            'client' => redirect()->intended(route('client.dashboard')),
            'staff' => redirect()->intended(route('staff.dashboard')),
            default => redirect()->intended(route('admin.dashboard')),
        };
    }

    /** Logout */
    public function destroy(Request $request): RedirectResponse
    {
        $type = Auth::user()?->type ?? 'client';
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("login.$type");
    }
}
