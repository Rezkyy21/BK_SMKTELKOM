<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$migrations = [
    '2026_02_07_000001_create_majors_table',
    '2026_02_07_000002_create_classes_table',
    '2026_03_08_095255_add_photo_to_guru_bk_table',
    '2026_03_08_100755_add_photo_to_guru_bk_table',
    '2026_03_10_074829_create_password_reset_tokens_table',
    '2026_03_10_082503_add_remember_token_to_users_table',
    '2026_03_26_143237_change_tindak_lanjut_column',
    '2026_03_27_063753_add_foreign_key_guru_id_to_classes_table'
];
foreach ($migrations as $m) {
    if (!Illuminate\Support\Facades\DB::table('migrations')->where('migration', $m)->exists()) {
        Illuminate\Support\Facades\DB::table('migrations')->insert(['migration' => $m, 'batch' => 2]);
        echo "stamped: $m\n";
    } else {
        echo "already: $m\n";
    }
}
