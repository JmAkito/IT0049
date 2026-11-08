<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class Tsa3Seeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today('Asia/Manila');

        Task::query()->delete();
        User::query()->delete();

        Task::create([
            'title' => 'Review Laravel lessons',
            'status' => 'pending',
            'task_date' => $today->toDateString(),
        ]);

        Task::create([
            'title' => 'Finish school assignment',
            'status' => 'in progress',
            'task_date' => $today->toDateString(),
        ]);

        Task::create([
            'title' => 'Organize study notes',
            'status' => 'pending',
            'task_date' => $today->toDateString(),
        ]);

        Task::create([
            'title' => 'Read the assigned chapter',
            'status' => 'completed',
            'task_date' => $today->copy()->subDay()->toDateString(),
        ]);

        Task::create([
            'title' => 'Prepare class materials',
            'status' => 'completed',
            'task_date' => $today->copy()->subDay()->toDateString(),
        ]);

        Task::create([
            'title' => 'Submit previous activity',
            'status' => 'pending',
            'task_date' => $today->copy()->subDay()->toDateString(),
        ]);

        Task::create([
            'title' => 'Practice Laravel migrations',
            'status' => 'pending',
            'task_date' => $today->copy()->addDay()->toDateString(),
        ]);

        Task::create([
            'title' => 'Plan the week’s tasks',
            'status' => 'pending',
            'task_date' => $today->copy()->addDay()->toDateString(),
        ]);

        User::create([
            'username' => 'JmAkito',
            'full_name' => 'Jolo Miguel Ambrad',
            'email' => 'jmcascabel619@gmail.com',
        ]);
    }
}