<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of registered users (Read Only).
     */
    public function index()
    {
        $users = User::whereIn('type', ['admin', 'client', 'staff'])->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Update user status (Approve/Reject).
     */
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return back()->with('msg', "User status updated to " . ucfirst($user->status));
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('msg', "User removed successfully.");
    }
}
