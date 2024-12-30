@extends('layouts.app')

@section('content')
<h1>Create a New Song</h1>
<form action="{{ route('songs.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Song Title</label>
        <input type="text" class="form-control" name="title" id="title" required>
    </div>

    <div class="mb-3">
        <label for="artist" class="form-label">Artist</label>
        <input type="text" class="form-control" name="artist" id="artist" required>
    </div>

    <button type="submit" class="btn btn-primary">Create Song</button>
</form>
@endsection