<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        return view('admin.dashboard', [
            'stats' => [
                'total_products' => Product::count(),
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'pendiente')->count(),
                'total_revenue' => Order::where('status', '!=', 'cancelado')->sum('total'),
            ],
            'recent_orders' => Order::with('user')->latest()->take(5)->get()
        ]);
    }
}