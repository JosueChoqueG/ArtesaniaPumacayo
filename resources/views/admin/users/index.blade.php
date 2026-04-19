@extends('layouts.admin')
@section('admin-content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
    <h1 class="text-2xl font-['Cormorant_Garamond'] text-stone-800">Gestión de Usuarios</h1>
    <div class="text-sm text-stone-500">Total: {{ $users->total() }} | Página: {{ $users->currentPage() }}</div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-stone-200">
        <thead class="bg-amber-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-medium text-stone-500 uppercase">Usuario</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-stone-500 uppercase">Email</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-stone-500 uppercase">Rol</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-stone-500 uppercase">Estado</th>
                <th class="px-4 py-3 text-right text-xs font-medium text-stone-500 uppercase">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse($users as $user)
            <tr class="hover:bg-amber-50/50 transition">
                <td class="px-4 py-3 font-medium text-stone-800">{{ $user->name }}</td>
                <td class="px-4 py-3 text-stone-600">{{ $user->email }}</td>
                <td class="px-4 py-3">
                    <form action="{{ route('admin.users.role', $user) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <select name="role" onchange="this.form.submit()" class="text-sm border-stone-300 rounded p-1.5 focus:ring-amber-600 focus:border-amber-600 bg-white">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs rounded-full font-medium {{ $user->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $user->active ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td class="px-4 py-3 text-right">
                    <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-medium transition hover:underline {{ $user->active ? 'text-red-600 hover:text-red-800' : 'text-green-600 hover:text-green-800' }}">
                            {{ $user->active ? 'Desactivar' : 'Activar' }}
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-stone-500">No se encontraron usuarios registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t border-stone-100">
        {{ $users->links() }}
    </div>
</div>
@endsection