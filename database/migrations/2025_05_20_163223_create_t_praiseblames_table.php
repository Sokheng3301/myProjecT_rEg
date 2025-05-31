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
        Schema::create('t_praiseblames', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_id')->nullable()->comment('teacher ID card');
            $table->string('type_praiseblame')->nullable();
            $table->string('provided_by')->nullable();
            $table->string('recieve_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_praiseblames');
    }
};
