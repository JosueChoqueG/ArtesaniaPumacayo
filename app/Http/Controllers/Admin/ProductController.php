<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller {
    public function index() {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'artisan' => 'nullable|string',
            'origin' => 'nullable|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('main_image')) {
            // 1. Generar nombre único
            $file = $request->file('main_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'products/' . $filename;
            
            // 2. Compresión con Intervention Image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());
            
            // Redimensionar a máx 1200px y comprimir a 80% calidad
            $image->scale(1200, 1200);
            $image->save(storage_path('app/public/' . $path), 80);
            
            $data['main_image'] = $path;
        }
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Producto creado');
    }

    public function edit(Product $product) {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'artisan' => 'nullable|string',
            'origin' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('main_image')) {
            // 1. Generar nombre único
            $file = $request->file('main_image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'products/' . $filename;
            
            // 2. Compresión con Intervention Image
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file->getRealPath());
            
            // Redimensionar a máx 1200px y comprimir a 80% calidad
            $image->scale(1200, 1200);
            $image->save(storage_path('app/public/' . $path), 80);
            
            // 3. Eliminar imagen anterior
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            
            $data['main_image'] = $path;
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado');
    }

    public function destroy(Product $product) {
        Storage::disk('public')->delete($product->main_image);
        $product->delete();
        return back()->with('success', 'Producto eliminado');
    }
}