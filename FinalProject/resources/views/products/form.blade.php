@extends('layout')
@section('title', $heading)
@section('content')
<div class="heading"><div><h1>{{ $heading }}</h1><p class="sub">Enter the product details below.</p></div><a class="btn secondary" href="{{ route('products.index') }}">← Back to products</a></div>
<form class="card pad" method="post" enctype="multipart/form-data" action="{{ $product->exists ? route('products.update', $product) : route('products.store') }}">
@csrf @if($product->exists) @method('PUT') @endif
<div class="formgrid">
<div class="field"><label for="name">Product name</label><input id="name" name="name" value="{{ old('name', $product->name) }}" maxlength="120" required></div>
<div class="field"><label for="price">Price (₱)</label><input id="price" type="number" step="0.01" min="0.01" name="price" value="{{ old('price', $product->price) }}" required></div>
<div class="field"><label for="stock_quantity">Stock quantity</label><input id="stock_quantity" type="number" min="0" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity ?? 0) }}" required></div>
<div class="field"><label for="image">Product image</label><input id="image" type="file" name="image" accept="image/jpeg,image/png,image/webp"><span class="hint">JPG, PNG, or WebP · maximum 2 MB</span></div>
@if($product->image)<div class="field full"><span class="hint">Current image</span><img class="thumb" style="width:100px;height:100px" src="{{ asset('storage/'.$product->image) }}" alt="Current {{ $product->name }} image"></div>@endif
<div class="field full" style="flex-direction:row;align-items:center"><button class="btn" type="submit">Save product</button><a class="btn secondary" href="{{ route('products.index') }}">Cancel</a></div>
</div></form>
@endsection
