<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to('/customers');
        }

        return view('auth/login', [
            'title' => 'Login',
            'page'  => 'login'
        ]);
    }

    public function authenticate()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required'
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();

        $user = $model
            ->where('username', trim($this->request->getPost('username')))
            ->first();

        if (
            ! $user
            || ! password_verify(
                $this->request->getPost('password'),
                $user['password']
            )
        ) {
            return redirect()->back()
                ->withInput()
                ->with('login_error', 'Invalid username or password.');
        }

        session()->regenerate(true);

        session()->set([
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'full_name'    => $user['full_name'],
            'is_logged_in' => true
        ]);

        return redirect()->to('/customers')
            ->with('success', 'Welcome, ' . $user['full_name'] . '!');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'You have been logged out.');
    }
}