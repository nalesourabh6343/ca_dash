<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;

class DocumentCategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = DocumentCategory::latest()->get();
        return view('client.document_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('client.document_category.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = new DocumentCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('client.category.index')->with('msg', "Category Created Successfully");
    }

    /**
     * Display category details.
     */
    public function view($id)
    {
        // Not typically needed for simple categories, but including for consistency if requested
        // $category = DocumentCategory::find($id);
        // return view('client.document_category.view', compact('category'));
    }

    /**
     * Show the form for editing a category.
     */
    public function edit($id)
    {
        $category = DocumentCategory::find($id);
        if (!$category) {
            return redirect()->route('client.category.index')->with('error', "Category Not Found");
        }
        return view('client.document_category.edit', compact('category'));
    }

    /**
     * Update an existing category.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category = DocumentCategory::find($id);

        if ($category) {
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            return redirect()->route('client.category.index')->with('msg', "Category Updated Successfully");
        }

        return redirect()->route('client.category.index')->with('error', "Category Not Found");
    }

    /**
     * Soft delete a category.
     */
    public function destroy($id)
    {
        $category = DocumentCategory::find($id);

        if ($category) {
            $category->delete();
            return redirect()->route('client.category.index')->with('msg', "Category Moved to Trash");
        }

        return redirect()->route('client.category.index')->with('error', "Category Not Found");
    }

    /**
     * Display trashed categories.
     */
    public function trash()
    {
        $categories = DocumentCategory::onlyTrashed()->latest()->get();
        return view('client.document_category.trash', compact('categories'));
    }

    /**
     * Restore soft-deleted category.
     */
    public function restore($id)
    {
        $category = DocumentCategory::withTrashed()->find($id);

        if ($category) {
            $category->restore();
            return redirect()->route('client.category.trash')->with('msg', "Category Restored Successfully");
        }

        return redirect()->route('client.category.trash')->with('error', "Category Not Found");
    }

    /**
     * Permanently delete a category.
     */
    public function forceDelete($id)
    {
        $category = DocumentCategory::withTrashed()->find($id);

        if ($category) {
            $category->forceDelete();
            return redirect()->route('client.category.trash')->with('msg', "Category Permanently Deleted");
        }

        return redirect()->route('client.category.trash')->with('error', "Category Not Found");
    }
}
