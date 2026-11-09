<?php helper('form'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Sign In | FinalProject POS</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            background: #f1f5f9;
            color: #172033;
            font-family: Arial, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 12px 35px rgba(15, 23, 42, 0.12);
        }

        h1 {
            margin: 0 0 8px;
        }

        .muted {
            margin: 0 0 24px;
            color: #64748b;
        }

        label {
            display: block;
            margin: 16px 0 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 16px;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 12px;
            border: 0;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .message {
            margin: 12px 0;
            padding: 12px;
            border-radius: 8px;
            background: #fee2e2;
            color: #991b1b;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .errors {
            margin: 12px 0;
            color: #991b1b;
        }

        .hint {
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
            background: #eff6ff;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <main class="card">
        <h1>Staff Sign In</h1>
        <p class="muted">Sign in to open the POS dashboard.</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="message">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="message success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($validation) && $validation->getErrors()): ?>
            <div class="errors">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="/login" method="post">
            <?= csrf_field() ?>

            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                value="<?= esc(old('username')) ?>"
                required
                autofocus
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >

            <button type="submit">Sign In</button>
        </form>

        <div class="hint">
            Sample login: <strong>admin</strong><br>
            Password: <strong>Admin123!</strong>
        </div>
    </main>
</body>
</html>