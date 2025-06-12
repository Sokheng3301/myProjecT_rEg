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
            $table->integer('block_status')->default(1)->comment('1 for active and 0 for blocked')->after('note');
            $table->date('blocked_date')->nullable()->comment('Date when the student was blocked')->after('block_status');

            $table->integer('delete_status')->default(1)->comment('1 for active and 0 for deleted')->after('blocked_date');
            $table->date('deleted_date')->nullable()->comment('Date when the student was deleted')->after('delete_status');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('block_status');
            $table->dropColumn('blocked_date');

            $table->dropColumn('delete_status');
            $table->dropColumn('deleted_date');
        });
    }
};
