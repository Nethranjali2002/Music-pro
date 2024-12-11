@extends('layouts.app')

@section('content')
<h2>Edit Playlist: {{ $playlist->name }}</h2>

<form action="{{ route('playlists.update', $playlist) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', $playlist->name) }}" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
            rows="3">{{ old('description', $playlist->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="is_public" class="form-label">Visibility:</label>
        <select class="form-select @error('is_public') is-invalid @enderror" id="is_public" name="is_public" required>
            <option value="1" {{ old('is_public', $playlist->is_public) == '1' ? 'selected' : '' }}>Public</option>
            <option value="0" {{ old('is_public', $playlist->is_public) == '0' ? 'selected' : '' }}>Private</option>
        </select>
        @error('is_public')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Update Playlist</button>
</form>

<hr>

<h3>Songs in this Playlist</h3>

@if($playlist->songs->isEmpty())
<p>No songs in this playlist.</p>
@else
<ul class="list-group">
    @foreach($playlist->songs as $song)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div>
            <strong>{{ $song->title }}</strong> by {{ $song->artist }}
            @if($song->album)
            <em>({{ $song->album }})</em>
            @endif
            @if($song->year)
            <em>{{ $song->year }}</em>
            @endif
        </div>
        <form action="{{ route('playlists.removeSong', [$playlist, $song]) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to remove this song from the playlist?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
        </form>
    </li>
    @endforeach
</ul>
@endif
@endsection