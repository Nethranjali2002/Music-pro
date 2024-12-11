<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    /**
     * Display a listing of all public playlists.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $playlists = Playlist::where('is_public', true)->with('user')->get();
        return view('playlists.index', compact('playlists'));
    }

    /**
     * Show the form for creating a new playlist.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('playlists.create');
    }

    /**
     * Store a newly created playlist in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'required|boolean',
        ]);

        // Create playlist
        $playlist = Playlist::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'is_public' => $request->is_public,
        ]);

        return redirect()->route('playlists.show', $playlist)->with('success', 'Playlist created successfully!');
    }

    /**
     * Display the specified playlist.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\View\View
     */
    public function show(Playlist $playlist)
    {
        // If playlist is private, ensure the current user is the owner
        if (!$playlist->is_public && $playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $playlist->load('songs', 'user');

        return view('playlists.show', compact('playlist'));
    }

    /**
     * Show the form for editing the specified playlist.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\View\View
     */
    public function edit(Playlist $playlist)
    {
        // Ensure the current user is the owner
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('playlists.edit', compact('playlist'));
    }

    /**
     * Update the specified playlist in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Playlist $playlist)
    {
        // Ensure the current user is the owner
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'required|boolean',
        ]);

        // Update playlist
        $playlist->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_public' => $request->is_public,
        ]);

        return redirect()->route('playlists.show', $playlist)->with('success', 'Playlist updated successfully!');
    }

    /**
     * Remove the specified playlist from storage.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Playlist $playlist)
    {
        // Ensure the current user is the owner
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist deleted successfully!');
    }

    /**
     * Add a song to the playlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addSong(Request $request, Playlist $playlist)
    {
        // Ensure the current user is the owner
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Validate input
        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        // Add song to playlist
        $playlist->songs()->attach($request->song_id);

        return back()->with('success', 'Song added to playlist.');
    }

    /**
     * Remove a song from the playlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlist  $playlist
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeSong(Request $request, Playlist $playlist, Song $song)
    {
        // Ensure the current user is the owner
        if ($playlist->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access.');
        }

        // Remove song from playlist
        $playlist->songs()->detach($song->id);

        return back()->with('success', 'Song removed from playlist.');
    }
}