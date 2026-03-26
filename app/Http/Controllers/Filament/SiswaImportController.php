<?php

namespace App\Http\Controllers\Filament;

use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Concerns\FromArray;

class SiswaImportController extends Controller
{
    public function template()
{
    return Excel::download(new class implements FromArray {
        public function array(): array
        {
            return [
                ['nama_lengkap', 'nis', 'email_sekolah'], // header
            ];
        }
    }, 'siswa_template.xlsx');
}

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file']);

        $file = $request->file('file');

        Excel::import(new SiswaImport(), $file);

        return back()->with('success', 'Import selesai.');
    }
}