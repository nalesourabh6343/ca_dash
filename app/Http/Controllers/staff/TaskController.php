<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of assigned tasks.
     */
    public function index()
    {
        // Fetch tasks assigned to the logged-in staff member
        $tasks = Task::with(['client', 'business'])
            ->where('staff_id', auth()->id())
            ->latest()
            ->get();

        return view('staff.task.index', compact('tasks'));
    }

    /**
     * Update the status of a task.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::where('id', $id)->where('staff_id', auth()->id())->first();

        if ($task) {
            $task->status = $request->status;
            $task->save();

            return redirect()->back()->with('msg', 'Task Status Updated Successfully');
        }

        return redirect()->back()->with('error', 'Task Not Found or Access Denied');
    }
}
