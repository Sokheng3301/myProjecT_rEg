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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->integer('semester');
            $table->year('academy_year');
            $table->date('start_date');
            $table->date('finish_date');
            $table->integer('finish_status')->default(1)->comment('1 for active and 0 for finished');
            $table->integer('delete_status')->default(1)->comment('1 for active and 0 for deleted');
            $table->string('deleted_by')->nullable();
            $table->date('deleted_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
