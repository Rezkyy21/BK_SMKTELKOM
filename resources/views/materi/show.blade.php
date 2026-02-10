<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $materi->judul }} - PSAJ</title>
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
                    <a href="{{ route('siswa.pribadi') }}" class="text-gray-700 hover:text-gray-900 font-medium">Pribadi</a>
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
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6">
            <a href="javascript:history.back()" class="text-blue-600 hover:underline text-sm font-medium">← Kembali</a>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Thumbnail -->
            @if($materi->thumbnail)
                <div class="w-full h-96 overflow-hidden">
                    <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Content -->
            <div class="p-8">
                <!-- Title -->
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $materi->judul }}</h1>
                
                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-6 mb-8 text-sm text-gray-600 border-b pb-6">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Guru:</span>
                        <span>{{ $materi->guru->nama }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-semibold text-gray-700">Kategori:</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">{{ $materi->kategori->nama_kategori }}</span>
                    </div>
                    @if($materi->published_at)
                        <div class="flex items-center gap-2">
                            <span class="font-semibold text-gray-700">Dipublikasikan:</span>
                            <span>
                                @if(is_string($materi->published_at))
                                    {{ \Carbon\Carbon::parse($materi->published_at)->format('d M Y') }}
                                @else
                                    {{ $materi->published_at->format('d M Y') }}
                                @endif
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Body Content -->
                <div class="prose prose-sm max-w-none mb-8 text-gray-700 leading-relaxed">
                    {!! nl2br(e($materi->konten)) !!}
                </div>

                <!-- Back Button -->
                <div class="mt-12 pt-8 border-t">
                    <a href="javascript:history.back()" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                        ← Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
