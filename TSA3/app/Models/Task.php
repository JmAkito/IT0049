<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'status',
        'task_date',
    ];

    protected $casts = [
        'task_date' => 'date',
    ];
}