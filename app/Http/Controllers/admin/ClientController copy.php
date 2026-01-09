<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index()
    {
        $clients = Client::latest()->get();
        return view('admin.client.index', compact('clients'));
    }

    /**
     * Display the specified client with all details.
     */
    public function show($id)
    {
        // Eager load relationships
        $client = Client::with(['services', 'businesses', 'documents.category'])->find($id);

        if (!$client) {
            return redirect()->route('admin.client.index')->with('error', 'Client not found.');
        }

        return view('admin.client.view', compact('client'));
    }
}
