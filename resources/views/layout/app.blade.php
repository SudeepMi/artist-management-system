<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/remixicon.css')}}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">

        @include('layout.partials.nav')

        <div class="flex flex-grow">
            <main class="flex-grow p-6 bg-white">
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <span class="text-gray-600 text-sm font-medium">Logged In as</span>
                    <div class="mt-2 flex items-center space-x-2">
                        <p class="text-lg font-semibold text-gray-800">{{ Auth::user()->first_name }}</p>
                        <p class="text-lg font-semibold text-blue-600">|</p>
                        <p class="text-lg font-semibold text-gray-800">{{ Auth::user()->getOriginal('role') }}</p>
                    </div>
                </div>

                <div class="mb-4 border-b border-gray-200">
                    <nav class="flex space-x-4">
                        <a href="/dashboard" class="py-2 px-4 {{ Request::segment(1) == 'dashboard' ? 'text-blue-600 border-b-2 border-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">Dashboard</a>
                        @if(Auth::user()->getOriginal('role') == "artist")
                        @php
                        $artistId = DB::selectOne('SELECT * FROM artists WHERE user_id = ?', [Auth::user()->getOriginal('id')]);
                        @endphp
                        <a href="{{ route('songs.index', $artistId->id) }}" class="py-2 px-4 {{ Request::segment(3) == 'songs' ? 'text-blue-600 border-b-2 border-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">My Songs</a>
                        @else
                        <a href="/users" class="py-2 px-4 {{ Request::segment(1) == 'users' ? 'text-blue-600 border-b-2 border-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">User</a>
                        <a href="/artists" class="py-2 px-4 {{ Request::segment(1) == 'artists' ? 'text-blue-600 border-b-2 border-blue-600 font-semibold' : 'text-gray-600 hover:text-blue-600' }}">Artist</a>
                        @endif
                    </nav>
                </div>

                @if($message = Session::get('success'))
                <div id="toast-div" role="alert" aria-live="assertive" aria-atomic="true"
                    class="absolute right-2 bg-green-500 text-white max-w-xs rounded-lg shadow-lg overflow-hidden transition-transform transform translate-y-[-100%] animate-slide-up">
                    <div class="flex items-center justify-between px-4 py-2">
                        <div class="flex items-center">
                            <span class="font-semibold">Success</span>
                        </div>
                        <button type="button" class="text-white hover:bg-green-700 focus:outline-none px-2 py-1 rounded"
                            onclick="document.getElementById('toast-div').remove()">
                            ×
                        </button>
                    </div>
                    <div class="px-4 py-2 bg-white text-green-700">
                        {{ $message }}
                    </div>
                </div>
                @endif

                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-4xl m-auto" role="alert">
                    <strong class="font-bold">Whoops! Something went wrong.</strong>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- Tab Navigation -->
                @yield('main')

            </main>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-div');
            if (toast) {
                setTimeout(() => {
                    toast.classList.add('opacity-0');
                    setTimeout(() => toast.remove(), 300); // Delay to allow opacity transition
                }, 3000); // Time before auto-remove (3000ms = 3 seconds)
            }
        });
    </script>
</body>

</html>