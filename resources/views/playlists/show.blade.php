@extends('layouts.app')

@section('content')
<h1>{{ $playlist->name }}</h1>
<p>Owner: {{ $playlist->user->name }}</p>
<p>Status: {{ $playlist->is_public ? 'Public' : 'Private' }}</p>

@if(Auth::check() && Auth::id() === $playlist->user_id)
<a class="btn btn-warning" href="{{ route('playlists.edit', $playlist->id) }}">Edit Playlist</a>

<hr>
<h3>Add Song</h3>
<form action="{{ route('playlists.addSong', $playlist->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="song_id" class="form-label">Select Song</label>
        <select class="form-control" name="song_id" id="song_id">
            @foreach(\App\Models\Song::all() as $song)
            <option value="{{ $song->id }}">{{ $song->title }} - {{ $song->artist }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Add Song</button>
</form>
@endif

<hr>
<h3>Songs in this playlist</h3>
<ul>
    @foreach($songs as $song)
    <li>
        {{ $song->title }} - {{ $song->artist }}
        @if(Auth::check() && Auth::id() === $playlist->user_id)
        <!-- Remove button -->
        <form action="{{ route('playlists.removeSong', [$playlist->id, $song->id]) }}" method="POST"
            style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>
@endsection