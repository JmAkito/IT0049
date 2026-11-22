@extends('layout')
@section('title', 'Products')
@section('content')
<div class="heading"><div><h1>Products</h1><p class="sub">Manage product names, prices, stock, and images.</p></div><a class="btn" href="{{ route('products.create') }}">＋ Add product</a></div>
<div class="card tablewrap"><table><thead><tr><th>Image</th><th>Name</th><th>Price</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead><tbody>
@forelse($products as $product)<tr>
    <td>@if($product->image)<img class="thumb" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">@else<span class="thumb" style="display:grid;place-items:center;color:#8090a5;font-size:11px">No image</span>@endif</td>
    <td><strong>{{ $product->name }}</strong></td><td>₱{{ number_format($product->price, 2) }}</td><td>{{ number_format($product->stock_quantity) }}</td><td><span class="badge {{ $product->is_active ? '' : 'off' }}">{{ $product->is_active ? 'Active' : 'Archived' }}</span></td>
    <td><div class="actions"><a class="btn secondary small" href="{{ route('products.edit', $product) }}">Edit</a><form class="inline" method="post" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete or archive this product?')">@csrf @method('DELETE')<button class="btn danger small" type="submit">{{ $product->sales()->exists() ? 'Archive' : 'Delete' }}</button></form></div></td>
</tr>@empty<tr><td colspan="6" class="empty">No products yet. Add your first product to get started.</td></tr>@endforelse
</tbody></table></div>
@endsection
