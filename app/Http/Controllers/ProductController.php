<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    // Display the create product form
    public function create()
    {
        return view('products.create');
    }

    // Save a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'required|image|max:2048',
        ]);

        $uploadPath = public_path('uploads/products');

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $image = $request->file('image');
        $imageName = $image->hashName();

        $image->move($uploadPath, $imageName);

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'],
            'image' => $imageName,
            'created_at' => now(),
        ]);

        return redirect('/products')
            ->with('success', 'Product added successfully.');
    }

    // Display the edit product form
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageName = $product->image;

        if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/products');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = $image->hashName();

            $image->move($uploadPath, $imageName);
        }

        $product->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'],
            'image' => $imageName,
        ]);

        return redirect('/products')
            ->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/products')
            ->with('success', 'Product deleted.');
    }
}
