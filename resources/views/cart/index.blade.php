<x-app-layout>
    <x-slot name="header">
        <h2 class="font-andino text-2xl">🛒 Tu Carrito Andino</h2>
    </x-slot>

    <div class="py-12 bg-[var(--andino-lana)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded" data-auto-close>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded" data-auto-close>
                    {{ session('error') }}
                </div>
            @endif

            @if($count === 0)
                <div class="text-center py-16 card-andino p-8">
                    <p class="text-xl text-stone-600 mb-4">🧶 Tu carrito está vacío</p>
                    <a href="{{ route('catalog') }}" class="btn-andino inline-block">Explorar productos</a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Items del carrito -->
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($items as $item)
                        <div class="card-andino p-4 flex gap-4">
                            <img src="{{ asset('storage/'.$item['image']) }}" 
                                 class="w-24 h-24 object-cover rounded border border-stone-200"
                                 alt="{{ $item['name'] }}">
                            <div class="flex-1">
                                <h3 class="font-andino text-lg">{{ $item['name'] }}</h3>
                                <p class="text-sm text-stone-500">{{ $item['artisan'] }}</p>
                                <p class="text-[var(--andino-terracota)] font-bold mt-1">S/ {{ number_format($item['price'], 2) }}</p>
                                
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="mt-2 flex items-center gap-2">
                                    @csrf @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" 
                                           min="1" max="{{ $item['stock'] }}" 
                                           class="w-16 p-1 border border-stone-300 rounded text-center">
                                    <span class="text-sm text-stone-500">/ {{ $item['stock'] }} disp.</span>
                                    <button type="submit" class="text-[var(--andino-terracota)] hover:underline text-sm">Actualizar</button>
                                </form>
                            </div>
                            <div class="text-right">
                                <p class="font-bold">S/ {{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                <form action="{{ route('cart.destroy', $item['id']) }}" method="POST" class="mt-2">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm" 
                                            onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                        
                        <form action="{{ route('cart.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-stone-500 hover:text-stone-700 text-sm underline">
                                Vaciar carrito completo
                            </button>
                        </form>
                    </div>

                    <!-- Resumen de compra -->
                    <div class="card-andino p-6 h-fit sticky top-4">
                        <h3 class="font-andino text-xl mb-4">Resumen</h3>
                        <div class="space-y-2 text-stone-700">
                            <div class="flex justify-between">
                                <span>Subtotal ({{ $count }} items)</span>
                                <span>S/ {{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Envío</span>
                                <span class="text-green-600">Gratis 🚚</span>
                            </div>
                            <hr class="border-stone-200">
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span class="text-[var(--andino-terracota)]">S/ {{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('cart.checkout') }}" class="btn-andino w-full mt-6 text-center block py-3">
                            Proceder al pago →
                        </a>
                        
                        <a href="{{ route('catalog') }}" class="block text-center mt-3 text-stone-600 hover:text-[var(--andino-terracota)]">
                            ← Seguir comprando
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>