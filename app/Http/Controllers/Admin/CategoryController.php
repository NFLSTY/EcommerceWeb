<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('product')->get();
        return view('admin.categories.category-index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.category-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        
        // Map the form field to the model attribute
        $category = Category::create([
            'name' => $validated['name'],
            'image_url' => $this->handleImageUpload($request) ?? null,
        ]);
        
        return redirect()->route('admin.categories.show', $category->id)
            ->with('success', "Category '{$category->name}' has been added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $products = $category->product;
        return view('admin.categories.category-show', compact('category', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.category-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        
        $category = Category::findOrFail($id);

        // Handle image upload and deletion of old image
        $newImageUrl = $this->handleImageUpload($request);
        if ($newImageUrl && $category->image_url) {
            // Delete the old image when uploading a new one
            deleteImageUsingStorage($category->image_url);
        }
        
        // Map the form field to the model attribute
        $category->update([
            'name' => $validated['name'],
            'image_url' => $newImageUrl ?? $category->image_url,
        ]);
        
        return redirect()->route('admin.categories.show', $category->id)
            ->with('success', "Category '{$category->name}' has been updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Check if category has products
        $productCount = $category->product()->count();
        if ($productCount > 0) {
            return redirect()->route('admin.categories.index');
        }

        // Delete the category image if it exists
        if ($category->image_url) {
            deleteImageUsingStorage($category->image_url);
        }

        $categoryName = $category->name;
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', "Category '{$categoryName}' has been deleted successfully.");
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
            $image->move(storage_path('app/public/images/categories'), $imageName);
            return 'images/categories/' . $imageName;
        }
        
        return null;
    }
}
