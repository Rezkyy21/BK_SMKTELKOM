<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Topik;
use App\Models\Booking;
use App\Models\KategoriMateri;
use App\Models\Materi;
use App\Models\GuruBk;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SiswaController extends Controller
{
    /**
     * Display the siswa dashboard.
     */
    public function dashboard()
    {
        // load authenticated user if available (guests can still view dashboard)
        $user = auth()->check() ? auth()->user()->load(['careerPlan', 'classRoom']) : null;
        $gurus = GuruBK::all();

        return view('siswa.dashboard', compact('user', 'gurus'));
    }

    /**
     * Display the karir page.
     */
    public function karir()
    {
        // load user if authenticated
        $user = auth()->check() ? auth()->user()->load(['careerPlan', 'classRoom', 'major']) : null;
        
        $kategori = KategoriMateri::where('slug', 'karir')->first();
        $materis = $kategori ? Materi::where('kategori_id', $kategori->id)->where('status', 'publish')->get() : collect();
        return view('siswa.karir', compact('materis', 'user'));
    }

    /**
     * Display the belajar page.
     */
    public function belajar()
    {
        $kategori = KategoriMateri::where('slug', 'belajar')->first();
        $materis = $kategori ? Materi::where('kategori_id', $kategori->id)->where('status', 'publish')->get() : collect();
        return view('siswa.belajar', compact('materis'));
    }

    /**
     * Display the pribadi page.
     */
    public function pribadi()
    {
        $kategori = KategoriMateri::where('slug', 'pribadi')->first();
        $materis = $kategori ? Materi::where('kategori_id', $kategori->id)->where('status', 'publish')->get() : collect();
        return view('siswa.pribadi', compact('materis'));
    }

    /**
     * Display the sosial page.
     */
    public function sosial()
    {
        $kategori = KategoriMateri::where('slug', 'sosial')->first();
        $materis = $kategori ? Materi::where('kategori_id', $kategori->id)->where('status', 'publish')->get() : collect();
        return view('siswa.sosial', compact('materis'));
    }

    /**
     * Display the konseling page with available guru BK and topik.
     */
   public function konseling()
{
    
    if (!auth()->check()) {
        return redirect()->route('login')->with('info', 'Silakan login untuk mengakses layanan konseling.');
    }

  $recommendedGuru = null;
  $student = auth()->user()->siswa;

  // Recommended guru: guru yang mengajar kelas siswa (jika ada)
  // Tidak perlu punya jadwal aktif untuk ditampilkan
  if ($student && $student->classRoom && $student->classRoom->guru_id) {
      $recommendedGuru = GuruBk::with(['jadwals' => function($q) {
          $q->where('is_active', true);
      }])
      ->where('status', 'aktif')
      ->find($student->classRoom->guru_id);
  }

  // Tampilkan SEMUA gurus yang aktif (baik punya jadwal atau tidak)
  $otherGurus = GuruBk::where('status', 'aktif')
      ->with(['jadwals' => function($q) {
          $q->where('is_active', true);
      }])
      ->when($recommendedGuru, fn($q) => $q->where('id', '!=', $recommendedGuru->id))
      ->get();

  // Add classes_json to recommended guru if exists
  if ($recommendedGuru) {
      $recommendedGuru->classes_json = $recommendedGuru->classRooms->map(function ($c) {
          return [
              'id' => $c->id,
              'grade_level' => $c->grade_level,
              'name' => $c->name,
              'major' => $c->major ? $c->major->name : ''
          ];
      });
  }

  $otherGurus = $otherGurus->map(function ($guru) {
      $guru->classes_json = $guru->classRooms->map(function ($c) {
          return [
              'id' => $c->id,
              'grade_level' => $c->grade_level,
              'name' => $c->name,
              'major' => $c->major ? $c->major->name : ''
          ];
      });
      return $guru;
  });

    $topiks = Topik::all();
    $classRooms = ClassRoom::with('major')->get();
    $studentClass = auth()->user()->siswa->classRoom ?? null;

    return view('siswa.konseling', compact('recommendedGuru', 'otherGurus', 'topiks', 'classRooms', 'studentClass'));
   
}

    /**
     * Get jadwal for a specific guru dengan slot tanggal (7 hari ke depan).
     * Supports multiple slots per day per guru.
     */
    public function getGuruJadwals($guruId): JsonResponse
    {
        \Carbon\Carbon::setLocale('id');
        
        // Get active jadwal for the guru
        $jadwals = Jadwal::where('guru_id', $guruId)
            ->where('is_active', true)
            ->orderBy('hari')
            ->orderBy('jam_mulai')
            ->get();

        $slots = [];
        $startDate = now()->startOfDay();
        $endDate = $startDate->copy()->addDays(6); // 7 days: today to today+6

        foreach ($jadwals as $jadwal) {
            $date = $startDate->copy();
            // Find dates within 7-day window that match this jadwal's day
            while ($date->lte($endDate)) {
                if (strtolower($date->englishDayOfWeek) === $this->hariToEnglish($jadwal->hari)) {
                    // Calculate remaining kuota
                    $bookedCount = Booking::where('jadwal_id', $jadwal->id)
                        ->where('tanggal', $date->format('Y-m-d'))
                        ->whereIn('status', ['menunggu', 'disetujui'])
                        ->count();
                    
                    $remainingKuota = max(0, $jadwal->kuota - $bookedCount);

                    $jamMulai = is_string($jadwal->jam_mulai) ? $jadwal->jam_mulai : $jadwal->jam_mulai->format('H:i');
                    $jamSelesai = is_string($jadwal->jam_selesai) ? $jadwal->jam_selesai : $jadwal->jam_selesai->format('H:i');

                    $slots[] = [
                        'id' => $jadwal->id,
                        'jadwal_id' => $jadwal->id,
                        'hari' => $jadwal->hari,
                        'jam_mulai' => $jamMulai,
                        'jam_selesai' => $jamSelesai,
                        'tanggal' => $date->format('Y-m-d'),
                        'tanggal_label' => $date->translatedFormat('l, d F Y'),
                        'waktu_label' => substr($jamMulai, 0, 5) . ' - ' . substr($jamSelesai, 0, 5),
                        'kuota' => $remainingKuota,
                        'kuota_total' => $jadwal->kuota,
                    ];
                    
                    break; // One occurrence per jadwal per 7-day window
                }
                $date->addDay();
            }
        }

        // Sort by date and time
        usort($slots, function ($a, $b) {
            $dateCompare = strcmp($a['tanggal'], $b['tanggal']);
            if ($dateCompare !== 0) return $dateCompare;
            return strcmp($a['jam_mulai'], $b['jam_mulai']);
        });

        return response()->json([
            'success' => true,
            'jadwals' => $jadwals,
            'slots' => $slots,
        ]);
    }

    /**
     * Helper method to convert Indonesian day names to English day names.
     */
    private function hariToEnglish(string $hari): string
    {
        return match(strtolower($hari)) {
            'senin'  => 'monday',
            'selasa' => 'tuesday',
            'rabu'   => 'wednesday',
            'kamis'  => 'thursday',
            'jumat'  => 'friday',
            'sabtu'  => 'saturday',
            'minggu' => 'sunday',
            default  => $hari,
        };
    }

    /**
     * Store the konseling booking.
     */
    public function storeKonseling(Request $request)
{
    $user = auth()->user();

    // Check for existing active booking
    $existingBooking = Booking::where('siswa_id', $user->siswa->id)
        ->whereIn('status', ['menunggu', 'disetujui'])
        ->first();

    if ($existingBooking) {
        return back()->with('error', 'Kamu masih memiliki booking yang aktif. Selesaikan atau tunggu konfirmasi sebelum membuat booking baru.');
    }

    // 1️⃣ Validasi input dasar
    $validated = $request->validate([
        'jadwal_id' => 'required|exists:jadwal,id',
        'tanggal' => 'required|date|after_or_equal:today',
        'tipe_konseling' => 'required|in:individu,kelompok',
        'topik_id' => 'required|exists:topik,id',
        'catatan_siswa' => 'required|string|min:10|max:1000',
        'guru_id' => 'required|exists:guru_bk,id', // wajib kirim guru_id dari frontend
        'class_id' => 'required|exists:classes,id'
    ], [
        'jadwal_id.required' => 'Pilih jadwal konseling terlebih dahulu',
        'jadwal_id.exists' => 'Jadwal yang dipilih tidak ditemukan',
        'tanggal.required' => 'Tanggal konseling wajib dipilih',
        'tanggal.after_or_equal' => 'Tanggal harus hari ini atau setelahnya',
        'tipe_konseling.required' => 'Pilih tipe konseling (Individu atau Kelompok)',
        'tipe_konseling.in' => 'Tipe konseling tidak valid',
        'topik_id.required' => 'Pilih topik terlebih dahulu',
        'topik_id.exists' => 'Topik yang dipilih tidak ditemukan',
        'catatan_siswa.required' => 'Deskripsi masalah tidak boleh kosong',
        'catatan_siswa.min' => 'Deskripsi minimal 10 karakter',
        'catatan_siswa.max' => 'Deskripsi maksimal 1000 karakter',
        'guru_id.required' => 'Guru BK wajib dipilih',
        'guru_id.exists' => 'Guru BK tidak ditemukan',
        'class_id.required' => 'Kelas wajib dipilih',
        'class_id.exists' => 'Kelas tidak ditemukan',
    ]);

    // 2️⃣ Ambil jadwal
    $jadwal = Jadwal::find($validated['jadwal_id']);
    if (!$jadwal) {
        return back()->withErrors(['jadwal_id' => 'Jadwal tidak ditemukan.']);
    }

    // 3️⃣ Pastikan jadwal sesuai guru yang dipilih
    if ($jadwal->guru_id != $validated['guru_id']) {
        return back()->withErrors(['jadwal_id' => 'Jadwal tidak sesuai dengan guru yang dipilih.']);
    }

    
    // 4️⃣ Ambil user & siswa
    $user = auth()->user();
    $siswa = $user->siswa;
    $kelasSiswa = $siswa->classRoom;

    // 5️⃣ Ambil kelas & format
    $kelas = \App\Models\ClassRoom::with('major')
        ->find($request->class_id);
    $formatKelas = $kelas?->full_name ?? '-';

    // 6️⃣ Buat booking
    Booking::create([
        'jadwal_id' => $validated['jadwal_id'],
        'tanggal' => $validated['tanggal'],
        'siswa_id' => $siswa->id,
        'topik_id' => $validated['topik_id'],
        'tipe_konseling' => $validated['tipe_konseling'],
        'catatan_siswa' => $validated['catatan_siswa'],
        'kelas' => $formatKelas,
        'status' => 'menunggu',
        'mode_konseling' => 'offline',
        'mode_identitas' => 'asli',
    ]);

    return redirect()->route('siswa.konseling')
    ->with('success', 'Permintaan konseling Anda telah dikirim. Tunggu konfirmasi dari guru BK.');
    
    }
}
