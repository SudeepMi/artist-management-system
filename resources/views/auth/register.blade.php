<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS | Registration Page</title>
    <style>
        /* Custom styles for the cover image */
        .cover-image {
            background: url("{{ asset('assets/images/auth-cover.jpg') }}") no-repeat center center;
            background-size: cover;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="h-screen flex">
    <!-- Grid Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 h-screen w-full">
        <!-- Cover Image (1/3 width) -->
        <div class="cover-image hidden lg:block lg:col-span-1 h-screen"></div>

        <!-- Registration Form (2/3 width) -->
        <div class=" items-center justify-center bg-gray-100 p-8 lg:col-span-2 h-screen overflow-auto grid">
            <div class="bg-white p-5 rounded-3xl shadow-xl w-full max-w-lg">
                <!-- <h2 class="text-3xl font-bold mb-2 text-gray-800 text-center">Create Your Account</h2> -->

                <!-- Display Validation Errors -->
                @if ($errors->any())
                <div class="mb-6 p-4 bg-red-200 text-red-800 border border-red-300 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="flex flex-wrap mb-4">

                        <div class="w-full md:w-1/2 md:pr-2">
                            <label for="first_name" class="block text-gray-600 font-semibold mb-2">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required value="{{ old('first_name') }}">
                        </div>

                        <div class="w-full md:w-1/2 md:pl-2">
                            <label for="last_name" class="block text-gray-600 font-semibold mb-2">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required value="{{ old('last_name') }}">
                        </div>
                    </div>



                    <div class="mb-4">
                        <label for="email" class="block text-gray-600 font-semibold mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required value="{{ old('email') }}">
                    </div>


                    <div class="mb-4">
                        <label for="password" class="block text-gray-600 font-semibold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required>
                    </div>


                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-600 font-semibold mb-2">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required>
                    </div>


                    <div class="mb-4">
                        <label for="phone" class="block text-gray-600 font-semibold mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required value="{{ old('phone') }}">
                    </div>

                    <div class="flex flex-wrap mb-4">

                        <div class="w-full md:w-1/2 md:pr-2">
                            <label for="dob" class="block text-gray-600 font-semibold mb-2">Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required value="{{ old('dob') }}">
                        </div>

                        <div class="w-full md:w-1/2 md:pl-2">
                            <div class="mb-4">
                                <label class="block text-gray-600 font-semibold mb-2">Gender</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="gender" value="m" class="form-radio" {{ old('gender') == 'm' ? 'checked' : '' }}>
                                        <span class="ml-2">Male</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="gender" value="f" class="form-radio" {{ old('gender') == 'f' ? 'checked' : '' }}>
                                        <span class="ml-2">Female</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="gender" value="0" class="form-radio" {{ old('gender') == '0' ? 'checked' : '' }}>
                                        <span class="ml-2">Other</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="address" class="block text-gray-600 font-semibold mb-2">Address</label>
                        <textarea id="address" name="address" rows="3" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required>{{ old('address') }}</textarea>
                    </div>


                    <div class="mb-6">
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-lg shadow-md hover:from-purple-600 hover:to-pink-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500">Register</button>
                    </div>


                    <p class="text-center text-gray-700">
                        Already have an account? <a href="{{ route('login') }}" class="text-purple-500 hover:underline">Login</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>