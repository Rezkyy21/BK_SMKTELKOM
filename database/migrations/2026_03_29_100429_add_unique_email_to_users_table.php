<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // remove existing duplicate emails first to allow unique constraint
        DB::statement('DELETE u1 FROM users u1 INNER JOIN users u2 WHERE u1.id > u2.id AND u1.email = u2.email');

        $indexExists = DB::select("SHOW INDEX FROM users WHERE Key_name = 'users_email_unique'");
        if (empty($indexExists)) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
