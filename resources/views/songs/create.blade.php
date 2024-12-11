@extends('layouts.app')

@section('content')
<h2>Add New Song</h2>

<form action="{{ route('songs.store') }}" method="POST">
    @csrf

    <div>
        <label>Title:</label>
        <input type="text" name="title" value="{{ old('title') }}" required>
        @error('title')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Artist:</label>
        <input type="text" name="artist" value="{{ old('artist') }}" required>
        @error('artist')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Album:</label>
        <input type="text" name="album" value="{{ old('album') }}">
        @error('album')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label>Year:</label>
        <input type="number" name="year" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}">
        @error('year')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Add Song</button>
</form>
@endsection