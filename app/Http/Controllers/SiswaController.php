<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Topik;
use App\Models\Booking;
use App\Models\KategoriMateri;
use App\Models\Materi;
use App\Models\GuruBk;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SiswaController extends Controller
{
    /**
     * Display the siswa dashboard.
     */
    public function dashboard()
    {
        return view('siswa.dashboard');
    }

    /**
     * Display the karir page.
     */
    public function karir()
    {
        $kategori = KategoriMateri::where('slug', 'karir')->first();
        $materis = $kategori ? Materi::where('kategori_id', $kategori->id)->where('status', 'publish')->get() : collect();
        return view('siswa.karir', compact('materis'));
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
        $gurus = GuruBk::with('jadwals')->get();
        $topiks = Topik::all();
        
        return view('siswa.konseling', compact('gurus', 'topiks'));
    }

    /**
     * Get jadwal for a specific guru dengan slot tanggal (2 minggu ke depan).
     */
    public function getGuruJadwals($guruId): JsonResponse
    {
        \Carbon\Carbon::setLocale('id');
        $jadwals = Jadwal::where('guru_id', $guruId)->where('is_active', true)->orderBy('hari')->orderBy('jam_mulai')->get();

        $hariMap = ['senin' => 1, 'selasa' => 2, 'rabu' => 3, 'kamis' => 4, 'jumat' => 5, 'sabtu' => 6];
        $slots = [];
        $start = now()->startOfDay();
        $end = now()->addWeeks(2);

        foreach ($jadwals as $j) {
            $dayOfWeek = $hariMap[strtolower($j->hari)] ?? 0;
            $current = $start->copy();
            $jamMulai = is_string($j->jam_mulai) ? $j->jam_mulai : $j->jam_mulai->format('H:i');
            $jamSelesai = is_string($j->jam_selesai) ? $j->jam_selesai : $j->jam_selesai->format('H:i');
            while ($current->lte($end)) {
                if ($current->dayOfWeekIso() === $dayOfWeek) {
                    $slots[] = [
                        'id' => $j->id,
                        'jadwal_id' => $j->id,
                        'hari' => $j->hari,
                        'jam_mulai' => $jamMulai,
                        'jam_selesai' => $jamSelesai,
                        'tanggal' => $current->format('Y-m-d'),
                        'tanggal_label' => $current->locale('id')->translatedFormat('l, d F Y'),
                        'waktu_label' => substr($jamMulai, 0, 5) . ' - ' . substr($jamSelesai, 0, 5),
                    ];
                }
                $current->addDay();
            }
        }

        usort($slots, function ($a, $b) {
            $d = strcmp($a['tanggal'], $b['tanggal']);
            return $d !== 0 ? $d : strcmp($a['jam_mulai'], $b['jam_mulai']);
        });

        return response()->json([
            'success' => true,
            'jadwals' => $jadwals,
            'slots' => $slots,
        ]);
    }

    /**
     * Store the konseling booking.
     */
    public function storeKonseling(Request $request)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'tipe_konseling' => 'required|in:individu,kelompok',
            'topik_id' => 'required|exists:topik,id',
            'catatan_siswa' => 'required|string|min:10|max:1000',
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
        ]);

        $user = auth()->user();
        $siswa = $user->siswa;

        if (!$siswa) {
            return back()->withErrors(['error' => 'Data siswa tidak ditemukan. Hubungi admin.']);
        }

        Booking::create([
            'jadwal_id' => $validated['jadwal_id'],
            'tanggal' => $validated['tanggal'],
            'siswa_id' => $siswa->id,
            'topik_id' => $validated['topik_id'],
            'tipe_konseling' => $validated['tipe_konseling'],
            'catatan_siswa' => $validated['catatan_siswa'],
            'status' => 'menunggu',
            'mode_konseling' => 'offline',
            'mode_identitas' => 'asli',
        ]);

        return redirect()->route('siswa.konseling')
            ->with('success', 'Permintaan konseling Anda telah dikirim. Tunggu konfirmasi dari guru BK.');
    }
}
