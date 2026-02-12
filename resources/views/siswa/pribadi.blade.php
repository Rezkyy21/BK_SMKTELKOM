<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pribadi - PSAJ</title>
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
                    <a href="{{ route('siswa.dashboard') }}" class="text-gray-700 hover:text-gray-900 font-medium">Home</a>
                    <a href="{{ route('siswa.karir') }}" class="text-gray-700 hover:text-gray-900 font-medium">Karir</a>
                    <a href="{{ route('siswa.belajar') }}" class="text-gray-700 hover:text-gray-900 font-medium">Belajar</a>
                    <a href="{{ route('siswa.pribadi') }}" class="text-blue-600 hover:text-blue-800 font-medium border-b-2 border-blue-600">Pribadi</a>
                    <a href="{{ route('siswa.sosial') }}" class="text-gray-700 hover:text-gray-900 font-medium">Sosial</a>
                    <a href="{{ route('siswa.konseling') }}" class="text-gray-700 hover:text-gray-900 font-medium">Konseling</a>
                </div>

                <!-- Profile Dropdown -->
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
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Layanan Pribadi</h1>
            <p class="text-gray-600 mb-6">
                Dapatkan dukungan dan bimbingan untuk pengembangan pribadi, kesehatan mental, dan kesejahteraan Anda.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                <div class="bg-gradient-to-br from-pink-100 to-pink-50 rounded-lg p-6 border border-pink-200">
                    <h3 class="text-lg font-semibold text-pink-900 mb-2">Konsultasi Pribadi</h3>
                    <p class="text-pink-700 text-sm">Bicarakan masalah pribadi Anda dengan konselor profesional kami.</p>
                </div>
                <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-lg p-6 border border-red-200">
                    <h3 class="text-lg font-semibold text-red-900 mb-2">Kesehatan Mental</h3>
                    <p class="text-red-700 text-sm">Dukung kesehatan mental Anda dengan program wellness dan self-care.</p>
                </div>
                <div class="bg-gradient-to-br from-rose-100 to-rose-50 rounded-lg p-6 border border-rose-200">
                    <h3 class="text-lg font-semibold text-rose-900 mb-2">Pengembangan Diri</h3>
                    <p class="text-rose-700 text-sm">Ikuti program pengembangan diri untuk meningkatkan potensi Anda.</p>
                </div>
            </div>
    
            @include('siswa._materi_cards', ['materis' => $materis ?? collect(), 'kategoriLabel' => 'Pribadi'])
            @if(!isset($materis) || $materis->isEmpty())
                <p class="mt-8 text-gray-500 text-sm">Belum ada materi yang dipublikasikan di kategori ini.</p>
            @endif
        </div>
    </div>
</body>
</html>
