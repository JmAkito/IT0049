@extends('layout')
@section('title', $heading)
@section('content')
<div class="heading"><div><h1>{{ $heading }}</h1><p class="sub">Customer name, email, and optional phone.</p></div><a class="btn secondary" href="{{ route('customers.index') }}">← Back to customers</a></div>
<form class="card pad" method="post" action="{{ $customer->exists ? route('customers.update', $customer) : route('customers.store') }}">@csrf @if($customer->exists) @method('PUT') @endif
<div class="formgrid"><div class="field"><label for="full_name">Full name</label><input id="full_name" name="full_name" value="{{ old('full_name', $customer->full_name) }}" maxlength="150" required></div><div class="field"><label for="email">Email</label><input id="email" type="email" name="email" value="{{ old('email', $customer->email) }}" maxlength="150" required></div><div class="field"><label for="phone">Phone (optional)</label><input id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" maxlength="30"></div><div class="field full" style="flex-direction:row;align-items:center"><button class="btn" type="submit">Save customer</button><a class="btn secondary" href="{{ route('customers.index') }}">Cancel</a></div></div>
</form>
@endsection
