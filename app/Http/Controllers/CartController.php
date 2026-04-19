<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        return view('cart.index', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
            'count' => $this->cart->count()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        if ($this->cart->add($request->product_id, $request->quantity)) {
            return back()->with('success', 'Producto añadido al carrito 🐎');
        }
        return back()->with('error', 'Stock insuficiente o producto no disponible');
    }

    public function update(Request $request, int $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:0']);
        
        if ($this->cart->update($productId, $request->quantity)) {
            return back()->with('success', 'Carrito actualizado');
        }
        return back()->with('error', 'No se pudo actualizar el producto');
    }

    public function destroy(int $productId)
    {
        $this->cart->remove($productId);
        return back()->with('success', 'Producto eliminado del carrito');
    }

    public function clear()
    {
        $this->cart->clear();
        return back()->with('success', 'Carrito vaciado');
    }

    public function checkout()
    {
        if ($this->cart->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        return view('cart.checkout', [
            'items' => $this->cart->items(),
            'total' => $this->cart->total(),
            'count' => $this->cart->count()
        ]);
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'payment_method' => 'required|in:efectivo,tarjeta,transferencia'
        ]);

        // 🔹 Aquí iría: crear orden en BD, procesar pago, enviar email
        // Para MVP: simulamos éxito y vaciamos carrito
        
        $orderId = 'AND-' . strtoupper(uniqid());
        $this->cart->clear();
        
        return view('cart.confirmation', [
            'order_id' => $orderId,
            'total' => $request->total,
            'email' => $request->email
        ]);
    }
}