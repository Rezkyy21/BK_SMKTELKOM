<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AcademicYear;
use App\Models\Siswa;
use App\Models\User;

class DeactivateOldStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'students:deactivate-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate student accounts that are 3 or more years old based on enrollment year';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the active academic year
        $activeYear = AcademicYear::where('is_active', true)->first();

        if (!$activeYear) {
            $this->error('No active academic year found.');
            return 1;
        }

        $currentStartYear = $activeYear->start_year;
        $cutoffYear = $currentStartYear - 3;

        // Find students whose enrollment year is 3 or more years ago
        $oldStudents = Siswa::whereHas('academicYear', function ($query) use ($cutoffYear) {
            $query->where('start_year', '<=', $cutoffYear);
        })->with('user')->get();

        $deactivatedCount = 0;

        foreach ($oldStudents as $siswa) {
            if ($siswa->user && $siswa->user->status_akun === 'aktif') {
                $siswa->user->update(['status_akun' => 'nonaktif']);
                $deactivatedCount++;
            }
        }

        $this->info("Deactivated {$deactivatedCount} old student accounts.");
        return 0;
    }
}