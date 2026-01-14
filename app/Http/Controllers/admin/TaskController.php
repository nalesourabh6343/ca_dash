<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\Client;
use App\Models\User;
use App\Models\Business;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     */
    public function index()
    {
        $tasks = Task::with(['client', 'staff', 'business'])->latest()->get();
        return view('admin.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $clients = Client::all();
        $businesses = Business::all();
        $staffMembers = User::where('type', 'staff')->get();
        return view('admin.task.create', compact('clients', 'businesses', 'staffMembers'));
    }

    /**
     * Store a newly created task.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'business_id' => 'nullable|exists:businesses,business_id',
            'staff_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        Task::create($request->all());

        return redirect()->route('admin.tasks.index')->with('msg', "Task Assigned Successfully");
    }

    /**
     * Display the specified task.
     */
    public function show($id)
    {
        $task = Task::with(['client', 'staff', 'business'])->find($id);
        if (!$task) {
            return redirect()->route('admin.tasks.index')->with('error', "Task Not Found");
        }
        return view('admin.task.view', compact('task'));
    }

    /**
     * Show the form for editing a task.
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return redirect()->route('admin.tasks.index')->with('error', "Task Not Found");
        }
        $clients = Client::all();
        $businesses = Business::all();
        $staffMembers = User::where('type', 'staff')->get();
        return view('admin.task.edit', compact('task', 'clients', 'businesses', 'staffMembers'));
    }

    /**
     * Update an existing task.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'business_id' => 'nullable|exists:businesses,business_id',
            'staff_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::find($id);
        if ($task) {
            $task->update($request->all());
            return redirect()->route('admin.tasks.index')->with('msg', "Task Updated Successfully");
        }

        return redirect()->route('admin.tasks.index')->with('error', "Task Not Found");
    }

    /**
     * Soft delete a task.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return redirect()->route('admin.tasks.index')->with('msg', "Task Moved to Trash");
        }
        return redirect()->route('admin.tasks.index')->with('error', "Task Not Found");
    }

    /**
     * Display trashed tasks.
     */
    public function trash()
    {
        $tasks = Task::onlyTrashed()->with(['client', 'staff', 'business'])->latest()->get();
        return view('admin.task.trash', compact('tasks'));
    }

    /**
     * Restore soft-deleted task.
     */
    public function restore($id)
    {
        $task = Task::withTrashed()->find($id);
        if ($task) {
            $task->restore();
            return redirect()->route('admin.tasks.trash')->with('msg', "Task Restored Successfully");
        }
        return redirect()->route('admin.tasks.trash')->with('error', "Task Not Found");
    }

    /**
     * Permanently delete a task.
     */
    public function forceDelete($id)
    {
        $task = Task::withTrashed()->find($id);
        if ($task) {
            $task->forceDelete();
            return redirect()->route('admin.tasks.trash')->with('msg', "Task Permanently Deleted");
        }
        return redirect()->route('admin.tasks.trash')->with('error', "Task Not Found");
    }
}
