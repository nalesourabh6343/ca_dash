<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        // Identify client by logged-in user's email
        $userEmail = Auth::user()->email;
        $client = Client::where('email', $userEmail)->first();

        if (!$client) {
            // Auto-create Client profile from User data
            $client = new Client();
            $client->name = Auth::user()->name;
            $client->email = Auth::user()->email;
            $client->phone = '0000000000'; // Placeholder
            $client->save();
        }

        $services = Service::latest()->get();
        // Get IDs of services currently selected by this client
        $selectedServices = $client->services->pluck('service_id')->toArray();

        return view('client.service.index', compact('services', 'selectedServices'));
    }

    public function update(Request $request)
    {
        $userEmail = Auth::user()->email;
        $client = Client::where('email', $userEmail)->first();

        if (!$client) {
            // Auto-create Client profile from User data
            $client = new Client();
            $client->name = Auth::user()->name;
            $client->email = Auth::user()->email;
            $client->phone = '0000000000'; // Placeholder
            $client->save();
        }

        // Sync services (array of IDs)
        // If no services selected, sync empty array
        $client->services()->sync($request->services ?? []);

        return redirect()->back()->with('msg', 'Services Updated Successfully');
    }
}
