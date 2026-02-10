<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function show($slug)
    {
        $materi = Materi::where('slug', $slug)->where('status', 'publish')->firstOrFail();
        return view('materi.show', compact('materi'));
    }
}
