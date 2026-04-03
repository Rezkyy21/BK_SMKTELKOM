<?php

namespace App\Http\Controllers\Filament;

use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImportController extends Controller
{
    /**
     * Download template Excel untuk guru.
     * Kolom: nis | nama_lengkap | jenis_kelamin | kelas
     */
    public function template()
    {
        return Excel::download(new class implements FromArray {
            public function array(): array
            {
                return [
                    // Header — JANGAN diubah urutannya
                    ['nis', 'nama_lengkap', 'jenis_kelamin', 'kelas'],

                    // Contoh data (hapus sebelum upload)
                    ['541241005', 'Adena Maiza Prasetyo', 'L', 'XI PPLG 1'],
                    ['541241008', 'Adzkya Gharizi Fadjri', 'P', 'XI TKJ 2'],
                ];
            }
        }, 'template_import_siswa.xlsx');
    }

    /**
     * Proses upload & import file Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ], [
            'file.mimes' => 'File harus berformat Excel (.xlsx/.xls) atau CSV.',
            'file.max'   => 'Ukuran file maksimal 5MB.',
        ]);

        try {
            Excel::import(new SiswaImport(), $request->file('file'));
            return back()->with('success', '✅ Import siswa berhasil.');
        } catch (\Exception $e) {
            return back()->with('error', '❌ Gagal import: ' . $e->getMessage());
        }
    }
}