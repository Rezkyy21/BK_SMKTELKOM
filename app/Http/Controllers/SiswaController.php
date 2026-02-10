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
     * Get jadwal for a specific guru (AJAX endpoint).
     */
    public function getGuruJadwals($guruId): JsonResponse
    {
        $jadwals = Jadwal::where('guru_id', $guruId)->get();
        
        return response()->json([
            'success' => true,
            'jadwals' => $jadwals,
        ]);
    }

    /**
     * Store the konseling booking.
     */
    public function storeKonseling(Request $request)
    {
        $validated = $request->validate([
            'jadwal_id' => 'required|exists:jadwal,id',
            'topik_id' => 'required|exists:topik,id',
            'catatan_siswa' => 'required|string|min:10|max:1000',
        ], [
            'jadwal_id.required' => 'Pilih jadwal konseling terlebih dahulu',
            'jadwal_id.exists' => 'Jadwal yang dipilih tidak ditemukan',
            'topik_id.required' => 'Pilih topik terlebih dahulu',
            'topik_id.exists' => 'Topik yang dipilih tidak ditemukan',
            'catatan_siswa.required' => 'Deskripsi masalah tidak boleh kosong',
            'catatan_siswa.min' => 'Deskripsi minimal 10 karakter',
            'catatan_siswa.max' => 'Deskripsi maksimal 1000 karakter',
        ]);

        // Get the siswa from auth user
        $user = auth()->user();
        $siswa = $user->siswa;
        
        if (!$siswa) {
            return back()->withErrors(['error' => 'Data siswa tidak ditemukan. Hubungi admin.']);
        }

        // Create booking
        Booking::create([
            'jadwal_id' => $validated['jadwal_id'],
            'siswa_id' => $siswa->id,
            'topik_id' => $validated['topik_id'],
            'catatan_siswa' => $validated['catatan_siswa'],
            'status' => 'menunggu',
            'mode_konseling' => 'offline',
            'mode_identitas' => 'asli',
        ]);

        return redirect()->route('siswa.konseling')
            ->with('success', 'Permintaan konseling Anda telah dikirim. Tunggu konfirmasi dari guru BK.');
    }
}
