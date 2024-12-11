<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AdminController;

// Home route
Route::get('/', function () {
    return redirect()->route('playlists.index');
});

// Authentication Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Playlist Routes (public)
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');

// Protected Routes
Route::group(['middleware' => 'auth'], function () {
    // Playlist CRUD
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
    Route::put('/playlists/{playlist}', [PlaylistController::class, 'update'])->name('playlists.update');
    Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');

    // Add or remove songs from playlist
    Route::post('/playlists/{playlist}/add-song', [PlaylistController::class, 'addSong'])->name('playlists.addSong');
    Route::delete('/playlists/{playlist}/remove-song/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.removeSong');

    // Song Routes
    Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
});

// Admin Routes
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/playlists', [AdminController::class, 'managePlaylists'])->name('admin.playlists');
    Route::delete('/admin/playlists/{playlist}', [AdminController::class, 'deletePlaylist'])->name('admin.playlists.delete');
});