<x-app-layout>
    <div class="py-12 bg-[var(--andino-lana)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="text-sm text-stone-500 mb-6">
                <a href="{{ route('catalog') }}" class="hover:text-[var(--andino-terracota)]">Catálogo</a>
                <span class="mx-2">/</span>
                <a href="{{ route('catalog', ['category' => $product->category_id]) }}" class="hover:text-[var(--andino-terracota)]">
                    {{ $product->category->name }}
                </a>
                <span class="mx-2">/</span>
                <span class="text-stone-800">{{ $product->name }}</span>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Imagen -->
                <div class="card-andino p-4">
                    <img src="{{ asset('storage/'.$product->main_image) }}" 
                         alt="{{ $product->name }}"
                         class="w-full h-96 object-cover rounded-lg">
                </div>

                <!-- Detalles -->
                <div>
                    <h1 class="font-andino text-3xl text-stone-800 mb-2">{{ $product->name }}</h1>
                    <p class="text-stone-500 mb-4">🧵 {{ $product->artisan }} • 📍 {{ $product->origin }}</p>
                    
                    <p class="text-3xl font-bold text-[var(--andino-terracota)] mb-6">
                        S/ {{ number_format($product->price, 2) }}
                    </p>

                    <div class="prose prose-stone mb-6">
                        <p>{{ $product->description }}</p>
                    </div>

                    <!-- Stock y acciones -->
                    <div class="border-t border-stone-200 pt-6">
                        @if($product->stock > 0)
                            <form action="{{ route('cart.store') }}" method="POST" class="flex gap-4 items-center">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                
                                <div class="flex items-center border border-stone-300 rounded">
                                    <button type="button" onclick="decrement()" class="px-3 py-2 text-stone-600 hover:bg-stone-100">−</button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                           class="w-12 text-center border-0 focus:ring-0">
                                    <button type="button" onclick="increment()" class="px-3 py-2 text-stone-600 hover:bg-stone-100">+</button>
                                </div>
                                
                                <button type="submit" class="btn-andino px-6 py-3">
                                    🛒 Añadir al carrito
                                </button>
                            </form>
                            <p class="text-sm text-stone-500 mt-2">✅ {{ $product->stock }} unidades disponibles</p>
                        @else
                            <button disabled class="bg-stone-300 text-stone-500 px-6 py-3 rounded cursor-not-allowed">
                                🔴 Agotado
                            </button>
                            <p class="text-sm text-stone-500 mt-2">📧 Avísame cuando esté disponible</p>
                        @endif
                    </div>

                    <!-- Características -->
                    <div class="mt-8 grid grid-cols-2 gap-4 text-sm">
                        <div class="bg-[var(--andino-soft)] p-3 rounded">
                            <span class="block text-stone-500">Material</span>
                            <span class="font-medium">Lana/Paja/Cuero</span>
                        </div>
                        <div class="bg-[var(--andino-soft)] p-3 rounded">
                            <span class="block text-stone-500">Técnica</span>
                            <span class="font-medium">Hecho a mano</span>
                        </div>
                        <div class="bg-[var(--andino-soft)] p-3 rounded">
                            <span class="block text-stone-500">Envío</span>
                            <span class="font-medium text-green-600">Gratis 🚚</span>
                        </div>
                        <div class="bg-[var(--andino-soft)] p-3 rounded">
                            <span class="block text-stone-500">Garantía</span>
                            <span class="font-medium">30 días</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Productos relacionados -->
            @if($related->isNotEmpty())
            <div class="mt-16">
                <h3 class="font-andino text-2xl mb-6">También te puede interesar</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($related as $item)
                    <a href="{{ route('product.show', $item) }}" class="card-product block group">
                        <img src="{{ asset('storage/'.$item->main_image) }}" class="w-full h-32 object-cover rounded">
                        <p class="mt-2 text-sm font-medium group-hover:text-[var(--andino-terracota)]">{{ $item->name }}</p>
                        <p class="text-[var(--andino-terracota)] font-bold">S/ {{ $item->price }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
    function increment() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        if (parseInt(input.value) < max) input.value = parseInt(input.value) + 1;
    }
    function decrement() {
        const input = document.getElementById('quantity');
        if (parseInt(input.value) > 1) input.value = parseInt(input.value) - 1;
    }
    </script>
</x-app-layout>