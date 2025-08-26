<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $path = $request->file('image')->store("products/{$product->id}", 'public');
//$path = "storage/app/{$path}";
//dd($path);

        $product->images()->create([
            'path' => 'storage/' . $path,
            'is_main' => $product->images()->count() === 0,
            'position' => $product->images()->count(),
        ]);

        return back()->with('success', 'Image ajoutée');
    }

    public function setMain(Product $product, ProductImage $image)
    {
        $product->images()->update(['is_main' => false]);
        $image->update(['is_main' => true]);

        return back()->with('success', 'Image définie comme principale');
    }

    public function updateOrder(Request $request, Product $product, ProductImage $image)
    {
        $request->validate([
            'direction' => ['required', 'in:up,down']
        ]);

        $currentPosition = $image->position;
        $swapWith = $product->images()
            ->where('position', $request->direction === 'up' ? '<' : '>')
            ->orderBy('position', $request->direction === 'up' ? 'desc' : 'asc')
            ->first();

        if ($swapWith) {
            $image->update(['position' => $swapWith->position]);
            $swapWith->update(['position' => $currentPosition]);
        }

        return back()->with('success', 'Ordre mis à jour');
    }

    public function destroy(Product $product, ProductImage $image)
    {
        if ($image->is_main) {
            return back()->with('error', 'Impossible de supprimer l’image principale.');
        }

        Storage::delete(str_replace('storage/', 'public/', $image->path));
        $image->delete();

        return back()->with('success', 'Image supprimée');
    }
}
