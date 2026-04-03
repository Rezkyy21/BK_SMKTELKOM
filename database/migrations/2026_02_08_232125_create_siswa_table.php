<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
    $table->string('nis')->unique();
    $table->string('nama');
    $table->foreignId('major_id')->nullable()->constrained('majors')->nullOnDelete();
    $table->foreignId('class_id')->nullable()->constrained('classes')->nullOnDelete();
    $table->foreignId('academic_year_id')->nullable()->constrained('academic_years')->nullOnDelete();
    $table->enum('jenis_kelamin', ['L', 'P']);
    $table->text('alamat')->nullable();
    $table->boolean('is_password_changed')->default(false);
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};