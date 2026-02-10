<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nama -->
        <div>
            <x-input-label for="nama" :value="__('Nama Lengkap')" />
            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
        </div>

        <!-- Email Address (NIS@student.smktelkom-pwt.sch.id) -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email (NIS@student.smktelkom-pwt.sch.id)')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="202400001@student.smktelkom-pwt.sch.id" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Kelas -->
        <div class="mt-4">
            <x-input-label for="kelas" :value="__('Kelas')" />
            <select id="kelas" name="kelas" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
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

        <!-- Jenis Kelamin -->
        <div class="mt-4">
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="L" @selected(old('jenis_kelamin') == 'L')>Laki-laki</option>
                <option value="P" @selected(old('jenis_kelamin') == 'P')>Perempuan</option>
            </select>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <textarea id="alamat" name="alamat" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="3">{{ old('alamat') }}</textarea>
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
