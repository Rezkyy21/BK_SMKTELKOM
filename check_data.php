<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Laporan count: " . \App\Models\Laporan::count() . PHP_EOL;
echo "Booking count: " . \App\Models\Booking::count() . PHP_EOL;

$laporan = \App\Models\Laporan::latest()->first();
if ($laporan) {
    echo "Latest laporan: ID={$laporan->id}, siswa_id={$laporan->siswa_id}, nama_siswa={$laporan->nama_siswa}" . PHP_EOL;
} else {
    echo "No laporan records" . PHP_EOL;
}

$booking = \App\Models\Booking::where('status', 'disetujui')->first();
if ($booking) {
    echo "Approved booking: ID={$booking->id}, siswa_id={$booking->siswa_id}, status={$booking->status}" . PHP_EOL;
} else {
    echo "No approved bookings" . PHP_EOL;
}