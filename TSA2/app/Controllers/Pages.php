<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Pages extends BaseController
{
    public function home()
    {
        $taskModel = new TaskModel();

        return view('pages/home', [
            'title' => 'Welcome',
            'page'  => 'home',
            'tasks' => $taskModel->getActiveTasks(),
        ]);
    }

    public function profile()
    {
        return view('pages/profile', [
            'title' => 'Profile',
            'page'  => 'profile',
        ]);
    }

    public function about()
    {
        return view('pages/about', [
            'title' => 'About',
            'page'  => 'about',
        ]);
    }
}