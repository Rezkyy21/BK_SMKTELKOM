<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            // Add column if it doesn't exist
            if (!Schema::hasColumn('siswa', 'is_password_changed')) {
                $table->boolean('is_password_changed')->default(false)->after('alamat');
            }
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn(['is_password_changed']);
        });
    }
};
