<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        $products = Product::with('category')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_visible' => 'boolean',
        ]);

        /*$validated['is_visible'] = $request->has('is_visible'); //checkbox 
         Product::create($validated);
        
         $data['slug'] = Str::slug($data['title']);
        Product::create($data);*/
            // Ensure is_visible is boolean
            $data['is_visible'] = $request->has('is_visible');

            // Generate slug
            $data['slug'] = Str::slug($data['title']);

            // Create product once
            Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produit ajouté');
    }

    public function edit(Product $product)
    {
        $product->load('images'); // Charger les images associées
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_visible' => 'boolean',
        ]);

        $validated['is_visible'] = $request->has('is_visible'); //checkbox
        $product->update($validated);

        $data['slug'] = Str::slug($data['title']);
        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour');
    }

    public function toggleVisibility(Product $product)
    {
        $product->is_visible = !$product->is_visible;
        $product->save();

        return back()->with('success', 'Visibilité changée');
    }

    public function destroy(Product $product)
    {
        // Tu avais dit : pas de suppression
        abort(403);
    }
}
