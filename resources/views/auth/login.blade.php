<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .cover-image {
            background: url("{{ asset('assets/images/auth-cover.jpg') }}") no-repeat center center;
            background-size: cover;
        }
    </style>
</head>

<body class="h-screen flex">

    <div class="grid grid-cols-1 lg:grid-cols-3 h-full w-full">

        <div class="cover-image hidden lg:block lg:col-span-1"></div>

        <div class="flex items-center justify-center bg-gray-100 p-8 lg:col-span-2">
            <div class="bg-white p-10 rounded-3xl shadow-xl w-full max-w-md">
                <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Welcome Back</h2>
                @if ($errors->any())
                <div class="mb-6 p-4 bg-red-200 text-red-800 border border-red-300 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-gray-600 font-semibold mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-600 font-semibold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-300 ease-in-out" required>
                    </div>
                    <div class="mb-6">
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-lg shadow-md hover:from-purple-600 hover:to-pink-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500">Login</button>
                    </div>
                    <p class="text-center text-gray-700">
                        Don't have an account? <a href="{{ route('register') }}" class="text-purple-500 hover:underline">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

</body>

</html>