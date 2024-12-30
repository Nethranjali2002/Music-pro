<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    // Show list of songs
    public function index()
    {
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    // Show create form (ADMIN ONLY)
    public function create()
    {
        return view('songs.create');
    }

    // Store new song
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'artist' => 'required',
        ]);

        Song::create([
            'title' => $request->title,
            'artist' => $request->artist,
        ]);

        return redirect()->route('songs.index')->with('success', 'Song created successfully!');
    }
}