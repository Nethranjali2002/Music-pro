<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title',
        'artist',
        'album',
        'year',
    ];

    /**
     * Relationship: Song belongs to many Playlists.
     */
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class)->withTimestamps();
    }
}