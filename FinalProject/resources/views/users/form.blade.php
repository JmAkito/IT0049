@extends('layout')
@section('title', $heading)
@section('content')
<div class="heading"><div><h1>{{ $heading }}</h1><p class="sub">Passwords are securely hashed before they are saved.</p></div><a class="btn secondary" href="{{ route('users.index') }}">← Back to staff</a></div>
<form class="card pad" method="post" enctype="multipart/form-data" action="{{ $staff->exists ? route('users.update', $staff) : route('users.store') }}">@csrf @if($staff->exists) @method('PUT') @endif
<div class="formgrid"><div class="field"><label for="full_name">Full name</label><input id="full_name" name="full_name" value="{{ old('full_name', $staff->full_name) }}" maxlength="120" required></div><div class="field"><label for="username">Username</label><input id="username" name="username" value="{{ old('username', $staff->username) }}" maxlength="60" required></div>
<div class="field"><label for="password">{{ $staff->exists ? 'New password (leave blank to keep current)' : 'Password' }}</label><input id="password" type="password" name="password" minlength="8" {{ $staff->exists ? '' : 'required' }} autocomplete="new-password"><span class="hint">At least 8 characters.</span></div><div class="field"><label for="avatar">Avatar</label><input id="avatar" type="file" name="avatar" accept="image/jpeg,image/png,image/webp"><span class="hint">JPG, PNG, or WebP · maximum 2 MB</span></div>
@if($staff->avatar)<div class="field full"><span class="hint">Current avatar</span><img class="avatar" style="width:76px;height:76px" src="{{ asset('storage/'.$staff->avatar) }}" alt="Current avatar"></div>@endif
<div class="field full" style="flex-direction:row;align-items:center"><button class="btn" type="submit">Save staff account</button><a class="btn secondary" href="{{ route('users.index') }}">Cancel</a></div></div>
</form>
@endsection
