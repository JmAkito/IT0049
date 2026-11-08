@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Tasks for Today</h1>
    <p>Here are your tasks scheduled for today.</p>

    @if ($tasks->isEmpty())
        <p class="empty">There are no tasks scheduled for today.</p>
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