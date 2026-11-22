@extends('layout')
@section('title', 'Customers')
@section('content')
<div class="heading"><div><h1>Customers</h1><p class="sub">Keep customer contact details available for checkout.</p></div><a class="btn" href="{{ route('customers.create') }}">＋ Add customer</a></div>
<div class="card tablewrap"><table><thead><tr><th>Full name</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead><tbody>
@forelse($customers as $customer)<tr><td><strong>{{ $customer->full_name }}</strong></td><td>{{ $customer->email }}</td><td>{{ $customer->phone ?: '—' }}</td><td><div class="actions"><a class="btn secondary small" href="{{ route('customers.edit', $customer) }}">Edit</a><form class="inline" method="post" action="{{ route('customers.destroy', $customer) }}" onsubmit="return confirm('Delete this customer?')">@csrf @method('DELETE')<button class="btn danger small" type="submit">Delete</button></form></div></td></tr>@empty<tr><td colspan="4" class="empty">No customers yet.</td></tr>@endforelse
</tbody></table></div>
@endsection
