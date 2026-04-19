<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Artesanía Andina') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Vite: CSS y JS compilados -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">

    @include('layouts.navigation')

    @isset($header)
        <header class="bg-white shadow-sm border-b border-stone-200">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="flex-1">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded" data-auto-close>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
                <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded" data-auto-close>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <footer class="bg-[var(--andino-cuero)] text-amber-100 pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                
                <!-- 1. Identidad -->
                <div class="col-span-1 md:col-span-1">
                    <h3 class="font-andino text-2xl mb-4 text-white">Artesanía Pumacayo</h3>
                    <p class="text-sm opacity-80 mb-4">
                        Preservamos la tradición andina con cada pieza. Calidad, historia y pasión por el detalle.
                    </p>
                    <div class="flex space-x-4">
                        <!-- Facebook -->
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <!-- TikTok -->
                        <a href="#" class="text-gray-400 hover:text-white transition">
                             <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- 2. Enlaces Rápidos -->
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase tracking-wider">Tienda</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="{{ route('catalog') }}" class="hover:text-white transition">Catálogo</a></li>
                        <li><a href="#" class="hover:text-white transition">Sombreros</a></li>
                        <li><a href="#" class="hover:text-white transition">Lazos y Cuero</a></li>
                        <li><a href="#" class="hover:text-white transition">Ofertas</a></li>
                    </ul>
                </div>

                <!-- 3. Atención al Cliente -->
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase tracking-wider">Ayuda</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li><a href="#" class="hover:text-white transition">Envíos y Entregas</a></li>
                        <li><a href="#" class="hover:text-white transition">Devoluciones</a></li>
                        <li><a href="#" class="hover:text-white transition">Preguntas Frecuentes</a></li>
                        <li><a href="#" class="hover:text-white transition">Términos y Condiciones</a></li>
                    </ul>
                </div>

                <!-- 4. Contacto -->
                <div>
                    <h4 class="text-white font-bold mb-4 uppercase tracking-wider">Contacto</h4>
                    <ul class="space-y-2 text-sm opacity-80">
                        <li class="flex items-start gap-2">
                            <span>📍</span>
                            <span>Av. Los Artesanos 123, Plaza de Armas</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>📞</span>
                            <a href="tel:+51999999999" class="hover:text-white">+51 999 999 999</a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span>✉️</span>
                            <a href="mailto:ventas@pumacayo.com" class="hover:text-white">ventas@pumacayo.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 text-center text-sm opacity-60">
                <p>&copy; {{ date('Y') }} Artesanía Pumacayo. Todos los derechos reservados.</p>
                <p class="mt-1">Hecho con ❤️ y tradición andina.</p>
            </div>
        </div>
    </footer>

</body>
</html>
