@extends('layouts.app')

@section('content')
<h2>Manage Public Playlists</h2>

@if($playlists->isEmpty())
<p>No public playlists to manage.</p>
@else
<ul class="playlist-list">
    @foreach($playlists as $playlist)
    <li>
        <h3>{{ $playlist->name }}</h3>
        <p>By: {{ $playlist->user->name }}</p>
        <p>{{ $playlist->description }}</p>
        <form action="{{ route('admin.playlists.delete', $playlist) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this playlist?')">Delete</button>
        </form>
    </li>
    @endforeach
</ul>
@endif
@endsection