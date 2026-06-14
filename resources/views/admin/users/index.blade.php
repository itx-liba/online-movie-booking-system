@extends('layouts.app')

@section('title', 'Registered Users')

@section('content')
<div class="card">
    <h2>Registered Users</h2>

    @if ($users->count() > 0)
        <table width="100%" cellpadding="10">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Registered Date</th>
            </tr>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->age ?? 'N/A' }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No registered users found.</p>
    @endif
</div>
@endsection