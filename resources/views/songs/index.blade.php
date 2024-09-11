@extends('layout.app')

@section('main')
<div class="container mx-auto px-4 py-8">
    <!-- Artist Actions (Artist Manager Access) -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Artist Songs Records</h2>
        <div>

            <a href="{{ route('songs.create', [$id]) }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">+ Create New Song</a>
        </div>

    </div>

    <!-- Artist List -->
    <div class="overflow-hidden border border-gray-200 shadow-md sm:rounded-lg mt-5">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Genre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Album Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($songs as $song)

                <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $song->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $song->genre }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $song->album_name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('songs.edit', $song->id) }}" class="text-yellow-500 hover:text-yellow-700 transition">Edit</a>
                        <form action="{{ route('songs.destroy', $song->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="mt-6">
        <div class="flex justify-between items-center">
            <!-- Previous Page Link -->
            @if ($songs->onFirstPage())
            <span class="bg-gray-300 text-gray-500 px-3 py-1 rounded-md cursor-not-allowed">Previous</span>
            @else
            <a href="{{ $songs->previousPageUrl() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Previous</a>
            @endif

            <!-- Page Numbers -->
            <div class="flex space-x-2">
                @for ($i = 1; $i <= $songs->lastPage(); $i++)
                    @if ($i == $songs->currentPage())
                    <span class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ $i }}</span>
                    @else
                    <a href="{{ $songs->url($i) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">{{ $i }}</a>
                    @endif
                    @endfor
            </div>

            <!-- Next Page Link -->
            @if ($songs->hasMorePages())
            <a href="{{ $songs->nextPageUrl() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Next</a>
            @else
            <span class="bg-gray-300 text-gray-500 px-3 py-1 rounded-md cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
</div>
@endsection