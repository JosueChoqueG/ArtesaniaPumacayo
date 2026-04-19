@extends('layouts.admin')
@section('admin-content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-['Cormorant_Garamond']">Productos</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-amber-700 hover:bg-amber-800 text-white px-4 py-2 rounded">+ Nuevo</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-amber-100"><tr><th class="p-4">ID</th><th class="p-4">Nombre</th><th class="p-4">Categoría</th><th class="p-4">Precio</th><th class="p-4">Stock</th><th class="p-4">Acciones</th></tr></thead>
        <tbody>
            @foreach($products as $p)
            <tr class="border-b hover:bg-amber-50">
                <td class="p-4">{{ $p->id }}</td>
                <td class="p-4">{{ $p->name }}</td>
                <td class="p-4">{{ $p->category->name }}</td>
                <td class="p-4">${{ $p->price }}</td>
                <td class="p-4">{{ $p->stock }}</td>
                <td class="p-4 flex gap-2">
                    <a href="{{ route('admin.products.edit', $p) }}" class="text-amber-700 hover:underline">Editar</a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $products->links() }}</div>
</div>
@endsection