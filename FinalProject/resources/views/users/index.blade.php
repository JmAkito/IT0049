@extends('layout')
@section('title', 'Staff')
@section('content')
<div class="heading"><div><h1>Staff accounts</h1><p class="sub">Manage the people who can sign in to the POS.</p></div><a class="btn" href="{{ route('users.create') }}">＋ Add staff</a></div>
<div class="card tablewrap"><table><thead><tr><th>Staff member</th><th>Username</th><th>Sales recorded</th><th>Actions</th></tr></thead><tbody>
@forelse($users as $staffMember)<tr><td><div style="display:flex;align-items:center;gap:11px">@if($staffMember->avatar)<img class="avatar" src="{{ asset('storage/'.$staffMember->avatar) }}" alt="{{ $staffMember->full_name }}">@else<span class="avatar">{{ strtoupper(substr($staffMember->full_name,0,1)) }}</span>@endif<strong>{{ $staffMember->full_name }} @if($staffMember->is(auth()->user()))<span class="hint">(you)</span>@endif</strong></div></td><td>{{ $staffMember->username }}</td><td>{{ $staffMember->sales()->count() }}</td><td><div class="actions"><a class="btn secondary small" href="{{ route('users.edit', $staffMember) }}">Edit</a><form class="inline" method="post" action="{{ route('users.destroy', $staffMember) }}" onsubmit="return confirm('Delete this staff account?')">@csrf @method('DELETE')<button class="btn danger small" type="submit">Delete</button></form></div></td></tr>@empty<tr><td colspan="4" class="empty">No staff accounts.</td></tr>@endforelse
</tbody></table></div>
@endsection
