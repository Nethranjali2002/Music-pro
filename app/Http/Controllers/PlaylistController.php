<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    // Show a list of all public playlists + user's own private playlists
    public function index()
    {
        $playlistsQuery = Playlist::query();

        // If logged in, show public playlists + your private ones
        if (Auth::check()) {
            $playlistsQuery->where(function($q) {
                $q->where('is_public', true)
                  ->orWhere('user_id', Auth::id());
            });
        } else {
            // If guest, show only public
            $playlistsQuery->where('is_public', true);
        }

        $playlists = $playlistsQuery->get();
        return view('playlists.index', compact('playlists'));
    }

    // Show create form (AUTH ONLY)
    public function create()
    {
        return view('playlists.create');
    }

    // Store new playlist
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'is_public' => 'required|boolean',
        ]);

        Playlist::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'is_public' => $request->is_public,
        ]);

        return redirect()->route('playlists.index')->with('success', 'Playlist created!');
    }

    // Show a single playlist (public or owned by the user)
    public function show($id)
    {
        $playlist = Playlist::findOrFail($id);

        // If playlist is not public, ensure the user is the owner
        if (!$playlist->is_public && $playlist->user_id != Auth::id()) {
            return redirect()->route('playlists.index')->with('error', 'Access denied.');
        }

        $songs = $playlist->songs; // songs in this playlist
        return view('playlists.show', compact('playlist', 'songs'));
    }

    // Show the form to edit a playlist
    public function edit($id)
    {
        $playlist = Playlist::findOrFail($id);

        // Only owner can edit
        if ($playlist->user_id != Auth::id()) {
            return redirect()->route('playlists.index')->with('error', 'Access denied.');
        }

        return view('playlists.edit', compact('playlist'));
    }

    // Update the playlist
    public function update(Request $request, $id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->user_id != Auth::id()) {
            return redirect()->route('playlists.index')->with('error', 'Access denied.');
        }

        $request->validate([
            'name' => 'required',
            'is_public' => 'required|boolean',
        ]);

        $playlist->update([
            'name' => $request->name,
            'is_public' => $request->is_public,
        ]);

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'Playlist updated!');
    }

    // Add song to playlist
    public function addSong(Request $request, $id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->user_id != Auth::id()) {
            return redirect()->route('playlists.index')->with('error', 'Access denied.');
        }

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);

        $playlist->songs()->attach($request->song_id);

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'Song added to playlist!');
    }

    // Remove song from playlist
    public function removeSong($playlistId, $songId)
    {
        $playlist = Playlist::findOrFail($playlistId);

        if ($playlist->user_id != Auth::id()) {
            return redirect()->route('playlists.index')->with('error', 'Access denied.');
        }

        $playlist->songs()->detach($songId);

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'Song removed from playlist!');
    }
}