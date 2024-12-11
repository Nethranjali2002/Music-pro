@extends('layouts.app')

@section('content')
<h2>Public Playlists</h2>

@if($playlists->isEmpty())
<p>No public playlists available.</p>
@else
<div class="row">
    @foreach($playlists as $playlist)
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $playlist->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">By: {{ $playlist->user->name }}</h6>
                <p class="card-text">{{ Str::limit($playlist->description, 100) }}</p>
                <a href="{{ route('playlists.show', $playlist) }}" class="card-link">View Playlist</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection