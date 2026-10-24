@extends('layout')

@section('title', 'Customer Accounts')

@section('content')
    <h2>Customer Accounts</h2>
    <p>Customer records retrieved from the database:</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->full_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No customer records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection