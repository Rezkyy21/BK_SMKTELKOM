<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Booking;
use App\Models\Siswa;
use App\Models\User;

// Test 1: Check if there are bookings
echo "=== Test 1: Checking Bookings ===\n";
$bookings = Booking::all();
echo "Total bookings: " . $bookings->count() . "\n";

if ($bookings->isNotEmpty()) {
    $booking = $bookings->first();
    echo "First booking: ID " . $booking->id . ", Status: " . $booking->status . ", Siswa ID: " . $booking->siswa_id . "\n";

    // Test 2: Check siswa relationship
    echo "\n=== Test 2: Checking Siswa Relationship ===\n";
    $siswa = $booking->siswa;
    if ($siswa) {
        echo "Siswa found: ID " . $siswa->id . ", User ID: " . $siswa->user_id . "\n";

        // Test 3: Check user relationship
        echo "\n=== Test 3: Checking User Relationship ===\n";
        $user = $siswa->user;
        if ($user) {
            echo "User found: ID " . $user->id . ", Email: " . $user->email . "\n";

            // Test 4: Check notifications before update
            echo "\n=== Test 4: Checking Notifications Before Update ===\n";
            $notifCount = $user->notifications()->count();
            echo "User notifications count: " . $notifCount . "\n";

            // Test 5: Trigger the update
            echo "\n=== Test 5: Triggering Booking Status Update ===\n";
            $oldStatus = $booking->status;
            $booking->update(['status' => 'disetujui']);
            echo "Booking status updated from '$oldStatus' to 'disetujui'\n";

            // Test 6: Check notifications after update
            echo "\n=== Test 6: Checking Notifications After Update ===\n";
            $user->refresh();
            $notifCountAfter = $user->notifications()->count();
            echo "User notifications count after update: " . $notifCountAfter . "\n";

            if ($notifCountAfter > $notifCount) {
                $latestNotif = $user->notifications()->latest()->first();
                echo "Latest notification:\n";
                echo "  Type: " . $latestNotif->type . "\n";
                echo "  Data: " . json_encode($latestNotif->data) . "\n";
            } else {
                echo "No new notifications created!\n";
            }
        } else {
            echo "User not found!\n";
        }
    } else {
        echo "Siswa not found for booking!\n";
    }
}
