<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice\InvoiceCategory;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Requests\Invoice\StoreInvoiceCategoryRequest;
use App\Http\Requests\Invoice\UpdateInvoiceCategoryRequest;

class InvoiceCategoryController extends Controller
{
    public function index()
    {
        $categories = InvoiceCategory::where('user_id', auth()->id())->get();
        return Inertia::render('Invoice/InvoiceCategory', [
            'categories' => $categories,
            'flash' => session('success')
        ]);
    }

    public function getCategories()
    {
        $categories = InvoiceCategory::where('user_id', auth()->id())->get(['id', 'name']);
        return response()->json($categories);
    }

    public function store(StoreInvoiceCategoryRequest $request)
    {
        $category = InvoiceCategory::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('invoice-categories.index')->with('success', 'Category created successfully.');
    }

    public function update(UpdateInvoiceCategoryRequest $request, $id)
    {
        $category = InvoiceCategory::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('invoice-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = InvoiceCategory::where('user_id', Auth::id())->findOrFail($id);
        $category->delete();

        return redirect()->route('invoice-categories.index')->with('success', 'Category deleted successfully.');
    }
}
