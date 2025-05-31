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
        Schema::create('t_shortcourses', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->nullable()->comment('teacher ID card');
            $table->string('section')->nullable();
            $table->string('major_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('prepare_by')->nullable();
            $table->string('support_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_shortcourses');
    }
};
