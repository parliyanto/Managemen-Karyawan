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
             $table->string('requestor')->nullable();
                $table->string('company')->nullable();
                $table->string('purpose')->nullable();
                $table->enum('meeting_type', ['Online', 'Offline'])->nullable();
                $table->date('date')->nullable();
                $table->time('start_time')->nullable();
                $table->time('end_time')->nullable();
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
