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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_code')->unique()->nullable();
            $table->string('course_name_kh')->nullable();
            $table->string('course_name_en')->nullable();
            $table->text('course_description')->nullable();
            $table->text('purpose')->nullable();
            $table->text('exspectation')->nullable();
            $table->float('credit')->default(0);
            $table->float('theory')->default(0);
            $table->float('execute')->default(0);
            $table->float('practice')->default(0);
            $table->float('hours')->default(0);
            $table->integer('course_type')->nullable();
            $table->integer('department_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
