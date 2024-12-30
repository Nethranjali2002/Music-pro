<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * These fields can be bulk-filled using create() or update().
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // 'admin' or 'user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relationship: A user can have many playlists.
     */
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    /**
     * Check if the user has the 'admin' role.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}