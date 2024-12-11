<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    /**
     * Display a listing of the songs.
     */
    public function index()
    {
        $songs = Song::all();
        return view('songs.index', compact('songs'));
    }

    /**
     * Show the form for creating a new song.
     */
    public function create()
    {
        return view('songs.create');
    }

    /**
     * Store a newly created song in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'album' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:'.(date('Y') + 1),
        ]);

        // Create song
        Song::create($request->all());

        return redirect()->route('songs.index')->with('success', 'Song added successfully!');
    }
}