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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_code')->unique();
            $table->integer('major_id');
            $table->string('level_study');
            $table->string('year_level');
            $table->year('academy_year');
            $table->integer('graduate_status')->default(1)->comment('1 for studying and 0 for graduated');
            $table->string('deleted_by')->nullable();
            $table->date('deleted_date')->nullable();
            $table->integer('delete_status')->default(1)->comment('1 for active and 0 for deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
