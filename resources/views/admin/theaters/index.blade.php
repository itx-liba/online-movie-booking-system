@extends('layouts.app')

@section('title', 'Manage Theaters')

@section('content')
<div class="card">
    <h2>Manage Theaters</h2>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="/admin/theaters/create" class="btn">Add Theater</a>

    <br><br>

    @if ($theaters->count() > 0)
        <table width="100%" cellpadding="10">
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Location</th>
                <th>Action</th>
            </tr>

            @foreach ($theaters as $theater)
                <tr>
                    <td>{{ $theater->name }}</td>
                    <td>{{ $theater->city }}</td>
                    <td>{{ $theater->location }}</td>
                    <td>
                        <a href="/admin/theaters/{{ $theater->id }}/edit" class="btn btn-secondary">Edit</a>

                        <form method="POST" action="/admin/theaters/{{ $theater->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this theater?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No theaters added yet.</p>
    @endif
</div>
@endsection