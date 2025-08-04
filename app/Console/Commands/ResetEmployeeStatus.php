<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Assignment;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ResetEmployeeStatus extends Command
{
    protected $signature = 'employee:reset-status';
    protected $description = 'Reset status karyawan ke Available jika end_time sudah lewat';

    public function handle()
{
    $now = Carbon::now();
    $now = Carbon::parse('2025-08-01 15:30:00'); // Set waktu sesuai kebutuhan
    Log::info("⏱ [ResetEmployeeStatus] Scheduler running at: {$now}");
    Log::info("Waktu sekarang: {$now->toDateTimeString()}");

    $assignments = Assignment::all();
    if ($assignments->isEmpty()) {
        Log::info('⚠️ [ResetEmployeeStatus] Tidak ada assignment.');
        return Command::SUCCESS;
    }

    foreach ($assignments as $assignment) {
        $endDateTime = Carbon::parse("{$assignment->date} {$assignment->end_time}");

        // Debug log detail - Pindahkan log setelah mendeklarasikan $endDateTime
        Log::info("➡️ [ResetEmployeeStatus] Cek Assignment", [
            'AssignmentID' => $assignment->id,
            'EmployeeID'   => $assignment->employee_id,
            'EndDateTime'  => $endDateTime->toDateTimeString(),
            'Now'          => $now->toDateTimeString(),
            'Compare'      => $now->greaterThanOrEqualTo($endDateTime) ? 'YES' : 'NO',
        ]);

        // Perbandingan waktu
        if ($now->greaterThanOrEqualTo($endDateTime)) {
            $employee = Employee::find($assignment->employee_id);
            if ($employee) {
                Log::info("   - Employee ditemukan: {$employee->name}, Status sekarang: {$employee->status}");
                if ($employee->status !== 'Available') {
                    $employee->update(['status' => 'Available']);
                    Log::info("   ✅ Status {$employee->name} direset ke Available");
                } else {
                    Log::info("   ℹ️ Status {$employee->name} sudah Available");
                }
            } else {
                Log::info("   ❌ Employee ID {$assignment->employee_id} tidak ditemukan di tabel employees");
            }

            // Hapus assignment setelah waktu selesai
            $assignment->delete();
            Log::info("   🗑 Assignment ID {$assignment->id} dihapus karena waktu sudah lewat.");
        }
    }

    Log::info('[ResetEmployeeStatus] Proses reset selesai.');
    return Command::SUCCESS;
}
}
