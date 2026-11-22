@extends('layout')
@section('title', 'Dashboard')
@section('content')
<div class="heading"><div><h1>Dashboard</h1><p class="sub">A quick view of today’s store activity.</p></div><a class="btn" href="{{ route('sales.create') }}">＋ Record a sale</a></div>
<section class="grid stats">
    <div class="card stat"><div class="label">Active products</div><div class="num">{{ $productCount }}</div></div>
    <div class="card stat"><div class="label">Customers</div><div class="num">{{ $customerCount }}</div></div>
    <div class="card stat"><div class="label">Staff accounts</div><div class="num">{{ $staffCount }}</div></div>
    <div class="card stat"><div class="label">Sales today</div><div class="num">₱{{ number_format($todayTotal, 2) }}</div></div>
</section>
<section class="grid cols">
    <div class="card"><div class="pad" style="padding-bottom:8px"><h2 style="font-size:18px;margin:0">Recent sales</h2></div><div class="tablewrap"><table><thead><tr><th>Product</th><th>Customer</th><th>Staff</th><th>Total</th></tr></thead><tbody>
    @forelse($latestSales as $sale)<tr><td>{{ $sale->product->name }}</td><td>{{ $sale->customer?->full_name ?? 'Walk-in' }}</td><td>{{ $sale->staff->full_name }}</td><td>₱{{ number_format($sale->total_price, 2) }}</td></tr>@empty<tr><td colspan="4" class="empty">No sales recorded yet.</td></tr>@endforelse
    </tbody></table></div><div class="pad"><a href="{{ route('sales.index') }}">View all sales →</a></div></div>
    <div class="card"><div class="pad"><h2 style="font-size:18px;margin:0 0 12px">Low stock</h2>
    @forelse($lowStock as $product)<div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid var(--line)"><span>{{ $product->name }}</span><span class="low">{{ $product->stock_quantity }} left</span></div>@empty<p class="sub">All active products have more than five units.</p>@endforelse
    <p style="margin:18px 0 0"><a href="{{ route('products.index') }}">Manage products →</a></p></div></div>
</section>
@endsection
