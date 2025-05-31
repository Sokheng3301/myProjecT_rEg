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
            $table->string('course_code')->unique();
            $table->string('course_name_kh');
            $table->string('course_name_en');
            $table->string('course_credit');
            $table->string('course_theory');
            $table->string('course_execute');
            $table->string('course_apply');
            $table->string('course_duration');
            $table->string('course_type');
            $table->integer('department_id');
            $table->text('course_description')->nullable();
            $table->text('course_purpose')->nullable();
            $table->text('course_outcome')->nullable();
            $table->integer('delete_status')->default(1)->comment('1 for active and 0 for deleted');
            $table->string('deleted_by')->nullable();
            $table->date('deleted_at')->nullable();
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
