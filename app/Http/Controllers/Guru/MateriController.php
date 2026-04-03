<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\KategoriMateri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        // assume guru_bk users have related GuruBk record
        $guru = $user->guruBk ?? null;
        $materis = $guru ? Materi::where('guru_id', $guru->id)->get() : collect();
        return view('guru.materi.index', compact('materis'));
    }

    public function create()
    {
        $kategoris = KategoriMateri::all();
        return view('guru.materi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategori_materi,id',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'thumbnail' => 'nullable|image|max:2048',
            'status' => 'required|in:draft,publish',
        ]);

        $user = auth()->user();
        $guru = $user->guruBk;
        if (!$guru) {
            return back()->withErrors(['error' => 'Anda tidak memiliki akses guru.']);
        }

        $data = $validated;
        $data['guru_id'] = $guru->id;
        $data['slug'] = Str::slug($validated['judul']) . '-' . Str::random(6);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('materi', 'public');
        }

        Materi::create($data);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dibuat.');
    }
}
