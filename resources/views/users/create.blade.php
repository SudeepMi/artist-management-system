@extends('layout.app')
@section('main')
<!-- Create New User Form -->
<div class="max-w-2xl mx-auto">
    <h2 class="text-lg font-semibold mb-4">Create New User</h2>

    <form action="{{ route('users.store')}}" method="POST" class="space-y-6">
        @csrf
    
        <!-- First Name -->
        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="first_name" name="first_name" 
                   class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('first_name') border-red-500 @enderror"
                   value="{{ old('first_name') }}" required>
            @error('first_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Last Name -->
        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="last_name" name="last_name" 
                   class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('last_name') border-red-500 @enderror"
                   value="{{ old('last_name') }}" required>
            @error('last_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" 
                   class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" 
                   class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('password') border-red-500 @enderror"
                   required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" id="phone" name="phone" 
                   class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('phone') border-red-500 @enderror"
                   value="{{ old('phone') }}" required>
            @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Date of Birth -->
        <div>
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" id="dob" name="dob" 
                   class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('dob') border-red-500 @enderror"
                   value="{{ old('dob') }}" required>
            @error('dob')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">role</label>
            <select id="role" name="role" 
                    class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('gender') border-red-500 @enderror"
                    required>
                <option value="" disabled selected>Select Gender</option>
                <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Admin</option>
                <option value="artist_manager" {{ old('role') == 'artist_manager' ? 'selected' : '' }}>Artist Manager</option>
                <option value="artist" {{ old('role') == 'artist' ? 'selected' : '' }}>Artist</option>
            </select>
            @error('gender')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Gender -->
        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select id="gender" name="gender" 
                    class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('gender') border-red-500 @enderror"
                    required>
                <option value="" disabled selected>Select Gender</option>
                <option value="m" {{ old('gender') == 'm' ? 'selected' : '' }}>Male</option>
                <option value="f" {{ old('gender') == 'f' ? 'selected' : '' }}>Female</option>
                <option value="o" {{ old('gender') == 'o' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Address -->
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" id="address" name="address" 
                   class="mt-1 block w-full p-2 border rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 @error('address') border-red-500 @enderror"
                   value="{{ old('address') }}" required>
            @error('address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <!-- Submit Button -->
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                Create User
            </button>
        </div>
    </form>
    
</div>

@endsection