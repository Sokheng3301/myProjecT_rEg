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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('id_card')->unique();
            $table->string('profile')->nullable();
            $table->string('fullname_kh');
            $table->string('ln_kh');
            $table->string('fullname_en');
            $table->string('ln_en');
            $table->integer('department_id');
            $table->integer('leave_status')->default(1)->comment('1 for active and 0 for leaved');
            $table->char('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality')->nullable();
            $table->string('deisability')->nullable();
            $table->string('officer_id')->nullable();
            $table->string('id_number')->nullable();
            $table->tinyText('place_of_birth')->nullable();
            $table->string('payroll_acc')->nullable();
            $table->string('memeber_bcc')->nullable();
            $table->date('employment_date')->nullable();
            $table->date('soup_date')->nullable();
            $table->string('working_unit')->nullable();
            $table->tinyText('working_unit_add')->nullable();
            $table->string('office')->nullable();
            $table->string('position')->nullable();
            $table->string('anountment')->nullable();
            $table->string('rank')->nullable();
            $table->string('refer')->nullable();
            $table->string('numbering')->nullable();
            $table->date('last_interest_date')->nullable();
            $table->date('dated')->nullable();
            $table->string('teach_in_year')->nullable();
            $table->string('english_teach')->nullable();
            $table->string('three_level_combine')->nullable();
            $table->string('technic_team_leader')->nullable();
            $table->string('help_teach')->nullable();
            $table->string('two_class')->nullable();
            $table->string('class_charge')->nullable();
            $table->string('cross_school')->nullable();
            $table->string('overtime')->nullable();
            $table->string('coupling_class')->nullable();
            $table->string('two_lang')->nullable();
            $table->string('work_status')->nullable();
            $table->string('family_status')->nullable();
            $table->string('must_be')->nullable();
            $table->string('occupation')->nullable();
            $table->string('name_confederate')->nullable();
            $table->string('confederation')->nullable();
            $table->date('birth_date_spouse')->nullable();
            $table->string('wife_salary')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email_add')->nullable();
            $table->tinyText('current_add')->nullable();

            $table->integer('delete_status')->default(1)->comment('1 for active and 0 for deleted');
            $table->date('deleted_date')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
