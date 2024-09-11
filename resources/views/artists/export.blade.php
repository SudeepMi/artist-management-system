@extends('layout.app')

@section('main')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Export Artist List</h2>

    <form action="{{ route('artists.export.save') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label for="count" class="block text-sm font-medium text-gray-700">Select Record Count</label>
            <select id="count" name="count" class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="all">All</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Select Columns to Export</label>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <input type="checkbox" id="all" name="columns[]" value="all" class="mr-2">
                    <label for="all">All</label>
                </div>
                <div>
                    <input type="checkbox" id="name" name="columns[]" value="name" class="mr-2">
                    <label for="name">Name</label>
                </div>
                <div>
                    <input type="checkbox" id="dob" name="columns[]" value="dob" class="mr-2">
                    <label for="dob">Date of Birth</label>
                </div>
                <div>
                    <input type="checkbox" id="gender" name="columns[]" value="gender" class="mr-2">
                    <label for="gender">Gender</label>
                </div>
                <div>
                    <input type="checkbox" id="first_release_year" name="columns[]" value="first_release_year" class="mr-2">
                    <label for="first_release_year">First Release Year</label>
                </div>
                <div>
                    <input type="checkbox" id="no_of_albums_released" name="columns[]" value="no_of_albums_released" class="mr-2">
                    <label for="no_of_albums_released">No. of Albums Released</label>
                </div>
                <div>
                    <input type="checkbox" id="email" name="columns[]" value="email" class="mr-2">
                    <label for="email">Email</label>
                </div>

            </div>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Export CSV
            </button>
        </div>
    </form>
</div>
@endsection