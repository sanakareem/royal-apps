<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
<div style="max-width: 400px; margin: 50px auto;">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Email</label>
            <input type="email" name="email" value="ahsoka.tano@royal-apps.io" style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 15px;">
            <label>Password</label>
            <input type="password" name="password" value="Kryze4President" style="width: 100%; padding: 8px;">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>
@endsection