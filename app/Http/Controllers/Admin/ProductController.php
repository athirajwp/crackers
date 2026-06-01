<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display listings of products.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show form to create product.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store new product in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'pack_size' => 'required|string|max:255',
            'mrp' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // For portability, we can store in public/uploads/products
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'pack_size' => $request->pack_size,
            'mrp' => $request->mrp,
            'selling_price' => $request->selling_price,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show form to edit product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product details.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'pack_size' => 'required|string|max:255',
            'mrp' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            // Remove old image if existing
            if ($product->image && file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }

            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);
            $imagePath = 'uploads/products/' . $imageName;
        }

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'pack_size' => $request->pack_size,
            'mrp' => $request->mrp,
            'selling_price' => $request->selling_price,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Delete product.
     */
    public function destroy(Product $product)
    {
        if ($product->image && file_exists(public_path($product->image))) {
            @unlink(public_path($product->image));
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
