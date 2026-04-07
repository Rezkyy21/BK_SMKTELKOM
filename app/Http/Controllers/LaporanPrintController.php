<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPrintController extends Controller
{
    public function show(Request $request, Laporan $laporan)
    {
        abort_unless(auth()->check(), 403);
        abort_unless(in_array(auth()->user()->role, ['admin', 'guru_bk', 'guru']), 403);

        $laporan->loadMissing(['booking.topik', 'booking.jadwal', 'guru', 'siswa', 'siswa.classRoom']);

        $pdf = Pdf::loadView('laporan.print', [
            'laporan' => $laporan,
        ])
        ->setPaper('a4')
        ->setOption('margin-top', 0)
        ->setOption('margin-bottom', 0)
        ->setOption('margin-left', 0)
        ->setOption('margin-right', 0)
        ->setOption('enable-local-file-access', true);

        $filename = 'Laporan_' . ($laporan->nama_siswa ?? 'Konseling') . '_' . $laporan->created_at?->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}
