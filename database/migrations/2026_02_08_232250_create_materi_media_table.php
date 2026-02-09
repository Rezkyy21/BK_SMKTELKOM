<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
            $table->enum('tipe', ['image', 'youtube', 'pdf', 'link']);
            $table->string('value');
            $table->string('caption')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_media');
    }
};