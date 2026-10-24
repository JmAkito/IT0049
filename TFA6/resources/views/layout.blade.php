<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | POS Foundations</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f6f8;
            color: #222;
        }

        header {
            background: #17324d;
            color: white;
            padding: 22px 8%;
        }

        header h1 {
            margin: 0 0 12px;
        }

        nav a {
            color: white;
            margin-right: 18px;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            background: white;
            max-width: 1000px;
            margin: 30px auto;
            padding: 28px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #d5dce3;
            text-align: left;
        }

        th {
            background: #e8eef4;
        }
    </style>
</head>
<body>
    <header>
        <h1>POS Foundations</h1>

        <nav>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('customers') }}">Customer Accounts</a>
            <a href="{{ route('users') }}">User Accounts</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>