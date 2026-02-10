<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - PSAJ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation Header -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gray-800 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">★</span>
                    </div>
                    <span class="font-semibold text-gray-800">LOGO</span>
                </div>

                <!-- Menu Items -->
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('siswa.dashboard') }}" class="text-blue-600 hover:text-blue-800 font-medium border-b-2 border-blue-600">Home</a>
                    <a href="{{ route('siswa.karir') }}" class="text-gray-700 hover:text-gray-900 font-medium">Karir</a>
                    <a href="{{ route('siswa.belajar') }}" class="text-gray-700 hover:text-gray-900 font-medium">Belajar</a>
                    <a href="{{ route('siswa.pribadi') }}" class="text-gray-700 hover:text-gray-900 font-medium">Pribadi</a>
                    <a href="{{ route('siswa.sosial') }}" class="text-gray-700 hover:text-gray-900 font-medium">Sosial</a>
                    <a href="{{ route('siswa.konseling') }}" class="text-gray-700 hover:text-gray-900 font-medium">Konseling</a>
                </div>

                <!-- User Profile Icon -->
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-gray-900 p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="px-4 py-3 border-b">
                                <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-gray-200 to-gray-100 py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Selamat Datang, {{ auth()->user()->name }}</h1>
                <p class="text-gray-600">Jelajahi layanan konseling kami</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Section Title -->
        <div class="mb-12">
            <h2 class="text-3xl font-bold text-gray-800 text-center">Guru Konseling</h2>
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                <div class="bg-gradient-to-br from-blue-300 to-blue-400 h-48 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16V4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v4h8v-4h4c1.1 0 2-.9 2-2V6z"/>
                    </svg>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Guru Konseling</h3>
                    <p class="text-gray-600 text-sm">Neque voluptopt morbi. Et blandit non et ac equistos /nisi non.</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                <div class="bg-gradient-to-br from-purple-300 to-purple-400 h-48 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16V4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v4h8v-4h4c1.1 0 2-.9 2-2V6z"/>
                    </svg>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Guru Konseling</h3>
                    <p class="text-gray-600 text-sm">Neque voluptopt morbi. Et blandit non et ac equistos /nisi non.</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                <div class="bg-gradient-to-br from-pink-300 to-pink-400 h-48 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16V4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v4h8v-4h4c1.1 0 2-.9 2-2V6z"/>
                    </svg>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Guru Konseling</h3>
                    <p class="text-gray-600 text-sm">Neque voluptopt morbi. Et blandit non et ac equistos /nisi non.</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                <div class="bg-gradient-to-br from-indigo-300 to-indigo-400 h-48 flex items-center justify-center">
                    <svg class="w-16 h-16 text-white opacity-50" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16V4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v4h8v-4h4c1.1 0 2-.9 2-2V6z"/>
                    </svg>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-800 mb-2">Guru Konseling</h3>
                    <p class="text-gray-600 text-sm">Neque voluptopt morbi. Et blandit non et ac equistos /nisi non.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12 mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p>&copy; 2026 PSAJ - Platform Sistem Administrasi Jil. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
