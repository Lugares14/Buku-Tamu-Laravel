<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buku Tamu')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .bg-animate {
            background: linear-gradient(-45deg, #ff9a76, #ff6a00, #ff4e50, #f9d423, #ffa726, #ff7043);
            background-size: 400% 400%;
            animation: gradientMove 15s ease infinite;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
            100% { background-position: 0% 50%; }
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class=" text-gray-800 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="glass-effect p-4 shadow-md flex justify-between items-center">
        <h1 class="text-xl font-bold bg-gradient-to-r from-orange-600 to-red-500 bg-clip-text text-transparent">
            📖 Buku Tamu Admin
        </h1>
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}" 
               class="text-gray-700 font-medium hover:text-orange-600 transition">
                Dashboard
            </a>
            <a href="{{ route('tamu.index') }}" 
               class="text-gray-700 font-medium hover:text-orange-600 transition">
                Daftar Tamu
            </a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                        class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-4 py-2 rounded-lg shadow hover:from-orange-600 hover:to-red-600 transition">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
