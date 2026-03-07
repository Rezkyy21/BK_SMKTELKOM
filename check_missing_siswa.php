<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
// Bootstrap the kernel for Eloquent
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Siswa;
use App\Models\ClassRoom;

echo "Checking Users with role 'siswa' without Siswa record...\n\n";

$users = User::where('role', 'siswa')->get();
$missing = [];
foreach ($users as $u) {
    if (!$u->siswa) {
        $missing[] = [
            'id' => $u->id,
            'email' => $u->email,
            'name' => $u->name,
            'class_id' => $u->class_id,
        ];
    }
}

if (count($missing) === 0) {
    echo "All siswa users have corresponding Siswa records.\n";
} else {
    echo "Found " . count($missing) . " user(s) missing Siswa record:\n\n";
    foreach ($missing as $m) {
        $className = null;
        if ($m['class_id']) {
            $c = ClassRoom::find($m['class_id']);
            $className = $c ? $c->name : 'N/A';
        }
        echo "- User ID: {$m['id']} | Name: {$m['name']} | Email: {$m['email']} | class_id: " . ($m['class_id'] ?? 'NULL') . " (" . ($className ?? 'N/A') . ")\n";
    }
}

echo "\nAlso check for Siswa records without linked User...\n\n";

$siswasWithoutUser = Siswa::doesntHave('user')->get();
if ($siswasWithoutUser->isEmpty()) {
    echo "No Siswa records without linked User.\n";
} else {
    echo "Found " . $siswasWithoutUser->count() . " Siswa records without user:\n";
    foreach ($siswasWithoutUser as $s) {
        echo "- Siswa ID: {$s->id} | NIS: {$s->nis} | Nama: {$s->nama} | user_id: {$s->user_id}\n";
    }
}

return 0;
