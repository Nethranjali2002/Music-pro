@extends('layouts.app')

@section('content')
<h1>Edit Playlist: {{ $playlist->name }}</h1>
<form action="{{ route('playlists.update', $playlist->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Playlist Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $playlist->name }}" required>
    </div>
    <div class="mb-3">
        <label for="is_public" class="form-label">Is Public?</label>
        <select class="form-control" name="is_public" id="is_public">
            <option value="1" {{ $playlist->is_public ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$playlist->is_public ? 'selected' : '' }}>No (Private)</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Playlist</button>
</form>
@endsection