<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Konseling - SMK Telkom Purwokerto</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-[#E31837] rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-sm">S</span>
                    </div>
                    <span class="font-semibold text-gray-800">SMK Telkom Purwokerto</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('siswa.dashboard') }}" class="text-gray-700 hover:text-gray-900 font-medium">Home</a>
                    <a href="{{ route('siswa.karir') }}" class="text-gray-700 hover:text-gray-900 font-medium">Karir</a>
                    <a href="{{ route('siswa.belajar') }}" class="text-gray-700 hover:text-gray-900 font-medium">Belajar</a>
                    <a href="{{ route('siswa.pribadi') }}" class="text-gray-700 hover:text-gray-900 font-medium">Pribadi</a>
                    <a href="{{ route('siswa.sosial') }}" class="text-gray-700 hover:text-gray-900 font-medium">Sosial</a>
                    <a href="{{ route('siswa.konseling') }}" class="text-[#E31837] font-medium border-b-2 border-[#E31837]">Konseling</a>
                </div>
                <div class="relative group">
                    <button class="text-gray-700 hover:text-gray-900 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </button>
                    <div class="absolute right-0 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50 border">
                        <div class="px-4 py-3 border-b"><p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p><p class="text-xs text-gray-500">{{ auth()->user()->email }}</p></div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="block">@csrf<button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">Logout</button></form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 sm:p-8">
                <h1 class="text-2xl font-bold text-gray-800 mb-1">Layanan Konseling</h1>
                <p class="text-gray-600 mb-6">Pilih guru BK, lihat jadwal yang dibuat guru, lalu atur jadwal konseling Anda.</p>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <ul class="list-disc list-inside text-red-700 text-sm">
                            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 text-green-800">{{ session('success') }}</div>
                @endif

                <!-- Langkah 1: Pilih Guru BK -->
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Pilih Guru BK</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 mb-8">
                    @forelse($gurus as $guru)
                        <button type="button"
                                onclick="pilihGuru({{ $guru->id }}, '{{ addslashes($guru->nama) }}')"
                                class="guru-btn p-4 border-2 rounded-xl text-left transition"
                                data-guru-id="{{ $guru->id }}">
                            <h3 class="font-semibold text-gray-800">{{ $guru->nama }}</h3>
                            <p class="text-sm text-gray-500">{{ $guru->nip ?? '-' }}</p>
                        </button>
                    @empty
                        <p class="text-gray-500 col-span-full">Tidak ada guru BK tersedia.</p>
                    @endforelse
                </div>

                <!-- Tabel Jadwal (muncul setelah pilih guru) -->
                <div id="jadwal-wrap" class="hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Jadwal <span id="guru-label"></span></h2>
                        <button type="button" onclick="batalPilihGuru()" class="text-sm text-gray-500 hover:text-gray-700">Ganti guru</button>
                    </div>
                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Hari, Tanggal</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Waktu</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Atur Konseling</th>
                                </tr>
                            </thead>
                            <tbody id="jadwal-body" class="divide-y divide-gray-200">
                            </tbody>
                        </table>
                    </div>
                    <p id="jadwal-kosong" class="hidden py-4 text-gray-500 text-sm">Belum ada jadwal untuk guru ini.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Atur: Pilih Kelompok / Individu -->
    <div id="modal-tipe" class="fixed inset-0 bg-black/50 z-40 hidden items-center justify-center p-4" onclick="if(event.target===this) tutupModalTipe()">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6" onclick="event.stopPropagation()">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Tipe Konseling</h3>
            <p class="text-sm text-gray-600 mb-4">Pilih jenis konseling yang Anda inginkan.</p>
            <div class="flex gap-3">
                <button type="button" onclick="pilihTipe('individu')" class="flex-1 py-3 px-4 rounded-xl border-2 border-gray-200 hover:border-[#E31837] hover:bg-red-50 font-medium text-gray-700 transition">Individu</button>
                <button type="button" onclick="pilihTipe('kelompok')" class="flex-1 py-3 px-4 rounded-xl border-2 border-gray-200 hover:border-[#E31837] hover:bg-red-50 font-medium text-gray-700 transition">Kelompok</button>
            </div>
            <button type="button" onclick="tutupModalTipe()" class="mt-4 w-full py-2 text-gray-500 text-sm">Batal</button>
        </div>
    </div>

    <!-- Modal Form: Nama, Kelas, Topik, Masalah -->
    <div id="modal-form" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4 overflow-y-auto" onclick="if(event.target===this) tutupModalForm()">
        <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full my-8 p-6" onclick="event.stopPropagation()">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Form Booking Konseling</h3>

            <form id="form-booking" action="{{ route('siswa.konseling.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="jadwal_id" id="form_jadwal_id">
                <input type="hidden" name="tanggal" id="form_tanggal">
                <input type="hidden" name="tipe_konseling" id="form_tipe_konseling">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" value="{{ auth()->user()->siswa->nama ?? auth()->user()->name ?? '' }}" readonly class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                    <select id="form_kelas" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E31837] focus:border-[#E31837]">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach(['X-A','X-B','X-C','XI-A','XI-B','XI-C','XII-A','XII-B','XII-C'] as $k)
                            <option value="{{ $k }}" @selected((auth()->user()->siswa->kelas ?? '') === $k)>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Topik <span class="text-red-500">*</span></label>
                    <select name="topik_id" id="form_topik_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E31837] focus:border-[#E31837]" required>
                        <option value="">-- Pilih Topik --</option>
                        @foreach ($topiks as $topik)
                            <option value="{{ $topik->id }}">{{ $topik->nama_topik }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Masalah / hal yang ingin dibicarakan <span class="text-red-500">*</span></label>
                    <textarea name="catatan_siswa" id="form_catatan" rows="4" placeholder="Jelaskan masalah atau topik yang ingin didiskusikan dengan guru BK..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#E31837] focus:border-[#E31837]" required minlength="10" maxlength="1000"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Min. 10 karakter</p>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" class="flex-1 py-2.5 rounded-xl bg-[#E31837] text-white font-medium hover:bg-[#c41230] transition">Kirim Permintaan</button>
                    <button type="button" onclick="tutupModalForm()" class="px-4 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let selectedGuruId = null;
        let selectedGuruName = '';
        let slots = [];

        function pilihGuru(guruId, guruName) {
            selectedGuruId = guruId;
            selectedGuruName = guruName;
            document.querySelectorAll('.guru-btn').forEach(btn => {
                btn.classList.remove('border-[#E31837]', 'bg-red-50');
                btn.classList.add('border-gray-200');
            });
            document.querySelector('[data-guru-id="' + guruId + '"]').classList.add('border-[#E31837]', 'bg-red-50');
            document.getElementById('guru-label').textContent = guruName;
            document.getElementById('jadwal-wrap').classList.remove('hidden');
            document.getElementById('jadwal-wrap').classList.add('block');
            loadJadwal(guruId);
        }

        function batalPilihGuru() {
            selectedGuruId = null;
            selectedGuruName = '';
            document.querySelectorAll('.guru-btn').forEach(btn => { btn.classList.remove('border-[#E31837]', 'bg-red-50'); btn.classList.add('border-gray-200'); });
            document.getElementById('jadwal-wrap').classList.add('hidden');
        }

        function loadJadwal(guruId) {
            const tbody = document.getElementById('jadwal-body');
            const kosong = document.getElementById('jadwal-kosong');
            tbody.innerHTML = '<tr><td colspan="3" class="px-4 py-8 text-center text-gray-500">Memuat jadwal...</td></tr>';
            kosong.classList.add('hidden');

            fetch('{{ url("/api/guru") }}/' + guruId + '/jadwals')
                .then(r => r.json())
                .then(data => {
                    slots = data.slots || [];
                    tbody.innerHTML = '';
                    if (slots.length === 0) {
                        kosong.classList.remove('hidden');
                        return;
                    }
                    slots.forEach(slot => {
                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-gray-50';
                        tr.innerHTML =
                            '<td class="px-4 py-3 text-sm text-gray-800">' + slot.tanggal_label + '</td>' +
                            '<td class="px-4 py-3 text-sm text-gray-600">' + slot.waktu_label + '</td>' +
                            '<td class="px-4 py-3 text-right"><button type="button" onclick="bukaAtur(' + slot.jadwal_id + ',\'' + slot.tanggal + '\')" class="px-4 py-2 rounded-lg bg-blue-100 text-blue-700 hover:bg-blue-200 text-sm font-medium">Atur</button></td>';
                        tbody.appendChild(tr);
                    });
                })
                .catch(() => {
                    tbody.innerHTML = '<tr><td colspan="3" class="px-4 py-8 text-center text-red-500">Gagal memuat jadwal.</td></tr>';
                });
        }

        function bukaAtur(jadwalId, tanggal) {
            document.getElementById('form_jadwal_id').value = jadwalId;
            document.getElementById('form_tanggal').value = tanggal;
            document.getElementById('modal-tipe').classList.remove('hidden');
            document.getElementById('modal-tipe').classList.add('flex');
        }

        function pilihTipe(tipe) {
            document.getElementById('form_tipe_konseling').value = tipe;
            document.getElementById('modal-tipe').classList.add('hidden');
            document.getElementById('modal-tipe').classList.remove('flex');
            document.getElementById('modal-form').classList.remove('hidden');
            document.getElementById('modal-form').classList.add('flex');
        }

        function tutupModalTipe() {
            document.getElementById('modal-tipe').classList.add('hidden');
            document.getElementById('modal-tipe').classList.remove('flex');
        }

        function tutupModalForm() {
            document.getElementById('modal-form').classList.add('hidden');
            document.getElementById('modal-form').classList.remove('flex');
        }
    </script>
</body>
</html>
