@extends('layouts.app')

@section('content')
<h1>All Songs</h1>
<ul>
    @foreach($songs as $song)
    <li>{{ $song->title }} by {{ $song->artist }}</li>
    @endforeach
</ul>
@endsection