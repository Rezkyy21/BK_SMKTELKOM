<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SMK Telkom Purwokerto</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-screen overflow-hidden">
<div class="flex h-screen">

    {{-- BAGIAN KIRI (GAMBAR) --}}
    <div class="hidden lg:flex lg:flex-1 lg:min-h-screen relative overflow-hidden">

        <div class="absolute inset-0">
            <img src="{{ asset('images/bglogin.png') }}"
                 alt="SMK Telkom Purwokerto"
                 class="w-full h-full object-cover"
                 style="object-position:80% center;">

            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/20 to-black/70"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-end w-full p-12">
            <div class="text-white/90">
                <p class="text-sm">Sistem Bimbingan Konseling</p>
                <p class="text-xs mt-1">SMK Telkom Purwokerto</p>
            </div>
        </div>

    </div>


    {{-- BAGIAN KANAN (FORM RESET PASSWORD) --}}
    <div class="flex-1 flex flex-col justify-center px-6 py-12 lg:px-12 bg-white">

        <div class="w-full max-w-md mx-auto">

            {{-- Judul --}}
            <h1 class="text-4xl font-bold text-gray-900 mb-8">
                Reset Password
            </h1>

            {{-- Form --}}
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                {{-- Token Reset --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>

                    <input id="email"
                           name="email"
                           type="email"
                           value="{{ old('email', $request->email) }}"
                           required autofocus
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 placeholder:text-gray-400 focus:border-[#E31837] focus:ring-1 focus:ring-[#E31837] focus:bg-white transition">

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>


                {{-- Password Baru --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password Baru
                    </label>

                    <input id="password"
                           name="password"
                           type="password"
                           required
                           autocomplete="new-password"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 placeholder:text-gray-400 focus:border-[#E31837] focus:ring-1 focus:ring-[#E31837] focus:bg-white transition">

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>


                {{-- Konfirmasi Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>

                    <input id="password_confirmation"
                           name="password_confirmation"
                           type="password"
                           required
                           autocomplete="new-password"
                           class="block w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3.5 text-gray-900 placeholder:text-gray-400 focus:border-[#E31837] focus:ring-1 focus:ring-[#E31837] focus:bg-white transition">

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>


                {{-- Tombol Reset --}}
                <button type="submit"
                        class="w-full flex justify-center rounded-full bg-[#E31837] px-4 py-3.5 text-base font-semibold text-white shadow-lg hover:bg-[#c41230] focus:outline-none focus:ring-2 focus:ring-[#E31837] focus:ring-offset-2 transition-all">
                    Reset Password
                </button>

            </form>

        </div>
    </div>

</div>
</body>
</html>