@extends('layouts.app')

@section('content')
<h1>Create New Playlist</h1>
<form action="{{ route('playlists.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Playlist Name</label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>
    <div class="mb-3">
        <label for="is_public" class="form-label">Is Public?</label>
        <select class="form-control" name="is_public" id="is_public">
            <option value="1">Yes</option>
            <option value="0">No (Private)</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create Playlist</button>
</form>
@endsection