@extends('layouts.app')

@section('content')
<h2>Create New Playlist</h2>

<form action="{{ route('playlists.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name') }}" required>
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description:</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
            rows="3">{{ old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="is_public" class="form-label">Visibility:</label>
        <select class="form-select @error('is_public') is-invalid @enderror" id="is_public" name="is_public" required>
            <option value="1" {{ old('is_public') == '1' ? 'selected' : '' }}>Public</option>
            <option value="0" {{ old('is_public') == '0' ? 'selected' : '' }}>Private</option>
        </select>
        @error('is_public')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Create Playlist</button>
</form>
@endsection