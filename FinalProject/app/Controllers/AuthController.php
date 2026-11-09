<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/login');
    }

    public function login()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login', [
            'validation' => service('validation'),
        ]);
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return view('auth/login', [
                'validation' => $this->validator,
            ]);
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $user = (new UserModel())
            ->where('username', $username)
            ->first();

        if ($user === null || ! password_verify($password, $user['password'])) {
            return redirect()->to('/login')
                ->withInput()
                ->with('error', 'The username or password is incorrect.');
        }

        session()->regenerate(true);

        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
            'avatar' => $user['avatar'],
            'isLoggedIn' => true,
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'You have been signed out.');
    }
}