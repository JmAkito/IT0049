<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Tasks for Today</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            color: #222;
        }

        header {
            background: #1f2937;
            padding: 18px 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        main {
            max-width: 900px;
            margin: 35px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #e5e7eb;
        }

        .empty {
            color: #666;
            padding: 15px 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('welcome') }}">Welcome</a>
            <a href="{{ route('tasks.index') }}">Task List</a>
            <a href="{{ route('profile') }}">Profile</a>
            <a href="{{ route('about') }}">About</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>