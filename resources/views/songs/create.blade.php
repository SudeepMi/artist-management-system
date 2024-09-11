@extends('layout.app')

@section('main')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Create New Song</h2>

    <form action="{{ route('songs.store', $id) }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="artist_id" value="{{$id}}" />
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Song Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('title') border-red-500 @enderror" required>
            @error('title')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Album Name -->
        <div>
            <label for="album_name" class="block text-sm font-medium text-gray-700">Album Name</label>
            <input type="text" id="album_name" name="album_name" value="{{ old('album_name') }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('album_name') border-red-500 @enderror" required>
            @error('album_name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Genre -->
        <div>
            <label for="genre" class="block text-sm font-medium text-gray-700">Genre</label>
            <select id="genre" name="genre" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('genre') border-red-500 @enderror" required>
                <option value="" disabled selected>Select a Genre</option>
                <option value="rnb" {{ old('genre') == 'rnb' ? 'selected' : '' }}>R&B</option>
                <option value="country" {{ old('genre') == 'country' ? 'selected' : '' }}>Country</option>
                <option value="classic" {{ old('genre') == 'classic' ? 'selected' : '' }}>Classic</option>
                <option value="rock" {{ old('genre') == 'rock' ? 'selected' : '' }}>Rock</option>
                <option value="jazz" {{ old('genre') == 'jazz' ? 'selected' : '' }}>Jazz</option>
            </select>
            @error('genre')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Create Song
            </button>
        </div>
    </form>
</div>
@endsection