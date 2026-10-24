@extends('layout')

@section('title', 'User Accounts')

@section('content')
    <h2>User Accounts</h2>
    <p>User records retrieved from the database:</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->full_name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No user records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection