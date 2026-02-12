<x-login-split-layout>
    {{-- Bagian kiri: branding --}}
    <div class="hidden lg:flex lg:flex-1 lg:min-h-screen bg-gradient-to-br from-[#E31837] via-[#c41230] to-[#9e0e26] relative overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center p-12">
            <div class="text-white/95 text-center max-w-md">
                <h2 class="text-3xl font-bold tracking-tight">Telkom Schools</h2>
                <p class="text-2xl font-semibold mt-1">SMK Telkom</p>
                <p class="mt-6 text-white/90 text-sm">Daftar akun siswa untuk akses Bimbingan Konseling</p>
            </div>
        </div>
    </div>

    {{-- Bagian kanan: form register --}}
    <div class="flex-1 flex flex-col justify-center px-6 py-8 lg:px-8 bg-white w-full max-w-md mx-auto lg:mx-0 lg:max-w-lg overflow-y-auto">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h1 class="text-2xl font-bold text-gray-900">Daftar Akun</h1>
            <p class="mt-1 text-sm text-gray-500">BK SMK Telkom Purwokerto</p>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="nama" name="nama" type="text" value="{{ old('nama') }}"
                           class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900"
                           placeholder="Nama lengkap"
                           required autofocus autocomplete="name">
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Sekolah</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}"
                           class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900"
                           placeholder="NIS@student.smktelkom-pwt.sch.id"
                           required autocomplete="username">
                    <p class="mt-1 text-xs text-gray-500">Gunakan email sekolah (NIS@...). NIS akan disimpan otomatis.</p>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select id="kelas" name="kelas" required
                            class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900">
                        <option value="">-- Pilih Kelas --</option>
                        <option value="X-A" @selected(old('kelas') == 'X-A')>X-A</option>
                        <option value="X-B" @selected(old('kelas') == 'X-B')>X-B</option>
                        <option value="X-C" @selected(old('kelas') == 'X-C')>X-C</option>
                        <option value="XI-A" @selected(old('kelas') == 'XI-A')>XI-A</option>
                        <option value="XI-B" @selected(old('kelas') == 'XI-B')>XI-B</option>
                        <option value="XI-C" @selected(old('kelas') == 'XI-C')>XI-C</option>
                        <option value="XII-A" @selected(old('kelas') == 'XII-A')>XII-A</option>
                        <option value="XII-B" @selected(old('kelas') == 'XII-B')>XII-B</option>
                        <option value="XII-C" @selected(old('kelas') == 'XII-C')>XII-C</option>
                    </select>
                    <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                </div>

                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin"
                            class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900">
                        <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                        <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password"
                           class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900"
                           placeholder="Min. 8 karakter"
                           required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900"
                           placeholder="Ulangi password"
                           required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-1">
                    <button type="submit"
                            class="w-full flex justify-center rounded-xl bg-[#E31837] px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-[#c41230] focus:outline-none focus:ring-2 focus:ring-[#E31837] focus:ring-offset-2 transition">
                        Daftar
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-[#E31837] hover:text-[#c41230] transition">
                    Masuk
                </a>
            </p>
        </div>
    </div>
</x-login-split-layout>
