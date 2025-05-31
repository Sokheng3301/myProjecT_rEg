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
        Schema::table('teachers', function (Blueprint $table) {
            $table->tinyText('leave_description')->nullable()->after('leave_status');
            $table->date('leave_date')->nullable()->after('leave_description');
            $table->string('leave_by')->nullable()->after('leave_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropColumn('leave_description');
            $table->dropColumn('leave_date');
            $table->dropColumn('leave_by');
        });
    }
};
