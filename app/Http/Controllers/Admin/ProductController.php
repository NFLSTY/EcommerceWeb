<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.product-index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.product-add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        
        // Map form fields to database columns
        $product = Product::create([
            'name' => $validated['name'],
            'category_id' => $validated['category'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['detail'] ?? null,
            'image_url' => $this->handleImageUpload($request) ?? null,
        ]);
        
        return redirect()->route('admin.products.show', $product->id)
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product_id)
    {
        $product = Product::findOrFail($product_id);
        return view('admin.products.product-show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.product-edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $product = Product::findOrFail($id);
        
        // Handle image upload and deletion of old image
        $newImageUrl = $this->handleImageUpload($request);
        if ($newImageUrl && $product->image_url) {
            // Delete the old image when uploading a new one
            deleteImage($product->image_url);
        }

        // Map form fields to database columns
        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['detail'] ?? null,
            'image_url' => $newImageUrl ?? $product->image_url,
        ]);

        return redirect()->route('admin.products.show', $product->id)
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $productName = $product->name;
            
            // Delete the product image if it exists
            if ($product->image_url) {
                deleteImage($product->image_url);
            }
            
            $product->delete();
            
            return redirect()->route('admin.products.index')
                ->with('success', "Product '{$productName}' deleted successfully.");
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Failed to delete product.');
        }
    }

    /**
     * Handle image upload and return the URL
     */
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $randomString = generateRandomString(10);
            $imageName = $randomString . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/images/products'), $imageName);
            return 'images/products/' . $imageName;
        }
        
        return null;
    }
}
