@extends('layout.app')

@section('main')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold mb-6">Stats Overview</h2>

    <!-- Overall Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-blue-100 p-4 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold text-blue-800">Total Users</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $totalUsers }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold text-green-800">Artist Managers</h3>
            <p class="text-2xl font-bold text-green-600">{{ $totalArtistManagers }}</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold text-yellow-800">Total Artists</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $totalArtists }}</p>
        </div>
        <div class="bg-red-100 p-4 rounded-lg shadow-md text-center">
            <h3 class="text-xl font-semibold text-red-800">Total Songs</h3>
            <p class="text-2xl font-bold text-red-600">{{ $totalSongs }}</p>
        </div>
    </div>

    <!-- Top 5 Artists by Song Count -->
    <div class="bg-gray-100 p-4 rounded-lg shadow-md mb-8">
        <h3 class="text-2xl font-semibold mb-4">Top 5 Artists by Song Count</h3>
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600">Artist</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600">Songs Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topArtists as $artist)
                <tr>
                    <td class="py-2 px-4 border-b text-gray-700">{{ $artist->artist_name}}</td>
                    <td class="py-2 px-4 border-b text-gray-700">{{ $artist->song_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Songs Count by Genre -->
    <div class="bg-gray-100 p-4 rounded-lg shadow-md">
        <h3 class="text-2xl font-semibold mb-4">Songs Count by Genre</h3>
        <div class="space-y-2">
            @foreach($songsByGenre as $genre)
            <div class="flex justify-between py-2 px-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                <span class="font-medium text-gray-700 capitalize">{{ ucfirst($genre->genre) }}</span>
                <span class="text-gray-600">{{ $genre->song_count }} songs</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection