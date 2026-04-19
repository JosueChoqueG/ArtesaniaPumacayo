@extends('layouts.admin')
@section('admin-content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-['Cormorant_Garamond'] text-stone-800 mb-6">Editar: {{ $product->name }}</h1>
    
    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow space-y-4">
        @csrf @method('PUT')
        
        <div>
            <label class="block text-stone-700 font-medium mb-1">Nombre</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full p-2 border border-stone-300 rounded focus:ring-2 focus:ring-amber-600" required>
        </div>

        <div>
            <label class="block text-stone-700 font-medium mb-1">Descripción</label>
            <textarea name="description" rows="3" class="w-full p-2 border border-stone-300 rounded focus:ring-2 focus:ring-amber-600" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-stone-700 font-medium mb-1">Precio (S/)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full p-2 border border-stone-300 rounded focus:ring-2 focus:ring-amber-600" required>
            </div>
            <div>
                <label class="block text-stone-700 font-medium mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full p-2 border border-stone-300 rounded focus:ring-2 focus:ring-amber-600" required>
            </div>
        </div>

        <div>
            <label class="block text-stone-700 font-medium mb-1">Categoría</label>
            <select name="category_id" class="w-full p-2 border border-stone-300 rounded focus:ring-2 focus:ring-amber-600" required>
                <option value="">Seleccionar categoría...</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-stone-700 font-medium mb-1">Artesano / Taller</label>
                <input type="text" name="artisan" value="{{ old('artisan', $product->artisan) }}" class="w-full p-2 border border-stone-300 rounded focus:ring-2 focus:ring-amber-600">
            </div>
            <div>
                <label class="block text-stone-700 font-medium mb-1">Origen</label>
                <input type="text" name="origin" value="{{ old('origin', $product->origin) }}" class="w-full p-2 border border-stone-300 rounded focus:ring-2 focus:ring-amber-600">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-stone-700 font-medium mb-1">Imagen Principal</label>
            <input type="file" name="main_image" accept="image/jpeg,image/png,image/jpg" 
                   class="input-andino" {{ !isset($product) ? 'required' : '' }}>
            
            <!-- Preview -->
            <img id="image-preview" src="{{ isset($product) ? asset('storage/'.$product->main_image) : '' }}" 
                 class="{{ isset($product) ? '' : 'hidden' }} mt-3 h-40 w-40 object-cover rounded border border-stone-200">
            
            <p class="text-xs text-stone-500 mt-1">JPG/PNG • Máx 5MB • Se comprimirá automáticamente</p>
        </div>

        @if($errors->any())
            <div class="p-3 bg-red-50 text-red-700 rounded text-sm">
                @foreach($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 border border-stone-300 rounded text-stone-600 hover:bg-stone-50 transition">Cancelar</a>
            <button type="submit" class="bg-[var(--andino-terracota)] hover:bg-[#733A10] text-white font-semibold py-2 px-4 rounded transition">Actualizar Producto</button>
        </div>
    </form>
</div>
@endsection