@extends('layout.app')

@section('main')
    <!-- Main Content -->
    <div class="mb-4 border-b border-gray-200">
        <nav class="flex space-x-4">
            <button class="py-2 px-4 text-gray-600 hover:text-blue-600">User</button>
            <button class="py-2 px-4 text-gray-600 hover:text-blue-600">Artist</button>
        </nav>
    </div>

    <!-- Create Artist Form -->
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Create New Artist</h2>

        <form action="{{ route('artists.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" id="dob" name="dob" value="{{ old('dob') }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('dob') border-red-500 @enderror" required>
                @error('dob')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" name="gender" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('gender') border-red-500 @enderror" required>
                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                    <option value="m" {{ old('gender') === 'm' ? 'selected' : '' }}>Male</option>
                    <option value="f" {{ old('gender') === 'f' ? 'selected' : '' }}>Female</option>
                    <option value="o" {{ old('gender') === 'o' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="first_release_year" class="block text-sm font-medium text-gray-700">First Release Year</label>
                <input type="number" id="first_release_year" name="first_release_year" value="{{ old('first_release_year') }}" min="1900" max="{{ date('Y') }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('first_release_year') border-red-500 @enderror" required>
                @error('first_release_year')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="no_of_albums_released" class="block text-sm font-medium text-gray-700">Number of Albums Released</label>
                <input type="number" id="no_of_albums_released" name="no_of_albums_released" value="{{ old('no_of_albums_released') }}" min="0" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('no_of_albums_released') border-red-500 @enderror" required>
                @error('no_of_albums_released')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Create Artist
                </button>
            </div>
        </form>
    </div>
@endsection
