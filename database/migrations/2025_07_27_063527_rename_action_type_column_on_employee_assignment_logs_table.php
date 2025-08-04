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
        Schema::table('employee_assignment_logs', function (Blueprint $table) {
             if (Schema::hasColumn('employee_assignment_logs', 'action_type')) {
        $table->dropColumn('action_type');
    }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_assignment_logs', function (Blueprint $table) {
            //
        });
    }
};
