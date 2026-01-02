<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fee' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->fee = $request->fee;
        $service->description = $request->description;
        $service->save();

        return redirect()->route('admin.service.index')->with('msg', "Service Created Successfully");
    }

    /**
     * Show the form for editing a service.
     */
    public function edit($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return redirect()->route('admin.service.index')->with('error', "Service Not Found");
        }
        return view('admin.service.edit', compact('service'));
    }

    /**
     * Update an existing service.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fee' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $service = Service::find($id);

        if ($service) {
            $service->name = $request->name;
            $service->fee = $request->fee;
            $service->description = $request->description;
            $service->save();

            return redirect()->route('admin.service.index')->with('msg', "Service Updated Successfully");
        }

        return redirect()->route('admin.service.index')->with('error', "Service Not Found");
    }

    /**
     * Soft delete a service.
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        if ($service) {
            $service->delete();
            return redirect()->route('admin.service.index')->with('msg', "Service Moved to Trash");
        }

        return redirect()->route('admin.service.index')->with('error', "Service Not Found");
    }

    /**
     * Display trashed services.
     */
    public function trash()
    {
        $services = Service::onlyTrashed()->latest()->get();
        return view('admin.service.trash', compact('services'));
    }

    /**
     * Restore soft-deleted service.
     */
    public function restore($id)
    {
        $service = Service::withTrashed()->find($id);

        if ($service) {
            $service->restore();
            return redirect()->route('admin.service.trash')->with('msg', "Service Restored Successfully");
        }

        return redirect()->route('admin.service.trash')->with('error', "Service Not Found");
    }

    /**
     * Permanently delete a service.
     */
    public function forceDelete($id)
    {
        $service = Service::withTrashed()->find($id);

        if ($service) {
            $service->forceDelete();
            return redirect()->route('admin.service.trash')->with('msg', "Service Permanently Deleted");
        }

        return redirect()->route('admin.service.trash')->with('error', "Service Not Found");
    }
}
