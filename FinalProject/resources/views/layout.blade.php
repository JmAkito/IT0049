<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') · FinalProject POS</title>
    <style>
        :root{--ink:#17243a;--muted:#718096;--line:#e5eaf1;--paper:#fff;--bg:#f3f6fa;--blue:#2463eb;--nav:#14233b;--green:#087f5b;--red:#c2413b}
        *{box-sizing:border-box}body{margin:0;background:var(--bg);color:var(--ink);font:15px/1.5 Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif}
        a{color:var(--blue);text-decoration:none}a:hover{text-decoration:underline}.top{background:var(--nav);color:white;box-shadow:0 2px 9px #16243a22}.nav{max-width:1160px;margin:auto;min-height:66px;padding:12px 22px;display:flex;align-items:center;justify-content:space-between;gap:18px}.brand{font-weight:750;color:#fff;font-size:18px;white-space:nowrap}.navlinks{display:flex;flex-wrap:wrap;align-items:center;gap:6px}.navlinks a,.navlinks button{padding:8px 10px;border:0;border-radius:8px;color:#d8e0ed;background:transparent;font:inherit;cursor:pointer}.navlinks a:hover,.navlinks button:hover,.navlinks .active{background:#ffffff18;color:#fff;text-decoration:none}.navuser{color:#aebbd0;padding:0 7px}.wrap{max-width:1160px;margin:34px auto;padding:0 22px 52px}.heading{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:22px}.heading h1{margin:0;font-size:29px;line-height:1.2;letter-spacing:-.03em}.sub{color:var(--muted);margin:7px 0 0}.card{background:var(--paper);border:1px solid var(--line);border-radius:14px;box-shadow:0 5px 18px #1d35550a}.pad{padding:22px}.grid{display:grid;gap:16px}.stats{grid-template-columns:repeat(4,minmax(0,1fr));margin-bottom:20px}.stat{padding:20px}.stat .label{font-size:13px;color:var(--muted)}.stat .num{font-size:27px;font-weight:750;margin-top:4px}.cols{grid-template-columns:1.4fr 1fr}.btn{display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:9px 14px;border:1px solid transparent;border-radius:9px;background:var(--blue);color:#fff;font:inherit;font-size:14px;font-weight:650;cursor:pointer}.btn:hover{filter:brightness(.96);text-decoration:none}.btn.secondary{background:#fff;border-color:var(--line);color:var(--ink)}.btn.danger{background:#fff;color:var(--red);border-color:#f1c7c4}.btn.small{padding:6px 10px;font-size:13px}.tablewrap{overflow:auto}table{border-collapse:collapse;width:100%;min-width:620px}th,td{text-align:left;padding:13px 15px;border-bottom:1px solid var(--line);vertical-align:middle}th{font-size:12px;text-transform:uppercase;letter-spacing:.06em;color:#68788d;background:#f8fafc}tr:last-child td{border-bottom:0}.actions{display:flex;gap:7px;align-items:center}.inline{display:inline}.badge{display:inline-block;padding:3px 9px;border-radius:99px;background:#e9f7f0;color:var(--green);font-size:12px;font-weight:650}.badge.off{background:#f1f3f6;color:#667085}.thumb{width:46px;height:46px;object-fit:cover;border-radius:9px;background:#eef2f7;border:1px solid var(--line)}.avatar{width:42px;height:42px;border-radius:50%;object-fit:cover;background:#e8eef7;display:inline-flex;align-items:center;justify-content:center;color:#305083;font-weight:700}.formgrid{display:grid;grid-template-columns:1fr 1fr;gap:17px}.field{display:flex;flex-direction:column;gap:6px}.field.full{grid-column:1/-1}label{font-size:13px;font-weight:650;color:#34445a}input,select{width:100%;padding:11px 12px;border:1px solid #d6deea;border-radius:9px;background:#fff;color:var(--ink);font:inherit}input:focus,select:focus{outline:3px solid #2463eb22;border-color:var(--blue)}.hint{font-size:12px;color:var(--muted)}.flash{padding:12px 15px;border-radius:10px;margin:0 0 16px;background:#e9f7f0;color:#087f5b;border:1px solid #bce7d0}.flash.error{background:#fff0ef;color:#a93430;border-color:#f3c9c6}.errors{margin:6px 0 0;padding-left:18px;color:#b42318;font-size:13px}.loginpage{min-height:100vh;display:grid;place-items:center;padding:22px;background:radial-gradient(ellipse at 15% 5%,#dce8ff,transparent 45%),var(--bg)}.login{width:min(430px,100%);padding:30px}.login h1{margin:0 0 3px;font-size:27px}.login p{color:var(--muted);margin:0 0 20px}.login .field{margin-bottom:15px}.login .btn{width:100%;margin-top:4px}.empty{padding:34px;text-align:center;color:var(--muted)}.low{color:#b54708;font-weight:650}.footer{color:var(--muted);font-size:12px;text-align:center;margin-top:24px}.pagination{padding:14px}.pagination nav{display:flex;justify-content:space-between}.pagination span,.pagination a{padding:5px 9px}
        @media(max-width:800px){.nav{align-items:flex-start;flex-direction:column}.navlinks{gap:2px}.wrap{margin-top:24px}.stats{grid-template-columns:repeat(2,1fr)}.cols{grid-template-columns:1fr}}
        @media(max-width:520px){.heading{align-items:flex-start;flex-direction:column}.formgrid{grid-template-columns:1fr}.field.full{grid-column:auto}.wrap{padding:0 14px 35px}.stats{gap:10px}.stat{padding:15px}.nav{padding:12px 14px}}
    </style>
</head>
<body>
@auth
<header class="top"><nav class="nav">
    <a class="brand" href="{{ route('dashboard') }}">▦ &nbsp; FinalProject POS</a>
    <div class="navlinks">
        <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="{{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">Products</a>
        <a class="{{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">Customers</a>
        <a class="{{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Staff</a>
        <a class="{{ request()->routeIs('sales.create') ? 'active' : '' }}" href="{{ route('sales.create') }}">New sale</a>
        <a class="{{ request()->routeIs('sales.index') ? 'active' : '' }}" href="{{ route('sales.index') }}">Sales history</a>
        <span class="navuser">{{ auth()->user()->full_name }}</span>
        <form class="inline" method="post" action="{{ route('logout') }}">@csrf<button type="submit">Log out</button></form>
    </div>
</nav></header>
@endauth
<main class="wrap">
    @if(session('success'))<div class="flash">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="flash error">{{ session('error') }}</div>@endif
    @if($errors->any())<div class="flash error"><strong>Please check the form:</strong><ul class="errors">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @yield('content')
    @auth<footer class="footer">FinalProject POS · Inventory and sales management</footer>@endauth
</main>
</body>
</html>
