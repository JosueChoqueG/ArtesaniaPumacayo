<x-app-layout>
    <div class="relative overflow-hidden bg-[var(--andino-lana)]">
        <!-- Decoración de fondo -->
        <div class="absolute inset-0 pattern-andino opacity-10"></div>
        
        <!-- Hero Section -->
        <section class="relative pt-16 pb-20 lg:pt-24 lg:pb-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                    <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-[var(--andino-cuero)] sm:text-5xl md:text-6xl">
                            <span class="block">Tradición y Arte</span>
                            <span class="block text-[var(--andino-terracota)]">Artesanía Pumacayo</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg">
                            Descubre la esencia de la cultura andina a través de nuestras piezas únicas, 
                            hechas a mano por maestros artesanos con técnicas ancestrales y materiales naturales.
                        </p>
                        <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('register') }}" class="btn-andino text-center py-3 px-8 shadow-lg transform transition hover:-translate-y-0.5">
                                    Empezar a Explorar
                                </a>
                                <a href="#colecciones" class="btn-andino-outline text-center py-3 px-8 transform transition hover:-translate-y-0.5">
                                    Ver Colecciones
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                        <div class="relative mx-auto w-full rounded-lg shadow-2xl lg:max-w-md overflow-hidden border-4 border-white">
                            <img class="w-full object-cover" src="{{ asset('images/hero_welcome.png') }}" alt="Artesanía Andina Pumacayo">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Section -->
        <section id="colecciones" class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-[var(--andino-cuero)] mb-12">Nuestras Colecciones</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Textiles -->
                    <div class="card-andino p-8 flex flex-col items-center">
                        <div class="w-16 h-16 bg-[#FDF8F3] rounded-full flex items-center justify-center mb-4 text-[var(--andino-terracota)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Textiles de Alpaca</h3>
                        <p class="text-gray-600 text-sm italic">Tejidos a mano con lana de la más alta calidad y tintes naturales.</p>
                    </div>
                    <!-- Cerámica -->
                    <div class="card-andino p-8 flex flex-col items-center border-l-[var(--andino-terracota)]">
                        <div class="w-16 h-16 bg-[#FDF8F3] rounded-full flex items-center justify-center mb-4 text-[var(--andino-terracota)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Cerámica Tradicional</h3>
                        <p class="text-gray-600 text-sm italic">Barro moldeado y pintado con motivos que cuentan historias milenarias.</p>
                    </div>
                    <!-- Joyería -->
                    <div class="card-andino p-8 flex flex-col items-center border-l-[var(--andino-bronce)]">
                        <div class="w-16 h-16 bg-[#FDF8F3] rounded-full flex items-center justify-center mb-4 text-[var(--andino-terracota)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Platería y Joyería</h3>
                        <p class="text-gray-600 text-sm italic">Diseños inspirados en la astronomía y naturaleza andina.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
