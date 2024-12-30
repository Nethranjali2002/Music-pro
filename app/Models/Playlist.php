<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'is_public',
    ];

    // A playlist belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A playlist can have many songs
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_song');
    }
}