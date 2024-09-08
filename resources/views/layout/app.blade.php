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

        <!-- Header -->
        <header class="bg-blue-600 p-4 flex justify-between items-center text-white">
            <h1 class="text-xl font-semibold">Admin Dashboard</h1>
            <button class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg">Logout</button>
        </header>

        <!-- Content Section -->
        <div class="flex flex-grow">
            <!-- Sidebar -->
            <aside class="w-1/4 bg-gray-800 text-white p-6">
                <ul class="space-y-4">
                    <li>
                        <a href="#" class="flex items-center space-x-2">
                            <i class="ri-user-6-line"></i>
                            <span>User Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2">
                            <i class="ri-user-6-line"></i>
                            <span>Artist Management</span>
                        </a>
                    </li>
                </ul>
            </aside>
        
            <!-- Main Content -->
            <main class="flex-grow p-6 bg-white">
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
