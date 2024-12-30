<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    /**
     * The attributes that can be mass assigned.
     */
    protected $fillable = [
        'title',
        'artist',
        // Add more if needed (album, genre, etc.)
    ];

    /**
     * Many-to-many relationship with Playlist.
     */
    public function playlists()
    {
        // playlist_song is the pivot table
        return $this->belongsToMany(Playlist::class, 'playlist_song');
    }
}