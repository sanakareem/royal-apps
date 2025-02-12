<!-- resources/views/books/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <h2>Edit Book</h2>

    <form method="POST" action="{{ route('books.update', $book['id']) }}">
        @csrf
        @method('PUT')
        <div style="margin-bottom: 15px;">
            <label>Title</label>
            <input type="text" name="title" value="{{ $book['title'] }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Release Date</label>
            <input type="date" name="release_date" value="{{ $book['release_date'] }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Description</label>
            <textarea name="description" required style="width: 100%; padding: 8px;">{{ $book['description'] }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>ISBN</label>
            <input type="text" name="isbn" value="{{ $book['isbn'] }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Format</label>
            <select name="format" required style="width: 100%; padding: 8px;">
                <option value="hardcover" {{ $book['format'] == 'hardcover' ? 'selected' : '' }}>Hardcover</option>
                <option value="paperback" {{ $book['format'] == 'paperback' ? 'selected' : '' }}>Paperback</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Author</label>
            <select name="author_id" required style="width: 100%; padding: 8px;">
                @foreach($authors['items'] as $author)
                    <option value="{{ $author['id'] }}" {{ $book['author']['id'] == $author['id'] ? 'selected' : '' }}>
                        {{ $author['first_name'] }} {{ $author['last_name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Update Book</button>
    </form>
</div>
@endsection