<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of clients assigned to this staff.
     */
    public function index()
    {
        // Only show clients that have at least one task assigned to the current staff member
        $clients = Client::whereHas('tasks', function ($query) {
            $query->where('staff_id', auth()->id());
        })->latest()->get();

        return view('staff.client.index', compact('clients'));
    }

    /**
     * Display client details.
     */
    public function show($id)
    {
        // Ensure staff can only view details of their assigned clients
        $client = Client::where('client_id', $id)
            ->whereHas('tasks', function ($query) {
                $query->where('staff_id', auth()->id());
            })
            ->with(['services', 'businesses', 'documents.category'])
            ->first();

        if (!$client) {
            return redirect()->route('staff.client.index')->with('error', "Client Not Found or Access Denied");
        }
        return view('staff.client.view-details', compact('client'));
    }

    /**
     * Update status of a client's document
     */
    public function updateDocumentStatus(Request $request, $id, $documentId)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        // Verify client assignment
        $client = Client::where('client_id', $id)
            ->whereHas('tasks', function ($query) {
                $query->where('staff_id', auth()->id());
            })->first();

        if (!$client) {
            return back()->with('error', 'Access Denied');
        }

        $document = \App\Models\Document::where('document_id', $documentId)
            ->where('client_id', $id)
            ->first();

        if ($document) {
            $document->status = $request->status;
            $document->save();
            return back()->with('msg', 'Document status updated');
        }

        return back()->with('error', 'Document not found');
    }
}
