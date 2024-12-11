@extends('layouts.app')

@section('content')
<h2>Register</h2>

<form action="{{ route('register.post') }}" method="POST">
    @csrf

    <div>
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
        @error('name')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

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
        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Register</button>
</form>
@endsection