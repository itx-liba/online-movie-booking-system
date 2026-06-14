@extends('layouts.app')

@section('title', 'Manage Shows')

@section('content')
<div class="card">
    <h2>Manage Shows</h2>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="/admin/shows/create" class="btn">Add Show</a>

    <br><br>

    @if ($shows->count() > 0)
        <table width="100%" cellpadding="10">
            <tr>
                <th>Movie</th>
                <th>Theater</th>
                <th>Date</th>
                <th>Time</th>
                <th>Gold</th>
                <th>Platinum</th>
                <th>Box</th>
                <th>Action</th>
            </tr>

            @foreach ($shows as $show)
                <tr>
                    <td>{{ $show->movie->title }}</td>
                    <td>{{ $show->theater->name }}</td>
                    <td>{{ $show->show_date }}</td>
                    <td>{{ $show->show_time }}</td>
                    <td>{{ $show->gold_rate }}</td>
                    <td>{{ $show->platinum_rate }}</td>
                    <td>{{ $show->box_rate }}</td>
                    <td>
                        <a href="/admin/shows/{{ $show->id }}/edit" class="btn btn-secondary">Edit</a>

                        <form method="POST" action="/admin/shows/{{ $show->id }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this show?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No shows added yet.</p>
    @endif
</div>
@endsection