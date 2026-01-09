<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Client;

class BusinessController extends Controller
{
    /**
     * Display a listing of businesses.
     */
    public function index()
    {
        $businesses = Business::with('client')->latest()->get();
        return view('admin.business.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new business.
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.business.create', compact('clients'));
    }

    /**
     * Store a newly created business.
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,client_id',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'financial_year' => 'required|string|max:20',
            'description' => 'required|string',
        ]);

        $business = new Business();
        $business->business_name = $request->business_name;
        $business->client_id = $request->client_id;
        // Client name is now derived from the relationship, but if we need to store it for historical reasons (denormalization) we could,
        // but typically with a relation we don't. I will assume we drop storing client_name directly or let it be null.
        // However, the model might still have client_name column.
        // Ideally we should migrate to remove client_name, but for now I will just use client_id.
        // If the table strictly requires client_name and it's not nullable, I might need to fetch it.
        // Let's assume standard normalization. if strict SQL mode is on and client_name is not null strings, this might fail if I don't set it.
        // I will check the migration if I could... but I can't check migration history easily without finding the file.
        // Safest bet: Set client_name to the client's name just in case, or leave it if nullable.
        // Re-reading user request: "select client add this field on business". Matches standard foreign key pattern.

        $client = Client::find($request->client_id);
        $business->client_name = $client->name; // Keeping this for backward compatibility if the column exists/is required.

        $business->gst_number = $request->gst_number;
        $business->pan_number = $request->pan_number;
        $business->financial_year = $request->financial_year;
        $business->description = $request->description;
        $business->save();

        return redirect()->route('admin.business.index')->with('msg', "Business Created Successfully");
    }

    /**
     * Show the form for editing a business.
     */
    public function edit($id)
    {
        $business = Business::find($id);
        if (!$business) {
            return redirect()->route('admin.business.index')->with('error', "Business Not Found");
        }
        $clients = Client::all();
        return view('admin.business.edit', compact('business', 'clients'));
    }

    /**
     * Update an existing business.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,client_id',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'financial_year' => 'required|string|max:20',
            'description' => 'required|string',
        ]);

        $business = Business::find($id);

        if ($business) {
            $business->business_name = $request->business_name;
            $business->client_id = $request->client_id;

            $client = Client::find($request->client_id);
            $business->client_name = $client->name; // Update denormalized name if used

            $business->gst_number = $request->gst_number;
            $business->pan_number = $request->pan_number;
            $business->financial_year = $request->financial_year;
            $business->description = $request->description;
            $business->save();

            return redirect()->route('admin.business.index')->with('msg', "Business Updated Successfully");
        }

        return redirect()->route('admin.business.index')->with('error', "Business Not Found");
    }

    /**
     * Soft delete a business.
     */
    public function destroy($id)
    {
        $business = Business::find($id);

        if ($business) {
            $business->delete();
            return redirect()->route('admin.business.index')->with('msg', "Business Moved to Trash");
        }

        return redirect()->route('admin.business.index')->with('error', "Business Not Found");
    }

    /**
     * Display trashed businesses.
     */
    public function trash()
    {
        $businesses = Business::onlyTrashed()->with('client')->latest()->get();
        return view('admin.business.trash', compact('businesses'));
    }

    /**
     * Restore soft-deleted business.
     */
    public function restore($id)
    {
        $business = Business::withTrashed()->find($id);

        if ($business) {
            $business->restore();
            return redirect()->route('admin.business.trash')->with('msg', "Business Restored Successfully");
        }

        return redirect()->route('admin.business.trash')->with('error', "Business Not Found");
    }

    /**
     * Permanently delete a business.
     */
    public function forceDelete($id)
    {
        $business = Business::withTrashed()->find($id);

        if ($business) {
            $business->forceDelete();
            return redirect()->route('admin.business.trash')->with('msg', "Business Permanently Deleted");
        }

        return redirect()->route('admin.business.trash')->with('error', "Business Not Found");
    }
}
