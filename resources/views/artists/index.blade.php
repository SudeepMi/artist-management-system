@extends('layout.app')

@section('main')
    <!-- Main Content -->
    <div class="mb-4 border-b border-gray-200">
        <nav class="flex space-x-4">
            <button class="py-2 px-4 text-gray-600 hover:text-blue-600">User</button>
            <button class="py-2 px-4 text-blue-600 border-b-2 border-blue-600 font-semibold">Artist</button>
        </nav>
    </div>

    <!-- Artist Tab Content -->
    <div id="artistTab">
        <!-- Artist Actions (Artist Manager Access) -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Artist Records</h2>
            <a href="{{ route('artists.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">+ Create New Artist</a>
        </div>

        <!-- Artist List -->
        <table class="w-full text-left table-auto border border-gray-300 rounded-md shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border-b">Name</th>
                    <th class="px-4 py-2 border-b">Date of Birth</th>
                    <th class="px-4 py-2 border-b">Gender</th>
                    <th class="px-4 py-2 border-b">First Release Year</th>
                    <th class="px-4 py-2 border-b">Number of Albums Released</th>
                    <th class="px-4 py-2 border-b">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($artists as $artist)
                    <tr>
                        <td class="px-4 py-2">{{ $artist->name }}</td>
                        <td class="px-4 py-2">{{ $artist->dob->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            @if($artist->gender === 'm') Male
                            @elseif($artist->gender === 'f') Female
                            @else Other
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $artist->first_release_year }}</td>
                        <td class="px-4 py-2">{{ $artist->no_of_albums_released }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('artists.edit', $artist->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                            </form>
                            <a href="{{ route('artists.songs', $artist->id) }}" class="text-blue-500 hover:underline ml-2">View Songs</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{-- <div class="flex justify-end mt-4">
            {{ $artists->links('vendor.pagination.tailwind') }}
        </div> --}}
    </div>
@endsection
