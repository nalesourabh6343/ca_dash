<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of staff.
     */
    public function index()
    {
        $staffs = Staff::latest()->get();
        return view('admin.staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created staff member.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:staff,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $staff = new Staff();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->pincode = $request->pincode;

        if ($request->hasFile('image')) {
            $staff->image = $request->file('image')->store('staff_images', 'public');
        }

        $staff->save();

        return redirect()->route('admin.staffs.index')->with('msg', "Staff Member Created Successfully");
    }

    /**
     * Display staff details.
     */
    public function show($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return redirect()->route('admin.staffs.index')->with('error', "Staff Member Not Found");
        }
        return view('admin.staff.view', compact('staff'));
    }

    /**
     * Show the form for editing a staff member.
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        if (!$staff) {
            return redirect()->route('admin.staffs.index')->with('error', "Staff Member Not Found");
        }
        return view('admin.staff.edit', compact('staff'));
    }

    /**
     * Update an existing staff member.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:staff,email,' . $id . ',staff_id',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $staff = Staff::find($id);

        if ($staff) {
            $staff->name = $request->name;
            $staff->email = $request->email;
            $staff->phone = $request->phone;
            $staff->address = $request->address;
            $staff->pincode = $request->pincode;

            if ($request->hasFile('image')) {
                if ($staff->image) {
                    Storage::disk('public')->delete($staff->image);
                }
                $staff->image = $request->file('image')->store('staff_images', 'public');
            }

            $staff->save();

            return redirect()->route('admin.staffs.index')->with('msg', "Staff Member Updated Successfully");
        }

        return redirect()->route('admin.staffs.index')->with('error', "Staff Member Not Found");
    }

    /**
     * Soft delete a staff member.
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        if ($staff) {
            $staff->delete();
            return redirect()->route('admin.staffs.index')->with('msg', "Staff Member Moved to Trash");
        }
        return redirect()->route('admin.staffs.index')->with('error', "Staff Member Not Found");
    }

    /**
     * Display trashed staff.
     */
    public function trash()
    {
        $staffs = Staff::onlyTrashed()->latest()->get();
        return view('admin.staff.trash', compact('staffs'));
    }

    /**
     * Restore soft-deleted staff member.
     */
    public function restore($id)
    {
        $staff = Staff::withTrashed()->find($id);
        if ($staff) {
            $staff->restore();
            return redirect()->route('admin.staffs.trash')->with('msg', "Staff Member Restored Successfully");
        }
        return redirect()->route('admin.staffs.trash')->with('error', "Staff Member Not Found");
    }

    /**
     * Permanently delete a staff member.
     */
    public function forceDelete($id)
    {
        $staff = Staff::withTrashed()->find($id);
        if ($staff) {
            if ($staff->image) {
                Storage::disk('public')->delete($staff->image);
            }
            $staff->forceDelete();
            return redirect()->route('admin.staffs.trash')->with('msg', "Staff Member Permanently Deleted");
        }
        return redirect()->route('admin.staffs.trash')->with('error', "Staff Member Not Found");
    }
}
