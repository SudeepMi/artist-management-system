@extends('layout.app')
@section('main')

<div id="userTab">
    <!-- User Actions (Visible for Super Admin only) -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">User Records</h2>
        <a href="{{ route('users.create')}}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">+ Create New User</a>
    </div>

    <!-- User List -->
    <table class="w-full text-left table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <!-- Example User Row -->
            <tr>
                <td class="px-4 py-2">John Doe</td>
                <td class="px-4 py-2">john@example.com</td>
                <td class="px-4 py-2">super_admin</td>
                <td class="px-4 py-2">
                    <button class="text-yellow-500 mr-2">Edit</button>
                    <button class="text-red-500">Delete</button>
                </td>
            </tr>
            <!-- More rows -->
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="flex justify-end mt-4">
        <button class="bg-gray-200 px-3 py-1 rounded-md">Previous</button>
        <button class="bg-gray-200 px-3 py-1 rounded-md ml-2">Next</button>
    </div>
</div>

<!-- Artist Tab Content -->
<div id="artistTab" class="hidden">
    <!-- Artist Actions (Artist Manager Access) -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-lg font-semibold">Artist Records</h2>
        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">+ Create New Artist</button>
    </div>

    <!-- Artist List -->
    <table class="w-full text-left table-auto">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Genre</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <!-- Example Artist Row -->
            <tr>
                <td class="px-4 py-2">Jane Smith</td>
                <td class="px-4 py-2">Pop</td>
                <td class="px-4 py-2">
                    <button class="text-yellow-500 mr-2">Edit</button>
                    <button class="text-red-500">Delete</button>
                    <button class="text-blue-500 ml-2">View Songs</button>
                </td>
            </tr>
            <!-- More rows -->
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="flex justify-end mt-4">
        <button class="bg-gray-200 px-3 py-1 rounded-md">Previous</button>
        <button class="bg-gray-200 px-3 py-1 rounded-md ml-2">Next</button>
    </div>
</div>

@endsection