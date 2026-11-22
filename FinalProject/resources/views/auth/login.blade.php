@extends('layout')
@section('title', 'Sign in')
@section('content')
<section class="loginpage"><div class="card login">
    <h1>Welcome back</h1><p>Sign in to manage your point of sale.</p>
    @if(session('success'))<div class="flash">{{ session('success') }}</div>@endif
    <form method="post" action="{{ url('/login') }}">@csrf
        <div class="field"><label for="username">Username</label><input id="username" name="username" value="{{ old('username') }}" autocomplete="username" required autofocus></div>
        <div class="field"><label for="password">Password</label><input id="password" type="password" name="password" autocomplete="current-password" required></div>
        <label style="display:flex;align-items:center;gap:8px;margin:8px 0 15px;font-weight:500"><input type="checkbox" name="remember" value="1" style="width:auto"> Remember me</label>
        <button class="btn" type="submit">Sign in</button>
    </form>
    <div class="footer">Demo login: <strong>admin</strong> / <strong>Admin123!</strong></div>
</div></section>
@endsection
