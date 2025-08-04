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
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'skill')) {
                $table->dropColumn('skill');
            }
            $table->string('team')->nullable()->after('name');
            $table->string('purpose')->nullable()->after('team');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('skill')->nullable();
            $table->dropColumn(['team', 'purpose']);
        });
    }
};
