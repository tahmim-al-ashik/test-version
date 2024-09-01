<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product\Subcategory;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Customer\StoreSubcategoryRequest;
use App\Http\Requests\Customer\UpdateSubcategoryRequest;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            $subcategories = Subcategory::with('category')
                ->where('user_id', Auth::id())
                ->when($request->category_id, function ($query) use ($request) {
                    $query->where('category_id', $request->category_id);
                })
                ->get();

            return response()->json($subcategories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(StoreSubcategoryRequest $request)
    {
        $subcategory = Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'subcategory' => $subcategory]);
    }

    public function userSubcategories()
    {
        return Subcategory::where('user_id', Auth::id())->get();
    }

    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return Inertia::render('Products/EditSubcategory', [
            'subcategory' => $subcategory,
        ]);
    }

    public function update(UpdateSubcategoryRequest $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->all());

        return redirect()->route('manage.categories')->with('success', 'Subcategory updated successfully.');
    }
}
