@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <h1>Task List</h1>
    <p>All tasks, ordered by date.</p>

    @if ($tasks->isEmpty())
        <p class="empty">No tasks have been added.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ ucfirst($task->status) }}</td>
                        <td>{{ $task->task_date->format('F j, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection