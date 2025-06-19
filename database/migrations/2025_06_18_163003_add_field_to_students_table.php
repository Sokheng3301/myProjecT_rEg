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
        Schema::table('students', function (Blueprint $table) {
            $table->text('dropout_reason')->nullable()->after('dropout_status')->comment('Reason for dropout');
            $table->date('dropout_date')->nullable()->after('dropout_reason')->comment('Date of dropout');
            $table->string('dropout_by')->nullable()->after('dropout_date')->comment('Who initiated the dropout');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('dropout_reason');
            $table->dropColumn('dropout_date');
            $table->dropColumn('dropout_by');
        });
    }
};
