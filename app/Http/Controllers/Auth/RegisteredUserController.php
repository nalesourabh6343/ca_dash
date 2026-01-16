<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /** Display Client registration form */
    public function createClient(): View
    {
        return view('auth.register-client');
    }

    /** Display Staff registration form */
    public function createStaff(): View
    {
        return view('auth.register-staff');
    }

    /** Display Admin registration form */
    public function createAdmin(): View
    {
        return view('auth.register-admin');
    }

    /** Handle Client registration */
    public function storeClient(Request $request): RedirectResponse
    {
        return $this->processRegistration($request, 'client');
    }

    /** Handle Staff registration */
    public function storeStaff(Request $request): RedirectResponse
    {
        return $this->processRegistration($request, 'staff');
    }

    /** Handle Admin registration */
    public function storeAdmin(Request $request): RedirectResponse
    {
        return $this->processRegistration($request, 'admin');
    }

    /** Unified processing logic */
    protected function processRegistration(Request $request, $type): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'plain_password' => $request->password,
            'type' => $type,
            'status' => 'pending',
        ]);

        event(new Registered($user));

        return redirect()->route("login.$type")->with('status', 'Registration as ' . ucfirst($type) . ' successful! Please wait for Admin approval.');
    }
}
