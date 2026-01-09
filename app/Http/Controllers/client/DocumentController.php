<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents.
     */
    public function index()
    {
        // Ideally should filter by logged in client, but schema for client_id is commented out.
        // For now displaying all documents or adhering to potential future 'auth' logic.
        $documents = Document::latest()->get();
        return view('client.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        $categories = DocumentCategory::latest()->get();
        return view('client.document.create', compact('categories'));
    }

    /**
     * Store a newly created document.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pk_document_categorie_id' => 'required|exists:document_categories,document_categorie_id',
            'file_name' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // 10MB max
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
            'description' => 'nullable|string',
        ]);

        $document = new Document();

        // Link document to the logged-in client
        $user = auth()->user();
        $client = Client::where('email', $user->email)->first();
        if ($client) {
            $document->client_id = $client->client_id;
        }

        $document->pk_document_categorie_id = $request->pk_document_categorie_id;
        $document->file_name = $request->file_name;
        $document->period_start = $request->period_start;
        $document->period_end = $request->period_end;
        $document->description = $request->description;
        $document->status = 'pending'; // Default status

        // File Upload
        if ($request->hasFile('file_path')) {
            $document->file_path = $request->file('file_path')->store('client_documents', 'public');
        }

        $document->save();

        return redirect()->route('client.document.index')->with('msg', "Document Uploaded Successfully");
    }

    /**
     * Display document details.
     */
    public function view($id)
    {
        $document = Document::find($id);
        if (!$document) {
            return redirect()->route('client.document.index')->with('error', "Document Not Found");
        }
        return view('client.document.view', compact('document'));
    }

    /**
     * Show the form for editing a document.
     */
    public function edit($id)
    {
        $document = Document::find($id);
        if (!$document) {
            return redirect()->route('client.document.index')->with('error', "Document Not Found");
        }
        $categories = DocumentCategory::latest()->get();

        return view('client.document.edit', compact('document', 'categories'));
    }

    /**
     * Update an existing document.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pk_document_categorie_id' => 'required|exists:document_categories,document_categorie_id',
            'file_name' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
            'description' => 'nullable|string',
        ]);

        $document = Document::find($id);

        if ($document) {
            $document->pk_document_categorie_id = $request->pk_document_categorie_id;
            $document->file_name = $request->file_name;
            $document->period_start = $request->period_start;
            $document->period_end = $request->period_end;
            $document->description = $request->description;

            // File Update
            if ($request->hasFile('file_path')) {
                if ($document->file_path) {
                    Storage::disk('public')->delete($document->file_path);
                }
                $document->file_path = $request->file('file_path')->store('client_documents', 'public');
            }

            $document->save();

            return redirect()->route('client.document.index')->with('msg', "Document Updated Successfully");
        }

        return redirect()->route('client.document.index')->with('error', "Document Not Found");
    }

    /**
     * Soft delete a document.
     */
    public function destroy($id)
    {
        $document = Document::find($id);

        if ($document) {
            $document->delete();
            return redirect()->route('client.document.index')->with('msg', "Document Moved to Trash");
        }

        return redirect()->route('client.document.index')->with('error', "Document Not Found");
    }

    /**
     * Display trashed documents.
     */
    public function trash()
    {
        $documents = Document::onlyTrashed()->latest()->get();
        return view('client.document.trash', compact('documents'));
    }

    /**
     * Restore soft-deleted document.
     */
    public function restore($id)
    {
        $document = Document::withTrashed()->find($id);

        if ($document) {
            $document->restore();
            return redirect()->route('client.document.trash')->with('msg', "Document Restored Successfully");
        }

        return redirect()->route('client.document.trash')->with('error', "Document Not Found");
    }

    /**
     * Permanently delete a document.
     */
    public function forceDelete($id)
    {
        $document = Document::withTrashed()->find($id);

        if ($document) {
            // Delete file
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }

            $document->forceDelete();

            return redirect()->route('client.document.trash')->with('msg', "Document Permanently Deleted");
        }

        return redirect()->route('client.document.trash')->with('error', "Document Not Found");
    }
}
