<x-app-layout>
    <x-slot name="header">
        <h2 class="font-andino text-xl text-stone-800 leading-tight">
            {{ __('Mi Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Actualizar información de perfil --}}
            <div class="card-andino p-4 sm:p-8 bg-white">
                <h3 class="text-lg font-medium text-stone-800 mb-4">Información Personal</h3>
                
                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block text-sm font-medium text-stone-700">Nombre completo</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                               class="input-andino mt-1" required autofocus autocomplete="name">
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-stone-700">Correo electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                               class="input-andino mt-1" required autocomplete="username">
                        @error('email')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-stone-700">Teléfono</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                               class="input-andino mt-1" autocomplete="tel">
                        @error('phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-stone-700">Dirección</label>
                        <textarea name="address" id="address" rows="2" 
                                  class="input-andino mt-1">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="btn-andino">Guardar cambios</button>
                        
                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-green-600" data-auto-close>Guardado correctamente</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Actualizar contraseña --}}
            <div class="card-andino p-4 sm:p-8 bg-white">
                <h3 class="text-lg font-medium text-stone-800 mb-4">Actualizar Contraseña</h3>
                
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label for="update_password_current_password" class="block text-sm font-medium text-stone-700">Contraseña actual</label>
                        <input type="password" name="current_password" id="update_password_current_password" 
                               class="input-andino mt-1" autocomplete="current-password">
                        @error('updatePassword', 'password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="update_password_password" class="block text-sm font-medium text-stone-700">Nueva contraseña</label>
                        <input type="password" name="password" id="update_password_password" 
                               class="input-andino mt-1" autocomplete="new-password">
                        @error('password', 'password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="update_password_password_confirmation" class="block text-sm font-medium text-stone-700">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" id="update_password_password_confirmation" 
                               class="input-andino mt-1" autocomplete="new-password">
                        @error('password_confirmation', 'password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="btn-andino">Actualizar contraseña</button>
                        
                        @if (session('status') === 'password-updated')
                            <p class="text-sm text-green-600" data-auto-close>Contraseña actualizada</p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Eliminar cuenta --}}
            <div class="card-andino p-4 sm:p-8 bg-white border-l-red-600">
                <h3 class="text-lg font-medium text-red-700 mb-4">Eliminar Cuenta</h3>
                <p class="text-sm text-stone-600 mb-4">Una vez eliminada, no podrás recuperar tu cuenta ni tus pedidos.</p>
                
                <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
                    @csrf
                    @method('delete')

                    <div>
                        <label for="password" class="block text-sm font-medium text-stone-700">Confirma tu contraseña</label>
                        <input type="password" name="password" id="password" 
                               class="input-andino mt-1" placeholder="Tu contraseña actual">
                        @error('userDeletion', 'password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded transition"
                                onclick="return confirm('¿Estás seguro de eliminar tu cuenta?')">
                            Eliminar cuenta permanentemente
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
