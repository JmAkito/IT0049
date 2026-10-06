<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'title',
        'description',
        'task_date',
        'is_archived',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getActiveTasks(): array
    {
        return $this->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->findAll();
    }
}