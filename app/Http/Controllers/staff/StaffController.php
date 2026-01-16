<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Task;

class StaffController extends Controller
{
    public function dashboard()
    {
        $userId = auth()->id();

        // Count unique clients assigned to this staff via tasks
        $assignedClientsCount = Task::where('staff_id', $userId)->distinct('client_id')->count('client_id');

        // Tasks due today
        $tasksTodayCount = Task::where('staff_id', $userId)->whereDate('due_date', now())->count();
        $tasksCompletedTodayCount = Task::where('staff_id', $userId)->whereDate('due_date', now())->where('status', 'completed')->count();

        // Total pending tasks
        $pendingTasksCount = Task::where('staff_id', $userId)->where('status', '!=', 'completed')->count();

        return view('staff.dashboard', compact('assignedClientsCount', 'tasksTodayCount', 'tasksCompletedTodayCount', 'pendingTasksCount'));
    }
}
