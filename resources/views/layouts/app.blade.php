<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Moj Blog - Najnoviji članci i postovi na teme koje vas interesuju.">
    <meta name="author" content="Aleksej">
    <title>@yield('title', 'Moj Blog')</title>

    <!-- Font Awesome za ikone -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Alpine.js (for dropdown functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Favicon (ako ga imaš) -->
    <link rel="icon" href="/path-to-favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-900 bg-cover bg-center text-white min-h-screen flex flex-col" style="background-image: url('{{ asset('images/background.jpg') }}');">

<!-- Navigacija -->
<nav class="bg-gray-800 shadow-md">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <a href="/" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Moj Blog Logo" class="w-16 h-auto">
            </a>

            <!-- Search bar -->
            <form action="{{ route('home') }}" method="GET" class="flex items-center space-x-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search posts..." class="px-4 py-2 border border-gray-700 rounded-l-md bg-gray-800 text-white w-64" />
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-r-md hover:bg-indigo-700">Search</button>
            </form>

            <!-- Avatar and Dropdown -->
            @auth
                <div class="relative" x-data="{ open: false }">
                    <a href="#" @click="open = !open" class="flex items-center">
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-10 h-10 rounded-full border-2 border-gray-300 cursor-pointer">
                    </a>
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-200 z-10">
                        <div class="p-2">
                            <a href="{{ route('profile.edit') }}" class="block text-gray-700 hover:bg-indigo-600 hover:text-white px-4 py-2 rounded-md">
                                Settings
                            </a>
                            <a href="{{ route('chat.index') }}" class="block text-gray-700 hover:bg-indigo-600 hover:text-white px-4 py-2 rounded-md">
                                Conversations
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left text-gray-700 hover:bg-red-600 hover:text-white px-4 py-2 rounded-md">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Login/Register buttons for guests -->
            <div class="flex items-center space-x-4">
                @guest
                    <a href="{{ route('login.form') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                        Login
                    </a>
                    <a href="{{ route('register.form') }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition duration-300">
                        Register
                    </a>
                @endguest
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="w-full mt-8 px-4 flex-grow">
    <main>
        @yield('content')
    </main>
</div>

<!-- Footer -->
<footer class="bg-gray-800 mt-8 py-6 text-center shadow-md">
    <p class="text-gray-400">&copy; 2025 Aleksej's Blog</p>
    <div class="mt-2">
        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300 ml-4"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300 ml-4"><i class="fab fa-instagram"></i></a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox-plus-jquery.min.js"></script>
<script src="{{ asset('/resources/js/app.js') }}"></script>
@stack('scripts')
</body>

</html>
