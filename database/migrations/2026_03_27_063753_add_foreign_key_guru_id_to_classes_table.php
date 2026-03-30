<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('classes', 'guru_id')) {
            return;
        }

        $database = DB::getDatabaseName();
        $existsFk = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('CONSTRAINT_SCHEMA', $database)
            ->where('TABLE_NAME', 'classes')
            ->where('COLUMN_NAME', 'guru_id')
            ->where('REFERENCED_TABLE_NAME', 'guru_bk')
            ->exists();

        if ($existsFk) {
            return;
        }

        Schema::table('classes', function (Blueprint $table) {
            $table->foreign('guru_id')->references('id')->on('guru_bk');
        });
    }

    public function down(): void
    {
        $database = DB::getDatabaseName();
        $existsFk = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->where('CONSTRAINT_SCHEMA', $database)
            ->where('TABLE_NAME', 'classes')
            ->where('COLUMN_NAME', 'guru_id')
            ->where('REFERENCED_TABLE_NAME', 'guru_bk')
            ->exists();

        if (! $existsFk) {
            return;
        }

        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['guru_id']);
        });
    }
};