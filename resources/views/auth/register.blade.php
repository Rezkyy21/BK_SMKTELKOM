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

                <!-- Jurusan (Major) -->
                <div>
                    <label for="major_id" class="block text-sm font-medium text-gray-700">Jurusan <span class="text-red-500">*</span></label>
                    <select id="major_id" name="major_id" required
                            class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900"
                            onchange="updateClasses()">
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($majors ?? [] as $major)
                            <option value="{{ $major->id }}" @selected(old('major_id') == $major->id)>
                                {{ $major->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('major_id')" class="mt-2" />
                </div>

                <!-- Kelas (Class) -->
                <div>
                    <label for="class_id" class="block text-sm font-medium text-gray-700">Kelas <span class="text-red-500">*</span></label>
                    <select id="class_id" name="class_id" 
                            class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900">
                        <option value="">-- Pilih Kelas --</option>
                        @if(old('major_id'))
                            @foreach($classes->where('major_id', old('major_id'))->where('academic_year_id', $activeYear->id ?? null) ?? [] as $class)
                                <option value="{{ $class->id }}" @selected(old('class_id') == $class->id)>
                                    Kelas {{ $class->grade_level }} - {{ $class->name }}
                                </option>
                            @endforeach 
                        @endif
                    </select>

                    <!-- input manual saat tidak ada pilihan kelas -->
                    <input id="class_manual" name="class_manual" type="text" value="{{ old('class_manual') }}"
                           class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900 hidden"
                           placeholder="Ketik nama kelas jika tidak tersedia">

                    <small class="text-gray-500">Pilih jurusan terlebih dahulu atau ketik nama kelas jika tidak tersedia</small>
                    <x-input-error :messages="$errors->get('class_id')" class="mt-2" />
                    <x-input-error :messages="$errors->get('class_manual')" class="mt-2" />
                </div>

                <!-- Tahun Masuk -->
                <div>
                    <label for="tahun_masuk" class="block text-sm font-medium text-gray-700">Tahun Masuk <span class="text-red-500">*</span></label>
                    <input id="tahun_masuk" name="tahun_masuk" type="number" value="{{ old('tahun_masuk', now()->year) }}"
                           min="2020" max="{{ now()->year }}"
                           class="mt-1 block w-full rounded-xl border-gray-300 bg-gray-50 shadow-sm focus:border-[#E31837] focus:ring-[#E31837] text-gray-900"
                           placeholder="Tahun masuk (misal: 2024)"
                           required>
                    <x-input-error :messages="$errors->get('tahun_masuk')" class="mt-2" />
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

<script>
    // Data semua classes (dari server-side)
    const allClasses = @json($classes ?? collect());
    const activeAcademicYearId = {!! json_encode($activeYear->id ?? null) !!};
    const activeAcademicYearName = {!! json_encode($activeYear->name ?? null) !!};

    console.log('All Classes:', allClasses);
    console.log('Active Academic Year ID:', activeAcademicYearId);
    console.log('Active Academic Year Name:', activeAcademicYearName);
    console.log('Total classes count:', allClasses.length);

    function updateClasses() {
        const majorId = document.getElementById('major_id').value;
        const classSelect = document.getElementById('class_id');
        const manualInput = document.getElementById('class_manual');
        
        console.log('updateClasses called with majorId:', majorId);
        
        // Reset visibility and options
        classSelect.innerHTML = '<option value="">-- Pilih Kelas --</option>';
        manualInput.classList.add('hidden');
        classSelect.classList.remove('hidden');
        
        if (!majorId) {
            document.querySelector('small.text-gray-500').textContent = 'Pilih jurusan terlebih dahulu';
            return;
        }
        
        // Filter classes berdasarkan major_id dan academic_year_id (relasi baru)
        const filteredClasses = allClasses.filter(c => {
            console.log('Comparing:', {c_major_id: c.major_id, majorId: majorId, c_academic_year_id: c.academic_year_id, activeAcademicYearId: activeAcademicYearId, match: c.major_id == majorId && String(c.academic_year_id) === String(activeAcademicYearId)});
            return c.major_id == majorId && String(c.academic_year_id) === String(activeAcademicYearId);
        });
        
        console.log('Filtered classes count:', filteredClasses.length);
        
        if (filteredClasses.length === 0) {
            // no existing class: hide select and show manual text field
            classSelect.classList.add('hidden');
            manualInput.classList.remove('hidden');
            document.querySelector('small.text-gray-500').textContent = 'Tidak ada kelas untuk jurusan ini, ketik manual';
            return;
        }
        
        // Add filtered classes
        filteredClasses.forEach(cls => {
            const option = document.createElement('option');
            option.value = cls.id;
            option.textContent = `Kelas ${cls.grade_level} - ${cls.name}`;
            classSelect.appendChild(option);
        });
        
        document.querySelector('small.text-gray-500').textContent = `Total ${filteredClasses.length} kelas tersedia`;
    }

    // When the page loads, if there was old input we should restore state
    document.addEventListener('DOMContentLoaded', () => {
        const majorSelect = document.getElementById('major_id');
        const manualInput = document.getElementById('class_manual');
        const classSelect = document.getElementById('class_id');
        
        if (majorSelect.value) {
            updateClasses();
            // if user previously entered manual name
            @if(old('class_manual'))
                manualInput.classList.remove('hidden');
                classSelect.classList.add('hidden');
            @elseif(old('class_id'))
                classSelect.value = "{{ old('class_id') }}";
            @endif
        }
    });
</script>
