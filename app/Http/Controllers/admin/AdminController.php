<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;
use App\Models\Business;
use App\Models\Staff;
use App\Models\Service;
use App\Models\Task;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = [
            'totalClients' => Client::count(),
            'totalBusinesses' => Business::count(),
            'totalStaff' => Staff::count(), // Using the new Staff model
            'totalServices' => Service::count(),
            'totalTasks' => Task::count(),
            'pendingTasks' => Task::where('status', 'pending')->count(),

            // Recent Activity
            'recentTasks' => Task::with(['client', 'staff', 'business'])->latest()->limit(5)->get(),
            'recentClients' => Client::latest()->limit(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
