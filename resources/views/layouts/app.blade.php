<!DOCTYPE html>
<html>

<head>
    <title>Music Playlist Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- If you don't have Bootstrap, you can link to a CDN or your own CSS file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <style>
    /* Basic custom styles */
    body {
        background: #f0f0f0;
    }

    .navbar {
        margin-bottom: 20px;
    }

    .container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Music App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('songs.index') }}">Songs</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('playlists.index') }}">Playlists</a></li>
                    @if(Auth::user()->isAdmin())
                    <li class="nav-item"><a class="nav-link" href="{{ route('songs.create') }}">Add Song</a></li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Display messages -->
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>