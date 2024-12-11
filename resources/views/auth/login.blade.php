@extends('layouts.app')

@section('content')
<h2>Login</h2>

<form action="{{ route('login.post') }}" method="POST">
    @csrf

    <div>
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Password:</label>
        <input type="password" name="password" required>
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
    </div>

    <button type="submit">Login</button>
</form>
@endsection