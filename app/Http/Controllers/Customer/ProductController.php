<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Product;
use App\Models\Product\Category;
use App\Models\Product\Subcategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function index()
    {
        $userId = auth()->id();
        $products = Product::where('user_id', $userId)->get();

        return Inertia::render('Products/ProductList', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $userId = auth()->id();
        $categories = Category::where('user_id', $userId)->get();
        $subcategories = Subcategory::whereIn('category_id', $categories->pluck('id'))->get();

        return Inertia::render('Products/Create', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'price_including_vat' => 'nullable|numeric|min:0',
            'price_excluding_vat' => 'nullable|numeric|min:0',
            'instock' => 'nullable|integer|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'price_including_vat' => $request->price_including_vat,
            'price_excluding_vat' => $request->price_excluding_vat,
            'instock' => $request->instock,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('services.show', ['service' => 1])->with('success', 'Product added successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $userId = auth()->id();

        $products = Product::where('user_id', $userId)
            ->where('name', 'like', "%{$query}%")
            ->get();

        return response()->json($products);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $userId = auth()->id();
        $categories = Category::where('user_id', $userId)->get();
        $subcategories = Subcategory::whereIn('category_id', $categories->pluck('id'))->get();

        if ($product->user_id !== $userId) {
            abort(403);
        }

        return Inertia::render('Products/EditProduct', [
            'product' => $product,
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'price_including_vat' => 'nullable|numeric',
            'price_excluding_vat' => 'nullable|numeric',
            'stock' => 'nullable|integer',
        ]);

        $product = Product::findOrFail($id);

        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
}
