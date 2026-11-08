<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function welcome()
    {
        $today = Carbon::today('Asia/Manila')->toDateString();

        $tasks = Task::whereDate('task_date', $today)
            ->orderBy('id')
            ->get();

        return view('welcome', compact('tasks'));
    }

    public function index()
    {
        $tasks = Task::orderBy('task_date')
            ->orderBy('id')
            ->get();

        return view('tasks.index', compact('tasks'));
    }
}