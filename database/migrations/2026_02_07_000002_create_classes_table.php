<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('grade_level'); // 10, 11, 12
            $table->foreignId('major_id')->constrained('majors')->onDelete('cascade');
            $table->string('academic_year'); // teks mis. "2023/2024"
            $table->timestamps();
            
            $table->unique(['major_id', 'grade_level', 'name', 'academic_year'], 'classes_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
};