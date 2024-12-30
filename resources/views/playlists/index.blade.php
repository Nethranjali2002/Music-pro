@extends('layouts.app')

@section('content')
<h1>All Playlists</h1>
@auth
<p><a class="btn btn-success" href="{{ route('playlists.create') }}">Create New Playlist</a></p>
@endauth

<ul>
    @foreach($playlists as $playlist)
    <li>
        <a href="{{ route('playlists.show', $playlist->id) }}">
            {{ $playlist->name }}
            @if(!$playlist->is_public)
            (Private)
            @endif
        </a>
    </li>
    @endforeach
</ul>
@endsection