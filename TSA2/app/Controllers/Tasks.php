<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Tasks extends BaseController
{
    private TaskModel $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    public function index()
    {
        return view('tasks/index', [
            'title' => 'Task List',
            'page'  => 'tasks',
            'tasks' => $this->taskModel->getActiveTasks(),
        ]);
    }

    public function new()
    {
        return view('tasks/new', [
            'title' => 'New Task',
            'page'  => 'tasks',
        ]);
    }

    public function create()
    {
        $rules = [
            'title' => [
                'label' => 'Task title',
                'rules' => 'required|max_length[150]',
            ],
            'task_date' => [
                'label' => 'Task date',
                'rules' => 'required|valid_date[Y-m-d]',
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->insert([
            'title'       => trim($this->request->getPost('title')),
            'description' => trim($this->request->getPost('description')),
            'task_date'   => $this->request->getPost('task_date'),
            'is_archived' => 0,
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task created successfully.');
    }

    public function edit(int $id)
    {
        $task = $this->taskModel->find($id);

        if (! $task || (int) $task['is_archived'] === 1) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        return view('tasks/edit', [
            'title' => 'Edit Task',
            'page'  => 'tasks',
            'task'  => $task,
        ]);
    }

    public function update(int $id)
    {
        $task = $this->taskModel->find($id);

        if (! $task || (int) $task['is_archived'] === 1) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        $rules = [
            'title' => [
                'label' => 'Task title',
                'rules' => 'required|max_length[150]',
            ],
            'task_date' => [
                'label' => 'Task date',
                'rules' => 'required|valid_date[Y-m-d]',
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->taskModel->update($id, [
            'title'       => trim($this->request->getPost('title')),
            'description' => trim($this->request->getPost('description')),
            'task_date'   => $this->request->getPost('task_date'),
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task updated successfully.');
    }

    public function archive(int $id)
    {
        $task = $this->taskModel->find($id);

        if (! $task || (int) $task['is_archived'] === 1) {
            throw PageNotFoundException::forPageNotFound('Task not found.');
        }

        $this->taskModel->update($id, [
            'is_archived' => 1,
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task archived successfully.');
    }
}