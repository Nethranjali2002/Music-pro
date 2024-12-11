<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Music Playlist Manager</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Add any other meta tags or links here -->
</head>

<body>
    <nav>
        <div class="container">
            <a href="{{ route('playlists.index') }}">Home</a>
            @auth
            <a href="{{ route('playlists.create') }}">Create Playlist</a>
            <a href="{{ route('songs.index') }}">Songs</a>
            @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.playlists') }}">Admin</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout ({{ Auth::user()->name }})</button>
            </form>
            @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
        <div class="alert success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
        @endif
        @yield('content')
    </div>
</body>

</html>