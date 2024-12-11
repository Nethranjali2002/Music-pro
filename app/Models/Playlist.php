<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_public',
    ];

    /**
     * Relationship: Playlist belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: Playlist has many Songs.
     */
    public function songs()
    {
        return $this->belongsToMany(Song::class)->withTimestamps();
    }
}