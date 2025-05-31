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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('list_status')->default(1)->comment('1 for not in list and 0 for in list');
            $table->string('profile')->nullable();
            $table->string('id_card')->nullable()->unique();
            $table->string('fullname_kh')->nullable();
            $table->string('fullname_en')->nullable();
            $table->string('generation')->nullable();
            $table->bigInteger('class_id')->nullable();
            $table->integer('dropout_status')->default('1')->comment('1 for active and 0 for dropout');
            $table->integer('grauduate_staus')->default(1)->comment('1 for study and 0 for graduated');
            $table->char('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('national')->nullable();
            $table->string('nationality')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->tinyText('place_of_birth')->nullable();
            $table->tinyText('current_add')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_age')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_phone')->nullable();
            $table->tinyText('father_add')->nullable();

            $table->string('mother_name')->nullable();
            $table->string('mother_age')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_phone')->nullable();
            $table->tinyText('mother_add')->nullable();

            $table->string('sibling')->nullable();
            $table->string('female_sibling')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
