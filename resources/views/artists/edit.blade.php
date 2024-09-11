@extends('layout.app')

@section('main')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Edit Artist</h2>

    <form action="{{ route('artists.update', $artist->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $artist->name) }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror" required>
            @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" id="dob" name="dob" value="{{ old('dob', $artist->dob) }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('dob') border-red-500 @enderror" required>
            @error('dob')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select id="gender" name="gender" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('gender') border-red-500 @enderror" required>
                <option value="" disabled {{ old('gender', $artist->gender) ? '' : 'selected' }}>Select Gender</option>
                <option value="m" {{ old('gender', $artist->gender) === 'm' ? 'selected' : '' }}>Male</option>
                <option value="f" {{ old('gender', $artist->gender) === 'f' ? 'selected' : '' }}>Female</option>
                <option value="o" {{ old('gender', $artist->gender) === 'o' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="first_release_year" class="block text-sm font-medium text-gray-700">First Release Year</label>
            <input type="number" id="first_release_year" name="first_release_year" value="{{ old('first_release_year', $artist->first_release_year) }}" min="1900" max="{{ date('Y') }}" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('first_release_year') border-red-500 @enderror" required>
            @error('first_release_year')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="no_of_albums_released" class="block text-sm font-medium text-gray-700">Number of Albums Released</label>
            <input type="number" id="no_of_albums_released" name="no_of_albums_released" value="{{ old('no_of_albums_released', $artist->no_of_albums_released) }}" min="0" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('no_of_albums_released') border-red-500 @enderror" required>
            @error('no_of_albums_released')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('artists.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</a>
            <button type="submit" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update Artist</button>
        </div>
    </form>
</div>
@endsection