<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-[var(--andino-lana)] py-12 px-4">
        <div class="card-andino p-8 max-w-md w-full text-center">
            <div class="text-6xl mb-4">✅</div>
            <h2 class="font-andino text-2xl text-stone-800 mb-2">¡Pedido confirmado!</h2>
            <p class="text-stone-600 mb-4">Gracias por apoyar la artesanía andina 🧶</p>
            
            <div class="bg-[var(--andino-soft)] p-4 rounded-lg mb-6 text-left">
                <p class="text-sm"><strong>Orden:</strong> #{{ $order_id }}</p>
                <p class="text-sm"><strong>Total:</strong> S/ {{ number_format($total, 2) }}</p>
                <p class="text-sm"><strong>Confirmación:</strong> {{ $email }}</p>
            </div>
            
            <p class="text-sm text-stone-500 mb-6">
                Te enviaremos los detalles de tu pedido y el seguimiento del envío a tu correo.
            </p>
            
            <a href="{{ route('catalog') }}" class="btn-andino inline-block px-6 py-2">
                Seguir explorando →
            </a>
        </div>
    </div>
</x-app-layout>