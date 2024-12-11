<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;

class AdminController extends Controller
{
    /**
     * Display all public playlists for admin to manage.
     */
    public function managePlaylists()
    {
        $playlists = Playlist::where('is_public', true)->with('user')->get();
        return view('admin.playlists', compact('playlists'));
    }

    /**
     * Delete a public playlist.
     */
    public function deletePlaylist(Playlist $playlist)
    {
        if (!$playlist->is_public) {
            return back()->with('error', 'Cannot delete private playlists.');
        }

        $playlist->delete();

        return back()->with('success', 'Playlist deleted successfully.');
    }
}