<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; 

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $productsQuery = Product::where('is_visible', true)
            ->latest()
            ->with(['images' => function ($query) {
                $query->where('is_main', true);
            }]);

        if ($request->filled('category')) {
            $productsQuery->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $productsQuery->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $productsQuery->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'categories'));

    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with(['images', 'reservations'])->firstOrFail();
        
        abort_if(!$product->is_visible, 404);

        $product->load('images');

        return view('products.show', compact('product'));
    }
}

