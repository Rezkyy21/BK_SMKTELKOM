<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PromoteStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * We don't require any arguments. This command can be scheduled.
     *
     * @var string
     */
    protected $signature = 'students:promote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Promote active students based on their entry year';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ambil siswa yang masih berstatus aktif dan bertipe siswa.
        $students = User::query()
            ->where('role', 'siswa')
            ->where('status', 'aktif')
            ->get();

        $this->info('Found ' . $students->count() . ' active students.');

        foreach ($students as $student) {
            $years = $student->yearsEnrolled();
            $this->line("Processing {$student->name} ({$student->id}), enrolled for {$years} year(s)");

            // logika kenaikan
            if ($years >= 3) {
                $student->status = 'lulus';
                $student->class_id = null;
                $student->save();
                $this->comment("--> marked as lulus");
                continue;
            }

            $newGrade = 10 + $years;
            // kita bisa memanggil promoteIfNecessary yang sudah mengeksekusi hampir
            $student->promoteIfNecessary();
            $this->comment("--> promoted to grade {$newGrade}");
        }

        $this->info('Promotion job completed.');

        return 0;
    }
}