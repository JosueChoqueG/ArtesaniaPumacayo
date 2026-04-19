<x-app-layout>
    <x-slot name="header">
        <h2 class="font-andino text-2xl">💳 Finalizar Compra</h2>
    </x-slot>

    <div class="py-12 bg-[var(--andino-lana)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('cart.checkout.process') }}" method="POST" class="card-andino p-6 sm:p-8">
                @csrf
                <input type="hidden" name="total" value="{{ $total }}">

                <!-- Datos del comprador -->
                <h3 class="font-andino text-xl mb-4 pb-2 border-b border-stone-200">📋 Datos de envío</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Nombre completo *</label>
                        <input type="text" name="name" required class="input-andino" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Email *</label>
                        <input type="email" name="email" required class="input-andino" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Teléfono *</label>
                        <input type="tel" name="phone" required class="input-andino" value="{{ old('phone') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-stone-700 mb-1">Ciudad *</label>
                        <input type="text" name="city" required class="input-andino" value="{{ old('city') }}">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-stone-700 mb-1">Dirección completa *</label>
                    <textarea name="address" rows="2" required class="input-andino">{{ old('address') }}</textarea>
                </div>

                <!-- Método de pago -->
                <h3 class="font-andino text-xl mb-4 pb-2 border-b border-stone-200">💰 Método de pago</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="efectivo" class="peer sr-only" checked>
                        <div class="p-4 border-2 border-stone-200 rounded-lg peer-checked:border-[var(--andino-terracota)] peer-checked:bg-amber-50 transition text-center">
                            <span class="text-2xl">💵</span>
                            <p class="font-medium mt-1">Efectivo</p>
                            <p class="text-xs text-stone-500">Al recibir</p>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="tarjeta" class="peer sr-only">
                        <div class="p-4 border-2 border-stone-200 rounded-lg peer-checked:border-[var(--andino-terracota)] peer-checked:bg-amber-50 transition text-center">
                            <span class="text-2xl">💳</span>
                            <p class="font-medium mt-1">Tarjeta</p>
                            <p class="text-xs text-stone-500">MercadoPago</p>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="transferencia" class="peer sr-only">
                        <div class="p-4 border-2 border-stone-200 rounded-lg peer-checked:border-[var(--andino-terracota)] peer-checked:bg-amber-50 transition text-center">
                            <span class="text-2xl">🏦</span>
                            <p class="font-medium mt-1">Transferencia</p>
                            <p class="text-xs text-stone-500">BCP/Interbank</p>
                        </div>
                    </label>
                </div>

                <!-- Resumen final -->
                <div class="bg-[var(--andino-soft)] p-4 rounded-lg mb-6">
                    <div class="flex justify-between items-center">
                        <span class="font-medium">Total a pagar:</span>
                        <span class="text-2xl font-bold text-[var(--andino-terracota)]">S/ {{ number_format($total, 2) }}</span>
                    </div>
                    <p class="text-xs text-stone-500 mt-1">✓ Envío gratis a nivel nacional • ✓ Pago seguro</p>
                </div>

                <!-- Botón de confirmación -->
                <button type="submit" class="btn-andino w-full py-3 text-lg font-medium">
                    Confirmar pedido 🐎
                </button>
                
                <p class="text-xs text-stone-500 text-center mt-3">
                    Al confirmar, aceptas nuestros <a href="#" class="underline">términos y condiciones</a>
                </p>
            </form>
        </div>
    </div>
</x-app-layout>