<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Major;
use App\Models\AcademicYear;
use App\Models\ClassRoom;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset classes to avoid duplicates
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('classes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Get major IDs
        $rpl = Major::where('name', 'like', '%RPL%')->first();
        $tkj = Major::where('name', 'like', '%TKJ%')->first();
        $tja = Major::where('name', 'like', '%TJA%')->first();

        if (!$rpl || !$tkj || !$tja) {
            throw new \Exception('Majors RPL, TKJ, TJA not found');
        }

        // Get the active academic year
        $academicYear = AcademicYear::where('is_active', true)->first();
        if (!$academicYear) {
            throw new \Exception('No active academic year found');
        }

        $classes = [];

        $grades = [10, 11, 12];
        $majors = [
            'RPL' => ['id' => $rpl->id, 'count' => 7],
            'TKJ' => ['id' => $tkj->id, 'count' => 3],
            'TJA' => ['id' => $tja->id, 'count' => 2],
        ];

        foreach ($grades as $grade) {
            foreach ($majors as $majorName => $majorData) {
                for ($i = 1; $i <= $majorData['count']; $i++) {
                    $classes[] = [
                        'name' => "{$grade} {$majorName}-{$i}",  // → "12 RPL-3", "10 TKJ-1", dst
                        'grade_level' => $grade,
                        'major_id' => $majorData['id'],
                        'academic_year_id' => $academicYear->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        DB::table('classes')->insert($classes);
    }
}