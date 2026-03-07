<?php

namespace App\Http\Controllers\Filament;

use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;

class SiswaImportController extends Controller
{
    public function template()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="siswa_template.csv"',
        ];

        $columns = "nama_lengkap,nis,email_sekolah\n";

        return response($columns, 200, $headers);
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file']);

        $file = $request->file('file');

        Excel::import(new SiswaImport(), $file);

        return back()->with('success', 'Import selesai.');
    }
}
