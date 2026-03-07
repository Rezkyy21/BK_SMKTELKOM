<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - SMK Telkom Purwokerto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-screen overflow-hidden">
    <div class="flex h-screen">
        {{-- Bagian kiri: gambar sekolah --}}
        <div class="hidden lg:flex lg:flex-1 lg:min-h-screen relative overflow-hidden">
        {{-- Background image dengan overlay gelap di bawah --}}
        <div class="absolute inset-0">
            <img src="/path/to/school-image.jpg" alt="SMK Telkom Purwokerto" class="w-full h-full object-cover">
            {{-- Gradient overlay dari transparan di atas ke gelap di bawah --}}
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/70"></div>
        </div>
        
        {{-- Konten di atas gambar --}}
        <div class="relative z-10 flex flex-col justify-between w-full p-12">
            {{-- Logo dan text di atas --}}
            <div class="text-white">
                <h2 class="text-3xl font-bold tracking-tight">Telkom Schools</h2>
                <p class="text-2xl font-semibold mt-1">SMK Telkom Purwokerto</p>
            </div>
            
            {{-- Text di bawah --}}
            <div class="text-white/90">
                <p class="text-sm">Sistem Bimbingan Konseling</p>
                <p class="text-xs mt-1">SMK Telkom Purwokerto</p>
            </div>
        </div>
    </div>

    {{-- Bagian kanan: form login --}}
    <div class="flex-1 flex flex-col justify-center px-6 py-12 lg:px-12 bg-white w-full">
        <div class="w-full max-w-md mx-auto">
            {{-- Header --}}
            <div>
                <h1 class="text-4xl font-bold text-gray-900">Sign In</h1>
            </div>

            {{-- Tab Siswa / Guru --}}
            <div class="mt-8 flex gap-4">
                <button type="button" id="tab-siswa" class="flex-1 py-3 rounded-full text-base font-semibold text-white transition tab-btn bg-[#E31837] shadow-md">
                    Siswa
                </button>
                <button type="button" id="tab-guru" class="flex-1 py-3 rounded-full text-base font-medium text-gray-900 transition tab-btn bg-white border-2 border-gray-200 hover:border-gray-300">
                    Guru
                </button>
            </div>

            {{-- Form --}}
            <div class="mt-10">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- NIS / Email (switches based on tab) --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            <span id="email-label">NIS</span>
                        </label>
                        <input id="email" name="email" type="text" value="{{ old('email') }}"
                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 placeholder:text-gray-400 focus:border-[#E31837] focus:ring-1 focus:ring-[#E31837] focus:bg-white transition"
                               placeholder="NIS"
                               required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" name="password" type="password"
                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 placeholder:text-gray-400 focus:border-[#E31837] focus:ring-1 focus:ring-[#E31837] focus:bg-white transition"
                               placeholder="Type your password"
                               required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    {{-- Forgot Password --}}
                    <div class="text-right">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-[#E31837] transition">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full flex justify-center rounded-full bg-[#E31837] px-4 py-3.5 text-base font-semibold text-white shadow-lg hover:bg-[#c41230] focus:outline-none focus:ring-2 focus:ring-[#E31837] focus:ring-offset-2 transition-all">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabSiswa = document.getElementById('tab-siswa');
            const tabGuru = document.getElementById('tab-guru');
            const emailInput = document.getElementById('email');
            const emailLabel = document.getElementById('email-label');

            function setActiveTab(active) {
                if (active === 'siswa') {
                    // Style untuk tab Siswa (aktif)
                    tabSiswa.classList.add('bg-[#E31837]', 'text-white', 'shadow-md');
                    tabSiswa.classList.remove('bg-white', 'border-2', 'border-gray-200', 'text-gray-900');
                    
                    // Style untuk tab Guru (tidak aktif)
                    tabGuru.classList.remove('bg-[#E31837]', 'text-white', 'shadow-md');
                    tabGuru.classList.add('bg-white', 'border-2', 'border-gray-200', 'text-gray-900');
                    
                    // Update input untuk NIS
                    emailInput.placeholder = 'Contoh: 12345';
                    emailInput.type = 'text';
                    emailInput.pattern = '[0-9]*';
                    if (emailLabel) emailLabel.textContent = 'NIS (Nomor Induk Siswa)';
                } else {
                    // Style untuk tab Guru (aktif)
                    tabGuru.classList.add('bg-[#E31837]', 'text-white', 'shadow-md');
                    tabGuru.classList.remove('bg-white', 'border-2', 'border-gray-200', 'text-gray-900');
                    
                    // Style untuk tab Siswa (tidak aktif)
                    tabSiswa.classList.remove('bg-[#E31837]', 'text-white', 'shadow-md');
                    tabSiswa.classList.add('bg-white', 'border-2', 'border-gray-200', 'text-gray-900');
                    
                    // Update input untuk Email
                    emailInput.placeholder = 'email@smktelkom-pwt.sch.id';
                    emailInput.type = 'email';
                    emailInput.removeAttribute('pattern');
                    if (emailLabel) emailLabel.textContent = 'Email';
                }
            }

            // Initialize with siswa tab active
            setActiveTab('siswa');

            tabSiswa.addEventListener('click', function() { setActiveTab('siswa'); });
            tabGuru.addEventListener('click', function() { setActiveTab('guru'); });
        });
    </script>
    </div>
</body>
</html>