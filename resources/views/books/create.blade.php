<!-- resources/views/books/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Book</h2>

    @if($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('books.store') }}" style="max-width: 600px;">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Title</label>
            <input type="text" name="title" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Release Date</label>
            <input type="date" name="release_date" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Description</label>
            <textarea name="description" required style="width: 100%; padding: 8px;"></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>ISBN</label>
            <input type="text" name="isbn" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Format</label>
            <select name="format" required style="width: 100%; padding: 8px;">
                <option value="hardcover">Hardcover</option>
                <option value="paperback">Paperback</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Number of Pages</label>
            <input type="number" name="number_of_pages" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Author</label>
            <select name="author_id" required style="width: 100%; padding: 8px;">
                @foreach($authors['items'] as $author)
                    <option value="{{ $author['id'] }}" {{ $selected_author_id == $author['id'] ? 'selected' : '' }}>
                        {{ $author['first_name'] }} {{ $author['last_name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn" style="background: #007bff; color: white; padding: 8px 16px; border: none; cursor: pointer;">Create Book</button>
        <a href="{{ url()->previous() }}" class="btn" style="background: #6c757d; color: white; padding: 8px 16px; text-decoration: none; margin-left: 10px;">Cancel</a>
    </form>
</div>
@endsection