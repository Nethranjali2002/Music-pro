@extends('layouts.app')

@section('content')
<h2>{{ $playlist->name }}</h2>
<p><strong>Created By:</strong> {{ $playlist->user->name }}</p>
<p><strong>Description:</strong> {{ $playlist->description ?? 'No description provided.' }}</p>
<p><strong>Visibility:</strong> {{ $playlist->is_public ? 'Public' : 'Private' }}</p>

@auth
@if(Auth::id() === $playlist->user_id)
<a href="{{ route('playlists.edit', $playlist) }}" class="btn btn-secondary">Edit Playlist</a>

<form action="{{ route('playlists.destroy', $playlist) }}" method="POST" class="d-inline"
    onsubmit="return confirm('Are you sure you want to delete this playlist?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete Playlist</button>
</form>
@endif
@endauth

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
        @auth
        @if(Auth::id() === $playlist->user_id)
        <form action="{{ route('playlists.removeSong', [$playlist, $song]) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to remove this song from the playlist?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
        </form>
        @endif
        @endauth
    </li>
    @endforeach
</ul>
@endif

@auth
@if(Auth::id() === $playlist->user_id)
<hr>
<h4>Add a Song to this Playlist</h4>
<form action="{{ route('playlists.addSong', $playlist) }}" method="POST">
    @csrf
    <div class="input-group mb-3">
        <select class="form-select @error('song_id') is-invalid @enderror" name="song_id" required>
            <option selected disabled value="">Choose a song...</option>
            @foreach(App\Models\Song::all() as $song)
            <option value="{{ $song->id }}">{{ $song->title }} by {{ $song->artist }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit">Add Song</button>
    </div>
    @error('song_id')
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</form>
@endif
@endauth
@endsection