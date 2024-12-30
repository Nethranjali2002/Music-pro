<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class HomeController extends Controller
{
    public function index()
    {
        // Show some public playlists or something on home page
        $publicPlaylists = Playlist::where('is_public', true)->get();
        $songs = Song::all();
        return view('home', compact('publicPlaylists', 'songs'));
    }
}