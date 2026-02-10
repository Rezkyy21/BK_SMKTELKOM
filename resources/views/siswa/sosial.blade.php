<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sosial - PSAJ</title>
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
                    <a href="{{ route('siswa.sosial') }}" class="text-blue-600 hover:text-blue-800 font-medium border-b-2 border-blue-600">Sosial</a>
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
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Layanan Sosial</h1>
            <p class="text-gray-600 mb-6">
                Ikuti berbagai kegiatan sosial dan program kepedulian sosial untuk mengembangkan tanggung jawab sosial Anda.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                <div class="bg-gradient-to-br from-teal-100 to-teal-50 rounded-lg p-6 border border-teal-200">
                    <h3 class="text-lg font-semibold text-teal-900 mb-2">Kegiatan Sosial</h3>
                    <p class="text-teal-700 text-sm">Bergabunglah dengan kegiatan sosial kami untuk membantu masyarakat.</p>
                </div>
                <div class="bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-lg p-6 border border-emerald-200">
                    <h3 class="text-lg font-semibold text-emerald-900 mb-2">Kerja Sama Tim</h3>
                    <p class="text-emerald-700 text-sm">Kembangkan keterampilan kerja sama dan kepemimpinan bersama tim.</p>
                </div>
                <div class="bg-gradient-to-br from-green-100 to-green-50 rounded-lg p-6 border border-green-200">
                    <h3 class="text-lg font-semibold text-green-900 mb-2">Program Kepedulian</h3>
                    <p class="text-green-700 text-sm">Ikuti program kepedulian sosial untuk memberdayakan masyarakat sekitar.</p>
                </div>
            </div>
    
        @if(isset($materis) && $materis->isNotEmpty())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <h2 class="text-2xl font-semibold mb-4">Daftar Materi Sosial</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($materis as $m)
                        <a href="{{ route('materi.show', $m->slug) }}" class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow overflow-hidden h-full flex flex-col">
                            @if($m->thumbnail)
                                <div class="w-full h-40 overflow-hidden bg-gray-200">
                                    <img src="{{ asset('storage/' . $m->thumbnail) }}" alt="{{ $m->judul }}" class="w-full h-full object-cover hover:scale-105 transition-transform">
                                </div>
                            @else
                                <div class="w-full h-40 bg-gradient-to-br from-gray-300 to-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                </div>
                            @endif
                            <div class="p-4 flex flex-col flex-grow">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800 line-clamp-2">{{ $m->judul }}</h3>
                                <p class="text-sm text-gray-600 mb-3 flex-grow">{{ Str::limit(strip_tags($m->konten), 120) }}</p>
                                <span class="text-blue-600 hover:underline text-sm font-medium">Baca selengkapnya →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        </div>
    </div>
</body>
</html>
