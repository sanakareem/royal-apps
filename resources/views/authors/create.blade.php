@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Add New Author</h2>
        <a href="{{ route('authors.index') }}" class="btn" style="background-color: #6c757d; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px;">Back to Authors</a>
    </div>

    @if($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('authors.store') }}" style="max-width: 600px;">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>First Name</label>
            <input type="text" name="first_name" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Last Name</label>
            <input type="text" name="last_name" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Birthday</label>
            <input type="date" name="birthday" required style="width: 100%; padding: 8px;">
        </div>

        <button type="submit" class="btn" style="background-color: #007bff; color: white; padding: 8px 16px; border: none; cursor: pointer; border-radius: 4px;">Create Author</button>
    </form>
</div>
@endsection