<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        // 🔹 Filtros
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%")
                  ->orWhere('artisan', 'like', "%{$request->search}%");
        }
        if ($request->filled('origin')) {
            $query->where('origin', 'like', "%{$request->origin}%");
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // 🔹 Ordenamiento
        $sortBy = $request->get('sort', 'newest');
        match($sortBy) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'artisan' => $query->orderBy('artisan', 'asc'),
            default => $query->latest()
        };

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();
        $origins = Product::select('origin')->whereNotNull('origin')->distinct()->pluck('origin');

        return view('catalog.index', compact('products', 'categories', 'origins'));
    }

    public function show(Product $product)
    {
        $related = Product::where('category_id', $product->category_id)
                         ->where('id', '!=', $product->id)
                         ->limit(4)
                         ->get();

        return view('catalog.show', compact('product', 'related'));
    }
}