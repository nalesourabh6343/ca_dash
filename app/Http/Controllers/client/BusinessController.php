<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $client = Client::where('email', $user->email)->first();

        // If client doesn't exist yet (shouldn't happen if properly handled in other controllers/login), 
        // we can handle it or pass empty.
        $businesses = $client ? $client->businesses : collect();

        return view('client.business.index', compact('businesses'));
    }

    public function update(Request $request)
    {
        // Logic for updating business information would go here
        // For now, redirect back
        return redirect()->back()->with('msg', 'Business information updated successfully.');
    }
}
