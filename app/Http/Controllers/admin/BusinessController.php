<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;

class BusinessController extends Controller
{
    /**
     * Display a listing of businesses.
     */
    public function index()
    {
        $businesses = Business::latest()->get();
        return view('admin.business.index', compact('businesses'));
    }

    /**
     * Show the form for creating a new business.
     */
    public function create()
    {
        return view('admin.business.create');
    }

    /**
     * Store a newly created business.
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'financial_year' => 'required|string|max:20',
            'description' => 'required|string',
        ]);

        $business = new Business();
        $business->business_name = $request->business_name;
        $business->client_name = $request->client_name;
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
        return view('admin.business.edit', compact('business'));
    }

    /**
     * Update an existing business.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:50',
            'pan_number' => 'nullable|string|max:50',
            'financial_year' => 'required|string|max:20',
            'description' => 'required|string',
        ]);

        $business = Business::find($id);

        if ($business) {
            $business->business_name = $request->business_name;
            $business->client_name = $request->client_name;
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
        $businesses = Business::onlyTrashed()->latest()->get();
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
