<?php
###################Customer\CategoryController######################
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product\Category;
use Inertia\Inertia;
use App\Http\Requests\Customer\StoreCategoryRequest;
use App\Http\Requests\Customer\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        return response()->json($categories);
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);

        return response()->json($category);
    }

    public function userCategories()
    {
        return Category::where('user_id', Auth::id())->get();
    }

    public function manage()
    {
        return Inertia::render('Products/ManageCategories');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return Inertia::render('Products/EditCategory', [
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('manage.categories')->with('success', 'Category updated successfully.');
    }
}
