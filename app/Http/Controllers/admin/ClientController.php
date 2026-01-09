<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

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
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('admin.client.create');
    }

    /**
     * Store a newly created client.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $client = new Client();
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->pincode = $request->pincode;

        // Image Upload
        if ($request->hasFile('image')) {
            $client->image = $request->file('image')->store('client_images', 'public');
        }

        $client->save();

        return redirect()->route('admin.client.index')->with('msg', "Client Created Successfully");
    }

    /**
     * Display client details.
     */
    public function show($id)
    {
        $client = Client::with(['services', 'businesses', 'documents.category'])->find($id);
        if (!$client) {
            return redirect()->route('admin.client.index')->with('error', "Client Not Found");
        }
        return view('admin.client.view-details', compact('client'));
    }

    /**
     * Show the form for editing a client.
     */
    public function edit($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return redirect()->route('admin.client.index')->with('error', "Client Not Found");
        }
        return view('admin.client.edit', compact('client'));
    }

    /**
     * Update an existing client.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $id . ',client_id',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $client = Client::find($id);

        if ($client) {

            $client->name = $request->name;
            $client->email = $request->email;
            $client->phone = $request->phone;
            $client->address = $request->address;
            $client->pincode = $request->pincode;

            // Image Update
            if ($request->hasFile('image')) {
                if ($client->image) {
                    Storage::disk('public')->delete($client->image);
                }
                $client->image = $request->file('image')->store('client_images', 'public');
            }

            $client->save();

            return redirect()->route('admin.client.index')->with('msg', "Client Updated Successfully");
        }

        return redirect()->route('admin.client.index')->with('error', "Client Not Found");
    }

    /**
     * Soft delete a client.
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        if ($client) {
            $client->delete();
            return redirect()->route('admin.client.index')->with('msg', "Client Moved to Trash");
        }

        return redirect()->route('admin.client.index')->with('error', "Client Not Found");
    }

    /**
     * Display trashed clients.
     */
    public function trash()
    {
        $clients = Client::onlyTrashed()->latest()->get();
        return view('admin.client.trash', compact('clients'));
    }

    /**
     * Restore soft-deleted client.
     */
    public function restore($id)
    {
        $client = Client::withTrashed()->find($id);

        if ($client) {
            $client->restore();
            return redirect()->route('admin.client.trash')->with('msg', "Client Restored Successfully");
        }

        return redirect()->route('admin.client.trash')->with('error', "Client Not Found");
    }

    /**
     * Permanently delete a client.
     */
    public function forceDelete($id)
    {
        $client = Client::withTrashed()->find($id);

        if ($client) {

            // Delete image
            if ($client->image) {
                Storage::disk('public')->delete($client->image);
            }

            $client->forceDelete();

            return redirect()->route('admin.client.trash')->with('msg', "Client Permanently Deleted");
        }

        return redirect()->route('admin.client.trash')->with('error', "Client Not Found");
    }
}
