@extends('layouts.app')

@section('content')
<h1>Welcome to the Music Playlist Manager</h1>
<p>This is a simple landing page.</p>

<h2>Public Playlists</h2>
<ul>
    @foreach($publicPlaylists as $playlist)
    <li>
        <a href="{{ route('playlists.show', $playlist->id) }}">
            {{ $playlist->name }}
        </a>
    </li>
    @endforeach
</ul>

<h2>All Songs</h2>
<ul>
    @foreach($songs as $song)
    <li>{{ $song->title }} by {{ $song->artist }}</li>
    @endforeach
</ul>
@endsection