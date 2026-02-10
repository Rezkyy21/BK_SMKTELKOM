<?php

namespace Database\Seeders;

use App\Models\KategoriMateri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriMateriSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = [
            'Belajar',
            'Karir',
            'Pribadi',
            'Sosial',
        ];

        foreach ($categories as $name) {
            KategoriMateri::updateOrCreate([
                'slug' => Str::slug($name),
            ], [
                'nama_kategori' => $name,
            ]);
        }
    }
}
