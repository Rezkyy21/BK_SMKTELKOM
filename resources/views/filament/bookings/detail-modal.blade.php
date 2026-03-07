<div>
    <p><strong>Nama:</strong> {{ $booking->siswa?->nama ?? $booking->siswa?->user?->name }}</p>
    <p><strong>Kelas:</strong> {{ $booking->siswa?->kelas ?? $booking->siswa?->user?->classRoom?->name }}</p>
    <p><strong>Jurusan:</strong> {{ $booking->siswa?->user?->major?->name ?? '-' }}</p>
    <p><strong>Waktu:</strong> {{ $booking->jadwal?->jam_mulai ? substr($booking->jadwal->jam_mulai,0,5) . ' - ' . substr($booking->jadwal->jam_selesai,0,5) : '-' }}</p>
    <p><strong>Topik:</strong> {{ $booking->topik?->nama_topik ?? '-' }}</p>
    <p class="mt-3"><strong>Masalah:</strong></p>
    <p class="border p-2 rounded bg-gray-50">{{ $booking->catatan_siswa ?? '-' }}</p>
</div>