<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Traemos 4 productos destacados (por ejemplo, los más recientes o con stock)
        $featuredProducts = Product::where('stock', '>', 0)
                                   ->latest()
                                   ->take(4)
                                   ->get();

        // Traemos las categorías para mostrar en el home
        $categories = Category::withCount('products')->get();

        return view('home', compact('featuredProducts', 'categories'));
    }
}