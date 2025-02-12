<!-- resources/views/authors/index.blade.php -->
@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Authors</h2>
    <a href="{{ route('authors.create') }}" class="btn btn-primary">Add New Author</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($authors['items'] as $author)
            <tr>
                <td>{{ $author['first_name'] }}</td>
                <td>{{ $author['last_name'] }}</td>
                <td>{{ \Carbon\Carbon::parse($author['birthday'])->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('authors.show', $author['id']) }}" class="btn btn-primary">View</a>
                    @if(empty($author['books']))
                    <form method="POST" action="{{ route('authors.destroy', $author['id']) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this author?')">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection