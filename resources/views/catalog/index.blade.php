<x-app-layout>
    <x-slot name="header">
        <h2 class="font-andino text-2xl">🧶 Catálogo Andino</h2>
    </x-slot>

    <div class="py-8 bg-[var(--andino-lana)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Filtros -->
            <form method="GET" action="{{ route('catalog') }}" class="card-andino p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    
                    <!-- Búsqueda -->
                    <div class="lg:col-span-2">
                        <input type="text" name="search" placeholder="Buscar sombreros, chalinas..." 
                               value="{{ request('search') }}" 
                               class="input-andino w-full">
                    </div>

                    <!-- Categoría -->
                    <select name="category" class="input-andino">
                        <option value="">Todas las categorías</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Origen -->
                    <select name="origin" class="input-andino">
                        <option value="">Cualquier origen</option>
                        @foreach($origins as $origin)
                            <option value="{{ $origin }}" {{ request('origin') == $origin ? 'selected' : '' }}>
                                {{ $origin }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Ordenar -->
                    <select name="sort" onchange="this.form.submit()" class="input-andino">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Más recientes</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                        <option value="artisan" {{ request('sort') == 'artisan' ? 'selected' : '' }}>Artesano A-Z</option>
                    </select>
                </div>

                <!-- Rango de precio (opcional con JS) -->
                <div class="mt-4 flex gap-4 items-center">
                    <input type="number" name="price_min" placeholder="Precio min" value="{{ request('price_min') }}" 
                           class="input-andino w-32">
                    <span class="text-stone-400">-</span>
                    <input type="number" name="price_max" placeholder="Precio max" value="{{ request('price_max') }}" 
                           class="input-andino w-32">
                    <button type="submit" class="btn-andino px-4 py-2">Filtrar</button>
                    @if(request()->anyFilled(['search','category','origin','price_min','price_max']))
                        <a href="{{ route('catalog') }}" class="text-stone-500 hover:text-stone-700 underline text-sm">Limpiar</a>
                    @endif
                </div>
            </form>

            <!-- Grid de productos -->
            @if($products->isEmpty())
                <div class="text-center py-16 card-andino p-8">
                    <p class="text-xl text-stone-600">🔍 No se encontraron productos con esos filtros</p>
                    <a href="{{ route('catalog') }}" class="btn-andino inline-block mt-4">Ver todos los productos</a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $product)
                    <div class="card-product group">
                        <a href="{{ route('product.show', $product) }}" class="block">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/'.$product->main_image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                                @if($product->stock < 5)
                                    <span class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded">
                                        ¡Pocos!
                                    </span>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-stone-500 mb-1">{{ $product->category->name }}</p>
                                <h3 class="font-andino text-lg text-stone-800 group-hover:text-[var(--andino-terracota)] transition">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-sm text-stone-600 mt-1 line-clamp-2">{{ $product->description }}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-[var(--andino-terracota)] font-bold">S/ {{ number_format($product->price, 2) }}</span>
                                    <form action="{{ route('cart.store') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-andino text-sm px-3 py-1">Añadir</button>
                                    </form>
                                </div>
                                <p class="text-xs text-stone-400 mt-2">🧵 {{ $product->artisan }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>

                <!-- Paginación -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>