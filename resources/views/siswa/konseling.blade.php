<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konseling - PSAJ</title>
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
                    <a href="{{ route('siswa.konseling') }}" class="text-blue-600 hover:text-blue-800 font-medium border-b-2 border-blue-600">Konseling</a>
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Form Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Layanan Konseling</h1>
                    <p class="text-gray-600 mb-8">Pilih guru BK, lihat jadwalnya, dan pesan sesi konseling</p>

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <p class="text-red-800 font-semibold mb-2">Terjadi Kesalahan:</p>
                            <ul class="list-disc list-inside text-red-700 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <p class="text-green-800">{{ session('success') }}</p>
                        </div>
                    @endif

                    <!-- Step 1: Pilih Guru -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Langkah 1: Pilih Guru BK</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse($gurus as $guru)
                                <button type="button" 
                                    onclick="selectGuru({{ $guru->id }}, '{{ $guru->nama }}')"
                                    class="guru-card p-4 border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:shadow-lg transition text-left"
                                    data-guru-id="{{ $guru->id }}">
                                    <h3 class="font-semibold text-gray-800">{{ $guru->nama }}</h3>
                                    <p class="text-sm text-gray-600">{{ $guru->nip ?? 'NIP Tidak Tersedia' }}</p>
                                    <p class="text-xs text-gray-500 mt-2">{{ $guru->jadwals->count() }} jadwal tersedia</p>
                                </button>
                            @empty
                                <p class="text-gray-500">Tidak ada guru BK tersedia</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Step 2: Form Booking -->
                    <form action="{{ route('siswa.konseling.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Selected Guru (Hidden) -->
                        <input type="hidden" id="selected_guru_id" value="{{ old('jadwal_id') ? \App\Models\Jadwal::find(old('jadwal_id'))->guru_id : '' }}">
                        <input type="hidden" id="selected_guru_name" value="">

                        <!-- Guru yang dipilih -->
                        <div id="selected-guru-info" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                            <p class="text-sm text-blue-600">
                                <span class="font-semibold">Guru BK dipilih:</span> 
                                <span id="guru-name-display"></span>
                                <button type="button" onclick="unselectGuru()" class="ml-2 text-blue-600 underline hover:text-blue-800 text-xs">Ubah</button>
                            </p>
                        </div>

                        <!-- Pilih Jadwal (Dinamis) -->
                        <div id="jadwal-section" class="hidden">
                            <label for="jadwal_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilih Jadwal Konseling <span class="text-red-500">*</span>
                            </label>
                            <select id="jadwal_id" name="jadwal_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jadwal_id') border-red-500 @enderror">
                                <option value="">-- Pilih Jadwal --</option>
                            </select>
                            @error('jadwal_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pilih Topik -->
                        <div id="topik-section" class="hidden">
                            <label for="topik_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pilih Topik <span class="text-red-500">*</span>
                            </label>
                            <select id="topik_id" name="topik_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('topik_id') border-red-500 @enderror">
                                <option value="">-- Pilih Topik --</option>
                                @foreach ($topiks as $topik)
                                    <option value="{{ $topik->id }}" @selected(old('topik_id') == $topik->id)>
                                        {{ $topik->nama_topik }}
                                    </option>
                                @endforeach
                            </select>
                            @error('topik_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div id="deskripsi-section" class="hidden">
                            <label for="catatan_siswa" class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Masalah <span class="text-red-500">*</span>
                            </label>
                            <textarea id="catatan_siswa" name="catatan_siswa" rows="6"
                                placeholder="Jelaskan masalah atau topik yang ingin Anda diskusikan dengan guru BK..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('catatan_siswa') border-red-500 @enderror">{{ old('catatan_siswa') }}</textarea>
                            @error('catatan_siswa')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex gap-4" id="button-section" style="display: none;">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                                Pesan Konseling
                            </button>
                            <a href="{{ route('siswa.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-300">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Section -->
            <div>
                <div class="bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-lg p-6 border border-indigo-200 mb-6">
                    <h3 class="text-lg font-semibold text-indigo-900 mb-3">ℹ️ Informasi Penting</h3>
                    <ul class="text-indigo-700 text-sm space-y-2">
                        <li>✓ Pilih guru BK yang Anda inginkan</li>
                        <li>✓ Lihat jadwal tersedia guru BK</li>
                        <li>✓ Pilih jadwal dan topik yang sesuai</li>
                        <li>✓ Jelaskan masalah Anda secara detail</li>
                        <li>✓ Tunggu konfirmasi dari guru BK</li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg p-6 border border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">📞 Kontak Kami</h3>
                    <p class="text-blue-700 text-sm mb-4">Jika ada pertanyaan, hubungi guru BK di sekolah atau melalui sistem ini.</p>
                    <div class="text-sm text-blue-700">
                        <p class="font-semibold">Jam Layanan:</p>
                        <p>Senin - Jumat: 08:00 - 15:00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectGuru(guruId, guruName) {
            // Set hidden inputs
            document.getElementById('selected_guru_id').value = guruId;
            document.getElementById('selected_guru_name').value = guruName;
            
            // Show selected guru info
            document.getElementById('selected-guru-info').classList.remove('hidden');
            document.getElementById('guru-name-display').textContent = guruName;
            
            // Show form sections
            document.getElementById('jadwal-section').classList.remove('hidden');
            document.getElementById('topik-section').classList.remove('hidden');
            document.getElementById('deskripsi-section').classList.remove('hidden');
            document.getElementById('button-section').style.display = 'flex';
            
            // Highlight selected guru card
            document.querySelectorAll('.guru-card').forEach(card => {
                card.classList.remove('border-blue-500', 'bg-blue-50');
                card.classList.add('border-gray-200');
            });
            document.querySelector(`[data-guru-id="${guruId}"]`).classList.add('border-blue-500', 'bg-blue-50');
            
            // Fetch jadwal untuk guru
            fetchGuruJadwals(guruId);
            
            // Scroll to form
            setTimeout(() => {
                document.getElementById('jadwal-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }

        function unselectGuru() {
            document.getElementById('selected_guru_id').value = '';
            document.getElementById('selected_guru_name').value = '';
            document.getElementById('selected-guru-info').classList.add('hidden');
            document.getElementById('jadwal-section').classList.add('hidden');
            document.getElementById('topik-section').classList.add('hidden');
            document.getElementById('deskripsi-section').classList.add('hidden');
            document.getElementById('button-section').style.display = 'none';
            
            // Reset guru card selection
            document.querySelectorAll('.guru-card').forEach(card => {
                card.classList.remove('border-blue-500', 'bg-blue-50');
                card.classList.add('border-gray-200');
            });
            
            // Clear jadwal select
            document.getElementById('jadwal_id').innerHTML = '<option value="">-- Pilih Jadwal --</option>';
        }

        function fetchGuruJadwals(guruId) {
            const jadwalSelect = document.getElementById('jadwal_id');
            
            // Show loading state
            jadwalSelect.innerHTML = '<option value="">Memuat jadwal...</option>';
            
            fetch(`{{ url('/api/guru') }}/${guruId}/jadwals`)
                .then(response => response.json())
                .then(data => {
                    jadwalSelect.innerHTML = '<option value="">-- Pilih Jadwal --</option>';
                    
                    if (data.jadwals && data.jadwals.length > 0) {
                        data.jadwals.forEach(jadwal => {
                            const option = document.createElement('option');
                            option.value = jadwal.id;
                            option.textContent = `${getHariName(jadwal.hari)} (${jadwal.jam_mulai} - ${jadwal.jam_selesai})`;
                            jadwalSelect.appendChild(option);
                        });
                    } else {
                        jadwalSelect.innerHTML = '<option value="">Tidak ada jadwal tersedia</option>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    jadwalSelect.innerHTML = '<option value="">Error memuat jadwal</option>';
                });
        }

        function getHariName(hari) {
            const days = {
                'senin': 'Senin',
                'selasa': 'Selasa',
                'rabu': 'Rabu',
                'kamis': 'Kamis',
                'jumat': 'Jumat',
                'sabtu': 'Sabtu',
                'minggu': 'Minggu'
            };
            return days[hari.toLowerCase()] || hari;
        }

        // Jika ada guru yang sudah dipilih sebelumnya (dari validation error)
        window.addEventListener('load', () => {
            const selectedGuruId = document.getElementById('selected_guru_id').value;
            if (selectedGuruId) {
                const guruCard = document.querySelector(`[data-guru-id="${selectedGuruId}"]`);
                if (guruCard) {
                    const guruName = guruCard.querySelector('h3').textContent;
                    selectGuru(selectedGuruId, guruName);
                }
            }
        });
    </script>
</body>
</html>
