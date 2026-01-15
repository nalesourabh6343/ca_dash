<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Service;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $client = Client::where('email', $user->email)->first();

        if (!$client) {
            return view('client.dashboard', [
                'totalDocuments' => 0,
                'activeServices' => 0,
                'totalBusinesses' => 0,
                'totalCategories' => DocumentCategory::count(),
                'recentDocuments' => collect(),
            ]);
        }

        $data = [
            'totalDocuments' => $client->documents()->count(),
            'activeServices' => $client->services()->count(),
            'totalBusinesses' => $client->businesses()->count(),
            'totalCategories' => DocumentCategory::count(),

            // Recent Activity
            'recentDocuments' => $client->documents()->with('category')->latest()->limit(5)->get(),
        ];

        return view('client.dashboard', $data);
    }
}
