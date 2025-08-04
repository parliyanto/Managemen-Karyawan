<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('employee_assignment_logs', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('employee_id');
    $table->string('requestor');
    $table->string('company');
    $table->string('purpose');
    $table->enum('meeting_type', ['Online', 'Offline']);
    $table->date('date');
    $table->time('start_time');
    $table->time('end_time');
    $table->string('action')->default('Assigned');
    $table->string('created_by')->nullable();
    $table->timestamps();

        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    });
}

public function down()
{
    Schema::dropIfExists('employee_assignment_logs');
}
};
