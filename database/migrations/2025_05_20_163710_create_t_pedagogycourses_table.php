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
        Schema::create('t_pedagogycourses', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->nullable()->comment('teacher ID card');
            $table->string('professional_level')->nullable();
            $table->string('specialty_first')->nullable();
            $table->string('specialty_second')->nullable();
            $table->string('training_system')->nullable();
            $table->date('recieve_date')->nullable();          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pedagogycourses');
    }
};
