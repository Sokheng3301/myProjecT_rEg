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
        Schema::create('t_culturallevels', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->nullable()->comment('teacher ID card');
            $table->string('cultural_level')->nullable();
            $table->string('major_name')->nullable();
            $table->date('recieve_date')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_culturallevels');
    }
};
