@extends('layout.app')

@section('main')
<div class="container mx-auto px-4 py-8">
    <!-- Page Heading -->
    <div class="flex justify-between items-center mb-3">
        <h1 class="text-3xl font-bold text-gray-800">User Records</h1>
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
            + Create New User
        </a>
    </div>
    <!-- User Table -->
    <div class="overflow-hidden border border-gray-200 shadow-md sm:rounded-lg mt-5">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        First Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Last Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($users as $user)
                    <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->first_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->last_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-500 hover:text-yellow-700 transition">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block ml-4">
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

    <!-- Pagination Links -->
    <div class="mt-6">
        <div class="flex justify-between items-center">
            <!-- Previous Page Link -->
            @if ($users->onFirstPage())
                <span class="bg-gray-300 text-gray-500 px-3 py-1 rounded-md cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $users->previousPageUrl() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Previous</a>
            @endif
    
            <!-- Page Numbers -->
            <div class="flex space-x-2">
                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    @if ($i == $users->currentPage())
                        <span class="bg-blue-500 text-white px-4 py-2 rounded-md">{{ $i }}</span>
                    @else
                        <a href="{{ $users->url($i) }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">{{ $i }}</a>
                    @endif
                @endfor
            </div>
    
            <!-- Next Page Link -->
            @if ($users->hasMorePages())
                <a href="{{ $users->nextPageUrl() }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Next</a>
            @else
                <span class="bg-gray-300 text-gray-500 px-3 py-1 rounded-md cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
</div>
@endsection
