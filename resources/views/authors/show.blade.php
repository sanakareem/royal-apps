<!-- resources/views/authors/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <h2>Author Details</h2>
        <a href="{{ route('authors.index') }}" class="btn" style="background: #007bff; color: white; padding: 8px 16px; text-decoration: none;">Back to Authors</a>
    </div>

    <div class="author-info" style="margin-bottom: 30px;">
        <h3>{{ $author['first_name'] }} {{ $author['last_name'] }}</h3>
        <p>Birthday: {{ \Carbon\Carbon::parse($author['birthday'])->format('Y-m-d') }}</p>
    </div>

    <div class="books-section">
        <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
            <h3>Books</h3>
            <a href="{{ route('books.create', ['author_id' => $author['id']]) }}" class="btn" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Add New Book</a>
        </div>

        @if(!empty($author['books']))
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="padding: 12px; border: 1px solid #ddd;">Title</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Release Date</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Description</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">ISBN</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Format</th>
                        <th style="padding: 12px; border: 1px solid #ddd;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($author['books'] as $book)
                        <tr>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $book['title'] }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($book['release_date'])->format('Y-m-d') }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $book['description'] }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $book['isbn'] }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">{{ $book['format'] }}</td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                            <form method="POST" action="{{ route('books.destroy', $book['id']) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No books found for this author.</p>
        @endif
    </div>
</div>
@endsection