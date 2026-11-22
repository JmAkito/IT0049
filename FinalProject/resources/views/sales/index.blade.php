@extends('layout')
@section('title', 'Sales history')
@section('content')
<div class="heading"><div><h1>Sales history</h1><p class="sub">Every transaction with its product, customer, staff member, and date.</p></div><a class="btn" href="{{ route('sales.create') }}">＋ Record sale</a></div>
<div class="card tablewrap"><table><thead><tr><th>Date and time</th><th>Product</th><th>Customer</th><th>Staff</th><th>Quantity</th><th>Total</th></tr></thead><tbody>
@forelse($sales as $sale)<tr><td>{{ $sale->created_at->format('M j, Y g:i A') }}</td><td>{{ $sale->product->name }}</td><td>{{ $sale->customer?->full_name ?? 'Walk-in' }}</td><td>{{ $sale->staff->full_name }}</td><td>{{ number_format($sale->quantity) }}</td><td><strong>₱{{ number_format($sale->total_price, 2) }}</strong></td></tr>@empty<tr><td colspan="6" class="empty">There are no transactions yet.</td></tr>@endforelse
</tbody></table></div><div class="card pagination">{{ $sales->links() }}</div>
@endsection
