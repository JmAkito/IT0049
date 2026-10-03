<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();

        return view('users/index', [
            'title' => 'User Accounts',
            'page'  => 'users',
            'users' => $model->findAll()
        ]);
    }

    public function new()
    {
        return view('users/new', [
            'title' => 'Add User',
            'page'  => 'users'
        ]);
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();

        $model->insert([
            'username'   => trim($this->request->getPost('username')),
            'full_name'  => trim($this->request->getPost('full_name')),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users')
            ->with('success', 'User added successfully.');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        return view('users/edit', [
            'title' => 'Edit User',
            'page'  => 'users',
            'user'  => $user
        ]);
    }

    public function update($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|max_length[50]|is_unique[users.username,id,' . $id . ']'
            ],
            'full_name' => [
                'label' => 'Full Name',
                'rules' => 'required|max_length[100]'
            ],
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'permit_empty|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]'
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $avatarName = $user['avatar'];
        $avatarFile = $this->request->getFile('avatar');

        if (
            $avatarFile !== null
            && $avatarFile->isValid()
            && ! $avatarFile->hasMoved()
        ) {
            $avatarName = $avatarFile->getRandomName();

            service('image')
                ->withFile($avatarFile->getTempName())
                ->fit(300, 300, 'center')
                ->save(FCPATH . 'uploads/avatars/' . $avatarName);
        }

        $model->update($id, [
            'username'  => trim($this->request->getPost('username')),
            'full_name' => trim($this->request->getPost('full_name')),
            'avatar'    => $avatarName
        ]);

        return redirect()->to('/users')
            ->with('success', 'User updated successfully.');
    }
}