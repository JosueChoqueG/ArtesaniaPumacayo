@extends('layouts.app')

@section('content')

    {{-- 🐎 HERO SECTION --}}
    <section class="relative h-[500px] md:h-[600px] flex items-center justify-center bg-cover bg-center" 
             style="background-image: url('https://images.unsplash.com/photo-1534430480872-3498386e7856?q=80&w=1470&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/60"></div> {{-- Oscurece la imagen para leer texto --}}
        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
            <h1 class="font-andino text-4xl md:text-6xl text-amber-100 mb-4 drop-shadow-lg">
                Tradición Andina en tus Manos
            </h1>
            <p class="text-gray-200 text-lg md:text-xl mb-8 font-light">
                Sombreros, chalinas y talabartería hecha a mano por artesanos expertos. <br>
                Lleva contigo un pedazo de historia.
            </p>
            <a href="{{ route('catalog') }}" class="btn-andino text-lg px-8 py-3 rounded shadow-lg hover:scale-105 transition inline-block">
                Ver Catálogo 
            </a>
        </div>
    </section>

    {{-- ✅ BARRA DE BENEFICIOS --}}
    <section class="bg-white border-b border-stone-200 py-6">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
            <div>
                <span class="text-2xl">🧶</span>
                <h3 class="font-bold text-stone-800">100% Artesanal</h3>
                <p class="text-xs text-stone-500">Hecho a mano</p>
            </div>
            <div>
                <span class="text-2xl">🚚</span>
                <h3 class="font-bold text-stone-800">Envío Gratis</h3>
                <p class="text-xs text-stone-500">A todo el país</p>
            </div>
            <div>
                <span class="text-2xl">💳</span>
                <h3 class="font-bold text-stone-800">Pago Seguro</h3>
                <p class="text-xs text-stone-500">Tarjetas y Yape</p>
            </div>
            <div>
                <span class="text-2xl">🛡️</span>
                <h3 class="font-bold text-stone-800">Garantía</h3>
                <p class="text-xs text-stone-500">Calidad asegurada</p>
            </div>
        </div>
    </section>

    {{-- 🏷️ CATEGORÍAS DESTACADAS --}}
    <section class="py-16 bg-[var(--andino-lana)]">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-andino text-3xl md:text-4xl text-[var(--andino-cuero)]">Nuestras Especialidades</h2>
                <div class="w-24 h-1 bg-[var(--andino-ocre)] mx-auto mt-4 rounded"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Categoría 1: Sombreros -->
                <a href="{{ route('catalog') }}" class="group relative overflow-hidden rounded-lg shadow-lg h-64">
                    <img src="https://images.unsplash.com/photo-1575425952543-23722d4008f7?q=80&w=1470" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition flex items-center justify-center">
                        <span class="text-white font-andino text-2xl font-bold border-2 border-white px-6 py-2">Sombreros</span>
                    </div>
                </a>
                <!-- Categoría 2: Textiles -->
                <a href="{{ route('catalog') }}" class="group relative overflow-hidden rounded-lg shadow-lg h-64">
                    <img src="https://images.unsplash.com/photo-1605640840605-14ac1855827b?q=80&w=1336" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition flex items-center justify-center">
                        <span class="text-white font-andino text-2xl font-bold border-2 border-white px-6 py-2">Chalinas & Ponchos</span>
                    </div>
                </a>
                <!-- Categoría 3: Talabartería -->
                <a href="{{ route('catalog') }}" class="group relative overflow-hidden rounded-lg shadow-lg h-64">
                    <img src="https://images.unsplash.com/photo-1550080704-6432740d0b25?q=80&w=1368" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/30 transition flex items-center justify-center">
                        <span class="text-white font-andino text-2xl font-bold border-2 border-white px-6 py-2">Lazos & Cuero</span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- 🛍️ PRODUCTOS DESTACADOS --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-andino text-3xl md:text-4xl text-[var(--andino-cuero)]">Lo Más Vendido</h2>
                <p class="text-stone-500 mt-2">Piezas únicas elegidas para ti</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredProducts as $product)
                    <div class="card-product group">
                        <a href="{{ route('product.show', $product) }}">
                            <div class="relative overflow-hidden h-48">
                                <img src="{{ asset('storage/'.$product->main_image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @if($product->stock < 5 && $product->stock > 0)
                                    <span class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded font-bold">¡Últimos!</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-xs text-stone-500 uppercase tracking-wide">{{ $product->category->name }}</p>
                                <h3 class="font-andino text-lg text-stone-800 mt-1 group-hover:text-[var(--andino-terracota)] truncate">{{ $product->name }}</h3>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-[var(--andino-terracota)] font-bold text-lg">S/ {{ number_format($product->price, 2) }}</span>
                                    <form action="{{ route('cart.store') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="text-[var(--andino-terracota)] border border-[var(--andino-terracota)] p-1 rounded hover:bg-[var(--andino-terracota)] hover:text-white transition" title="Añadir rápido">
                                            🛒
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-4 text-center py-10 text-stone-500">
                        <p>Aún no hay productos disponibles.</p>
                        <a href="{{ route('admin.products.create') }}" class="btn-andino mt-4">Ir al Admin</a>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('catalog') }}" class="btn-andino-outline px-8 py-3 rounded text-lg">Ver Todo el Catálogo →</a>
            </div>
        </div>
    </section>

    {{-- 📍 SECCIÓN DE CONTACTO Y CONFIANZA --}}
    <section class="bg-[var(--andino-soft)] py-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="font-andino text-3xl text-[var(--andino-cuero)] mb-4">Visítanos en nuestra tienda física</h2>
                <p class="text-stone-600 mb-6">
                    Nos encanta recibirte y mostrarte la calidad de nuestros materiales. Ven a conocer las texturas y probarte los sombreros.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <span class="text-[var(--andino-terracota)] mr-3 text-xl">📍</span>
                        <div>
                            <strong class="block text-stone-800">Dirección:</strong>
                            <span class="text-stone-600">Av. Los Artesanos 123, Plaza de Armas (Jr. de la Unión)</span>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <span class="text-[var(--andino-terracota)] mr-3 text-xl">📞</span>
                        <div>
                            <strong class="block text-stone-800">Teléfono / WhatsApp:</strong>
                            <a href="https://wa.me/51999999999" class="text-green-600 hover:underline font-bold">+51 999 999 999</a>
                        </div>
                    </li>
                    <li class="flex items-start">
                        <span class="text-[var(--andino-terracota)] mr-3 text-xl">🕒</span>
                        <div>
                            <strong class="block text-stone-800">Horario:</strong>
                            <span class="text-stone-600">Lun - Sáb: 9:00 AM - 6:00 PM</span>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- Mapa simulado o imagen de la tienda -->
            <div class="rounded-lg overflow-hidden shadow-lg h-64 md:h-80 bg-gray-300 relative group">
                <!-- Aquí podrías poner un iframe de Google Maps -->
                <img src="https://images.unsplash.com/photo-1582555172866-f73bb12a2ab3?q=80&w=1480" class="w-full h-full object-cover">
                <div class="absolute inset-0 flex items-center justify-center bg-black/20 group-hover:bg-black/10 transition">
                    <a href="https://maps.google.com" target="_blank" class="bg-white px-4 py-2 rounded shadow text-stone-800 font-bold hover:bg-[var(--andino-terracota)] hover:text-white transition">
                        Ver en Google Maps
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- 🔗 BOTÓN FLOTANTE DE WHATSAPP --}}
    <a href="https://wa.me/51999999999?text=Hola,%20quisiera%20más%20información%20sobre%20sus%20artesanías" 
       target="_blank"
       class="fixed bottom-6 right-6 z-50 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition hover:scale-110 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.711 2.592 2.654-.696c1.001.572 1.973.911 3.007.911l.003-.001c3.182 0 5.768-2.587 5.768-5.766-.001-1.546-.603-2.996-1.695-4.088a5.728 5.728 0 0 0-4.077-1.695zm0 10.019c-.794 0-1.581-.206-2.283-.584l-.163-.088-1.689.443.451-1.648-.096-.153a4.271 4.271 0 0 1-.664-2.29c0-2.385 1.939-4.327 4.329-4.327 1.154 0 2.24.452 3.055 1.272a4.297 4.297 0 0 1 1.264 3.06c-.002 2.384-1.939 4.315-4.304 4.315zm2.339-3.195c-.129-.064-.76-.375-.878-.418-.119-.043-.206-.064-.293.064-.086.129-.335.418-.41.504-.076.086-.151.097-.28.032-.129-.064-.544-.201-1.036-.641-.383-.343-.641-.766-.717-.895-.076-.129-.008-.199.057-.263.058-.058.129-.151.194-.226.064-.076.086-.129.129-.215.043-.086.022-.162-.011-.226-.032-.064-.293-.706-.402-.968-.106-.255-.215-.22-.293-.224l-.249-.004c-.086 0-.226.032-.344.162-.119.129-.453.443-.453 1.08s.463 1.251.528 1.337c.064.086.91 1.391 2.207 1.952.309.134.549.214.736.273.309.099.591.085.814.052.248-.037.76-.311.868-.612.108-.301.108-.559.076-.612-.032-.054-.119-.086-.248-.151z"/>
        </svg>
        <span class="font-bold hidden md:inline">¡Escríbenos!</span>
    </a>

@endsection