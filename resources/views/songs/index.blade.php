@extends('layouts.app')

@section('content')
<h2>Songs</h2>

<a href="{{ route('songs.create') }}">Add New Song</a>

@if($songs->isEmpty())
<p>No songs available.</p>
@else
<ul class="song-list">
    @foreach($songs as $song)
    <li>
        <strong>{{ $song->title }}</strong> by {{ $song->artist }}
        @if($song->album)
        ({{ $song->album }})
        @endif
        @if($song->year)
        - {{ $song->year }}
        @endif
    </li>
    @endforeach
</ul>
@endif
@endsection