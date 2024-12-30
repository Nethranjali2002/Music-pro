<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes (Laravel default)
Auth::routes();

// Songs (visible to all)
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');

// Admin routes: create songs
Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
});

// Playlists (any user can see public playlists)
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->name('playlists.show');

// Authenticated users only for creating and editing playlists
Route::group(['middleware' => ['auth']], function() {
    Route::get('/create-playlist', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');

    Route::get('/playlists/{id}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
    Route::put('/playlists/{id}', [PlaylistController::class, 'update'])->name('playlists.update');

    Route::post('/playlists/{id}/add-song', [PlaylistController::class, 'addSong'])->name('playlists.addSong');
    Route::delete('/playlists/{playlistId}/remove-song/{songId}', [PlaylistController::class, 'removeSong'])->name('playlists.removeSong');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
