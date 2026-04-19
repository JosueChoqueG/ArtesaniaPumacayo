@extends('layouts.app')
@section('content')
<div class="flex min-h-screen bg-amber-50">
    <aside class="w-64 bg-stone-900 text-amber-100 p-6">
        <h2 class="text-2xl font-['Cormorant_Garamond'] mb-6">🐎 Admin</h2>
        <nav class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-amber-900/30">Dashboard</a>
            <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded hover:bg-amber-900/30">Productos</a>
            <a href="{{ route('admin.users.index') }}" class="block px-3 py-2 rounded hover:bg-amber-900/30">Usuarios</a>
        </nav>
    </aside>
    <main class="flex-1 p-8">
        @yield('admin-content')
    </main>
</div>
@endsection