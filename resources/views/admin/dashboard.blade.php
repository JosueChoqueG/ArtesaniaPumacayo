@extends('layouts.admin')
@section('admin-content')
<h1 class="text-3xl font-['Cormorant_Garamond'] text-stone-800 mb-6">Panel Administrativo</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    @foreach($stats as $label => $value)
    <div class="bg-white p-6 rounded-lg shadow border-l-4 border-amber-700">
        <p class="text-stone-500 text-sm">{{ ucfirst(str_replace('_', ' ', $label)) }}</p>
        <p class="text-2xl font-bold text-stone-800">{{ is_numeric($value) ? number_format($value, 2) : $value }}</p>
    </div>
    @endforeach
</div>

<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">Últimos Pedidos</h3>
    <table class="min-w-full divide-y divide-stone-200">
        <thead><tr><th class="p-3 text-left">ID</th><th class="p-3 text-left">Cliente</th><th class="p-3 text-left">Total</th><th class="p-3 text-left">Estado</th></tr></thead>
        <tbody>
            @foreach($recent_orders as $order)
            <tr class="hover:bg-amber-50">
                <td class="p-3">#{{ $order->id }}</td>
                <td class="p-3">{{ $order->user->name }}</td>
                <td class="p-3">${{ number_format($order->total, 2) }}</td>
                <td class="p-3"><span class="px-2 py-1 text-xs rounded-full {{ $order->status=='pendiente'?'bg-yellow-100 text-yellow-800':'bg-green-100 text-green-800' }}">{{ ucfirst($order->status) }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection