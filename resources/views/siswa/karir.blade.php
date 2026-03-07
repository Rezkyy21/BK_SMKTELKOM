<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karir - SMK Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .hero-section {
            background: linear-gradient(135deg, #fff8f0 0%, #fff 60%, #f0f4ff 100%);
        }

        .hero-brain {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .nav-link {
            position: relative;
            font-weight: 500;
            color: #374151;
            transition: color 0.2s;
        }

        .nav-link:hover { color: #111; }

        .nav-link.active {
            color: #e53e3e;
            font-weight: 700;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0; right: 0;
            height: 2px;
            background: #e53e3e;
            border-radius: 2px;
        }

        .card-hover {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.10);
        }

        .btn-primary {
            background: #e53e3e;
            color: white;
            padding: 10px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.2s, transform 0.15s;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #c53030;
            transform: translateY(-1px);
        }

        .section-divider {
            background: #f9fafb;
            border-top: 1px solid #f0f0f0;
            border-bottom: 1px solid #f0f0f0;
        }

        .artikel-card {
            display: flex;
            align-items: center;
            gap: 16px;
            background: white;
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .artikel-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.10);
        }

        footer a:hover { color: #e53e3e; }

        .layanan-card {
            border-radius: 12px;
            padding: 24px;
            transition: transform 0.2s;
        }

        .layanan-card:hover { transform: translateY(-3px); }
    </style>
</head>
<body class="bg-white">

    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">TS</span>
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm leading-tight">SMK Telkom</p>
                        <p class="text-gray-500 text-xs leading-tight">Purwokerto</p>
                    </div>
                </div>

                <!-- Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link">Home</a>
                    <a href="{{ route('siswa.karir') }}" class="nav-link active">Karir</a>
                    <a href="{{ route('siswa.belajar') }}" class="nav-link">Belajar</a>
                    <a href="{{ route('siswa.pribadi') }}" class="nav-link">Pribadi</a>
                    <a href="{{ route('siswa.sosial') }}" class="nav-link">Sosial</a>
                    <a href="{{ route('siswa.konseling') }}" class="nav-link">Konseling</a>
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    @endguest
                </div>

                @auth
                <!-- Profile -->
                <div class="relative group">
                    <button class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-100">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('siswa.profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 text-sm">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-50 text-sm">Logout</button>
                        </form>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section py-16 overflow-hidden">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-center justify-between gap-12">
                <!-- Text -->
                <div class="flex-1 max-w-xl">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight mb-4">
                        <span class="text-red-500">Masih bingung</span> mau lanjut Kuliah atau Kerja?
                    </h1>
                    <p class="text-gray-600 text-base leading-relaxed mb-8">
                        Yuk ikut Konseling Karir! Kami bantu kamu kenali minat bakat dan tentukan rencana masa depan. Konsultasi sekarang!
                    </p>
                    <a href="{{ route('siswa.konseling') }}" class="btn-primary">Bimbingan</a>
                </div>

                <!-- Illustration -->
                <div class="flex-shrink-0 hidden md:block">
                    <div class="hero-brain relative">
                        <!-- Brain SVG Illustration -->
                        <svg width="280" height="280" viewBox="0 0 280 280" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Body -->
                            <ellipse cx="140" cy="200" rx="50" ry="30" fill="#F9A8A8"/>
                            <!-- Legs -->
                            <rect x="110" y="220" width="18" height="35" rx="9" fill="#F9A8A8"/>
                            <rect x="152" y="220" width="18" height="35" rx="9" fill="#F9A8A8"/>
                            <!-- Arms -->
                            <rect x="72" y="175" width="40" height="16" rx="8" fill="#F9A8A8" transform="rotate(-20 72 175)"/>
                            <rect x="168" y="175" width="40" height="16" rx="8" fill="#F9A8A8" transform="rotate(20 168 175)"/>
                            <!-- Brain Head -->
                            <ellipse cx="140" cy="140" rx="72" ry="68" fill="#F87171"/>
                            <!-- Brain folds -->
                            <path d="M100 120 Q120 100 140 115 Q160 100 180 120" stroke="#EF4444" stroke-width="3" fill="none" stroke-linecap="round"/>
                            <path d="M95 140 Q115 125 135 138 Q155 125 175 140" stroke="#EF4444" stroke-width="3" fill="none" stroke-linecap="round"/>
                            <path d="M100 160 Q120 148 140 158 Q160 148 180 160" stroke="#EF4444" stroke-width="3" fill="none" stroke-linecap="round"/>
                            <!-- Eyes -->
                            <circle cx="120" cy="130" r="10" fill="white"/>
                            <circle cx="160" cy="130" r="10" fill="white"/>
                            <circle cx="122" cy="132" r="5" fill="#1f2937"/>
                            <circle cx="162" cy="132" r="5" fill="#1f2937"/>
                            <!-- Eyebrows (worried) -->
                            <path d="M110 118 Q120 112 130 116" stroke="#EF4444" stroke-width="3" stroke-linecap="round"/>
                            <path d="M150 116 Q160 112 170 118" stroke="#EF4444" stroke-width="3" stroke-linecap="round"/>
                            <!-- Mouth (worried) -->
                            <path d="M125 150 Q140 143 155 150" stroke="#EF4444" stroke-width="3" fill="none" stroke-linecap="round"/>
                            <!-- Question mark -->
                            <text x="200" y="90" font-size="52" fill="#818CF8" font-weight="900">?</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Career Plan Banner (Kelas 12) -->
    @auth
        @if ($user && $user->classRoom && $user->classRoom->grade_level === 12)
        <div class="max-w-6xl mx-auto px-6 mt-4">
            <div class="p-5 bg-amber-50 border-2 border-amber-300 rounded-xl flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-amber-900 text-lg mb-1">🎯 Rencana Karir Setelah Lulus</h3>
                    <p class="text-amber-800 text-sm">Anda sedang di kelas 12. Silakan isi rencana karir Anda untuk dipantau oleh guru BK.</p>
                </div>
                <a href="{{ route('career-plan.edit') }}" class="ml-4 px-6 py-2.5 bg-amber-500 text-white rounded-lg hover:bg-amber-600 font-semibold whitespace-nowrap transition">
                    {{ $user->careerPlan ? 'Edit Rencana' : 'Buat Rencana' }}
                </a>
            </div>
            @if ($user->careerPlan)
            <div class="mt-3 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                <h4 class="font-semibold text-blue-900 mb-2">Rencana Karir Anda:</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs text-gray-500">Kategori</p>
                        <p class="font-semibold text-gray-800">{{ $user->careerPlan->getCategoryLabel() }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Status</p>
                        <p class="font-semibold {{ $user->careerPlan->status === 'submitted' ? 'text-green-700' : 'text-yellow-700' }}">
                            {{ $user->careerPlan->status === 'submitted' ? '✓ Sudah Disubmit' : '⚠ Draft' }}
                        </p>
                    </div>
                </div>
                <p class="text-sm text-gray-700 mt-2"><strong>Detail:</strong> {{ $user->careerPlan->getDetailDescription() }}</p>
            </div>
            @endif
        </div>
        @else
        <div class="max-w-6xl mx-auto px-6 mt-4">
            <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-xl">
                <p class="text-blue-800 text-sm">
                    <strong>ℹ️ Info:</strong> Fitur rencana karir hanya tersedia untuk siswa kelas 12.
                    @if (!$user || !$user->classRoom)
                        Data kelas Anda belum tersedia.
                    @else
                        Anda saat ini di kelas {{ $user->classRoom->grade_level }}.
                    @endif
                </p>
            </div>
        </div>
        @endif
    @else
        <div class="max-w-6xl mx-auto px-6 mt-4">
            <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded-xl">
                <p class="text-blue-800 text-sm">
                    <strong>ℹ️ Info:</strong> Silakan <a href="{{ route('login') }}" class="font-semibold underline">login</a> untuk menggunakan fitur rencana karir.
                </p>
            </div>
        </div>
    @endauth

    <!-- Layanan Karir Section -->
    <section class="section-divider py-16 mt-10">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Layanan Karir</h2>
            <p class="text-gray-500 mb-10 text-base">Jelajahi berbagai peluang karir dan konsultasi dengan guru pembimbing karir kami untuk mengembangkan minat dan bakat Anda.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="layanan-card bg-blue-50 border border-blue-100">
                    <div class="w-10 h-10 bg-blue-200 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-blue-900 mb-2">Eksplorasi Karir</h3>
                    <p class="text-blue-700 text-sm leading-relaxed">Pelajari berbagai jalur karir yang sesuai dengan minat dan kemampuan Anda.</p>
                </div>

                <div class="layanan-card bg-green-50 border border-green-100">
                    <div class="w-10 h-10 bg-green-200 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-green-900 mb-2">Konsultasi Karir</h3>
                    <p class="text-green-700 text-sm leading-relaxed">Dapatkan bimbingan langsung dari guru pembimbing karir kami.</p>
                </div>

                <div class="layanan-card bg-purple-50 border border-purple-100">
                    <div class="w-10 h-10 bg-purple-200 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-purple-900 mb-2">Perencanaan Karir</h3>
                    <p class="text-purple-700 text-sm leading-relaxed">Susun langkah dan tujuan karir Anda secara terarah sesuai potensi dan rencana masa depan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Karir Section -->
    <section class="py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2 text-center">
                Artikel <span class="text-red-500">Karir</span>
            </h2>
            <p class="text-gray-500 text-center mb-10">Baca artikel terbaru seputar karir dan pengembangan diri</p>

            @php $materis = $materis ?? collect(); @endphp

            @if($materis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($materis as $materi)
                <div class="artikel-card">
                    <div class="w-28 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                        @if($materi->thumbnail)
                            <img src="{{ asset('storage/' . $materi->thumbnail) }}" alt="{{ $materi->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-gray-900 text-sm mb-1 line-clamp-2">{{ $materi->judul }}</h4>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 mb-3">{{ Str::limit(strip_tags($materi->konten), 100) }}</p>
                        <a href="{{ route('materi.show', $materi->slug) }}" class="text-xs font-bold text-red-500 hover:text-red-700 uppercase tracking-wide transition">Read More →</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-16 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <p class="text-lg font-medium">Belum ada artikel karir</p>
                <p class="text-sm mt-1">Artikel akan muncul di sini setelah ditambahkan oleh guru.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-12 mt-8">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <h4 class="font-bold text-red-500 mb-4 text-base">SMK Telkom Sandy Putra Purwokerto</h4>
                    <div class="space-y-2 text-sm text-gray-500">
                        <p class="font-medium text-gray-700">Contact us</p>
                        <p>bktelsmatel@gmail.com</p>
                        <p>+62 862722531</p>
                        <p>123 Ave, New York, USA</p>
                    </div>
                    <div class="flex space-x-3 mt-4">
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center hover:bg-red-100 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-4 text-sm">Layanan Kami</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="{{ route('siswa.karir') }}" class="hover:text-red-500 transition">Karir</a></li>
                        <li><a href="{{ route('siswa.belajar') }}" class="hover:text-red-500 transition">Belajar</a></li>
                        <li><a href="{{ route('siswa.pribadi') }}" class="hover:text-red-500 transition">Pribadi</a></li>
                        <li><a href="{{ route('siswa.sosial') }}" class="hover:text-red-500 transition">Sosial</a></li>
                        <li><a href="{{ route('siswa.konseling') }}" class="hover:text-red-500 transition">Konseling</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-4 text-sm">About</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li>Egesta vitae.</li>
                        <li>Viverra lorem ac.</li>
                        <li>Eget ac tellus.</li>
                        <li>Erat nulla.</li>
                        <li>Vulputate proin.</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-100 mt-10 pt-6 text-center text-xs text-gray-400">
                © {{ date('Y') }} SMK Telkom Sandy Putra Purwokerto. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>