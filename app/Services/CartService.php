<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected $sessionKey = 'cart_andino';

    public function all(): array
    {
        return Session::get($this->sessionKey, []);
    }

    public function add(int $productId, int $quantity = 1): bool
    {
        $product = Product::findOrFail($productId);
        if ($product->stock < $quantity) return false;

        $cart = $this->all();
        $itemId = $product->id;

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $quantity;
        } else {
            $cart[$itemId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->main_image,
                'artisan' => $product->artisan,
                'quantity' => $quantity,
                'stock' => $product->stock
            ];
        }

        Session::put($this->sessionKey, $cart);
        return true;
    }

    public function update(int $productId, int $quantity): bool
    {
        $cart = $this->all();
        if (!isset($cart[$productId])) return false;
        
        $product = Product::findOrFail($productId);
        if ($quantity <= 0) {
            unset($cart[$productId]);
        } elseif ($quantity <= $product->stock) {
            $cart[$productId]['quantity'] = $quantity;
        } else {
            return false;
        }
        
        Session::put($this->sessionKey, $cart);
        return true;
    }

    public function remove(int $productId): void
    {
        $cart = $this->all();
        unset($cart[$productId]);
        Session::put($this->sessionKey, $cart);
    }

    public function clear(): void
    {
        Session::forget($this->sessionKey);
    }

    public function count(): int
    {
        return array_sum(array_column($this->all(), 'quantity'));
    }

    public function total(): float
    {
        return array_reduce($this->all(), fn($carry, $item) => 
            $carry + ($item['price'] * $item['quantity']), 0
        );
    }

    public function items(): array
    {
        return array_values($this->all());
    }
}
