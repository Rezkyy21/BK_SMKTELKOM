<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('career_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Kategori pilihan karir: kuliah, kerja, usaha, lainnya
            $table->enum('category', ['kuliah', 'kerja', 'usaha', 'lainnya'])->nullable();
            
            // Detail rencana (tulisan panjang untuk elaborasi)
            $table->text('description')->nullable();
            
            // Untuk kategori "kuliah"
            $table->string('target_university')->nullable();        // target universitas
            $table->string('target_major')->nullable();             // target jurusan/program studi
            
            // Untuk kategori "kerja"
            $table->string('target_company')->nullable();           // target perusahaan
            $table->string('target_position')->nullable();          // posisi/jabatan yang diinginkan
            
            // Untuk kategori "usaha"
            $table->string('business_name')->nullable();            // nama usaha yang direncanakan
            $table->text('business_idea')->nullable();              // ide/deskripsi usaha
            
            // Status rencana
            $table->enum('status', ['draft', 'submitted'])->default('draft');
            
            // Tanggal submit
            $table->timestamp('submitted_at')->nullable();
            
            $table->timestamps();
            
            // Index untuk query cepat
            $table->index('user_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_plans');
    }
};
