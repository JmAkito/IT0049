@extends('layout')
@section('title', 'New sale')
@section('content')
<div class="heading"><div><h1>Record a sale</h1><p class="sub">Choose a product and quantity. Inventory updates only after a valid sale.</p></div><a class="btn secondary" href="{{ route('sales.index') }}">Sales history</a></div>
@if($products->isEmpty())<div class="card empty">There are no active products in stock. <a href="{{ route('products.create') }}">Add a product</a> or update its stock first.</div>@else
<form class="card pad" method="post" action="{{ route('sales.store') }}">@csrf
<div class="formgrid"><div class="field full"><label for="product_id">Product</label><select id="product_id" name="product_id" required><option value="">Select a product</option>@foreach($products as $product)<option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->stock_quantity }}" @selected(old('product_id') == $product->id)>{{ $product->name }} · ₱{{ number_format($product->price, 2) }} · {{ $product->stock_quantity }} in stock</option>@endforeach</select></div>
<div class="field"><label for="customer_id">Customer (optional)</label><select id="customer_id" name="customer_id"><option value="">Walk-in customer</option>@foreach($customers as $customer)<option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>{{ $customer->full_name }} · {{ $customer->email }}</option>@endforeach</select></div>
<div class="field"><label for="quantity">Quantity</label><input id="quantity" type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" required><span class="hint" id="stock-hint">Choose a product to see available stock.</span></div>
<div class="field full card pad" style="background:#f8fafc;box-shadow:none"><span class="hint">Estimated total</span><strong id="total" style="font-size:25px">₱0.00</strong><span class="hint">The server calculates the final total from the saved product price.</span></div>
<div class="field full" style="flex-direction:row;align-items:center"><button class="btn" type="submit">Complete sale</button><a class="btn secondary" href="{{ route('dashboard') }}">Cancel</a></div></div>
</form>
<script>
const productField=document.getElementById('product_id'), quantityField=document.getElementById('quantity');
function updateTotal(){const option=productField.options[productField.selectedIndex], price=Number(option?.dataset.price||0), stock=option?.dataset.stock; document.getElementById('total').textContent='₱'+(price*(Number(quantityField.value)||0)).toFixed(2); document.getElementById('stock-hint').textContent=stock ? `Available stock: ${stock}` : 'Choose a product to see available stock.';}
productField.addEventListener('change',updateTotal);quantityField.addEventListener('input',updateTotal);updateTotal();
</script>
@endif
@endsection
