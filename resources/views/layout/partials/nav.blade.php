<header class=" p-6 shadow-lg flex justify-between items-center text-black">
    <div class="flex items-center space-x-3">
        <h1 class="text-2xl font-bold tracking-wide">Artist Management System</h1>
    </div>

    <div>
        <!-- Logout Form -->
        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 transition-colors px-6 py-2 rounded-full shadow-lg flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m-6-4V9m0 0l-4 4m4-4h1" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</header>