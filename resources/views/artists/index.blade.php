@extends('layout.app')

@section('main')
<div class="container mx-auto px-4 py-8">
    <!-- Artist Actions (Artist Manager Access) -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Artist Records</h2>
        <div>
            <a href="{{ route('artists.import') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Import</a>
            <a href="{{ route('artists.export') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Export</a>
            <a href="{{ route('artists.create') }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">+ Create New Artist</a>
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
                        Date of Birth
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        First Release Year
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Number of Albums Released
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($artists as $artist)
                <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $artist->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ date('d M Y', strtotime($artist->dob)) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($artist->gender === 'm') Male
                        @elseif($artist->gender === 'f') Female
                        @else Other
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $artist->first_release_year }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $artist->no_of_albums_released }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('artists.edit', $artist->id) }}" class="text-yellow-500 hover:text-yellow-700 transition">Edit</a>
                        <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition">Delete</button>
                        </form>
                        <a href="{{ route('songs.index', $artist->id) }}" class="text-blue-500 hover:text-blue-700 transition ml-4">View Songs</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <div class="mt-6">
        <div class="flex justify-between items-center">
            <!-- Previous Page Link -->
            @if ($artists->onFirstPage())
            <span class="bg-gray-300 text-gray-500 px-3 py-1 rounded-md cursor-not-allowed">Previous</span>
            @else
            <a href="{{ $artists->previousPageUrl() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Previous</a>
            @endif

            <!-- Page Numbers -->
            <div class="flex space-x-2">
                @for ($i = 1; $i <= $artists->lastPage(); $i++)
                    @if ($i == $artists->currentPage())
                    <span class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ $i }}</span>
                    @else
                    <a href="{{ $artists->url($i) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">{{ $i }}</a>
                    @endif
                    @endfor
            </div>

            <!-- Next Page Link -->
            @if ($artists->hasMorePages())
            <a href="{{ $artists->nextPageUrl() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Next</a>
            @else
            <span class="bg-gray-300 text-gray-500 px-3 py-1 rounded-md cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
</div>
@endsection