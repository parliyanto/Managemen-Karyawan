<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\AssignmentReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str; // tambahkan di atas
use App\Models\EmployeeAssignmentLog;

class AssignmentController extends Controller
{
    /**
     * Menampilkan daftar assignment & karyawan yang available.
     */
    public function index()
    {
        $assignments = Assignment::with('employee')
            ->orderBy('date', 'desc')
            ->paginate(10);

        $employees = Employee::where('status', 'Available')
            ->orderBy('name')
            ->get();

        return view('assignments', compact('assignments', 'employees'));
    }

    /**
     * Menyimpan data assignment baru & mengirim email reminder.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'employee_id'  => 'required|exists:employees,id',
        'requestor'    => 'required|string|max:255',
        'company'      => 'required|string|max:255',
        'purpose'      => 'required|string|max:255',
        'meeting_type' => 'required|in:Online,Offline',
        'date'         => 'required|date',
        'start_time'   => 'required',
        'end_time'     => 'required',
        'target_email' => 'required|email',
    ]);

    // --- Insert ke Log ---
    // EmployeeAssignmentLog::create([
    //     'employee_id' => $request->employee_id,
    //     'assigned_to' => $request->company,
    //     'action' => 'Assigned',
    //     'notes' => $request->reason,
    //     'created_by' => 'System',
    //     'date' => now(),
    // ]);

    // Generate token konfirmasi
    $validated['confirmation_token'] = Str::random(32);

    // Simpan assignment   
    $validated['status'] = 'Waiting'; 
    $assignment = Assignment::create($validated);


    // yang di add
    EmployeeAssignmentLog::create([
    'employee_id'  => $validated['employee_id'],
    'assignment_id' => $assignment->id,
    'requestor'    => $validated['requestor'],
    'company'      => $validated['company'],
    'purpose'      => $validated['purpose'],
    'meeting_type' => $validated['meeting_type'],
    'date'         => $validated['date'],
    'start_time'   => $validated['start_time'],
    'end_time'     => $validated['end_time'],
    'action'       => 'Assigned',
    'created_by'   => auth()->user()->name ?? 'System',
    'approved_by_email' => $validated['target_email'],
]);

    // Update status employee
    // $employee = Employee::findOrFail($request->employee_id);
    // $employee->update(['status' => 'Assigned']);

    // Kirim email ke target email
    Mail::to($validated['target_email'])
        ->send(new AssignmentReminderMail($assignment));

    // Kirim email ke employee jika ada email
    if (!empty($employee->email)) {
        Mail::to($employee->email)
            ->send(new AssignmentReminderMail($assignment));
    }

    return redirect()
        ->route('assignments.index')
        ->with('success', 'Karyawan berhasil di-assign & email dikirim!');
}

    /**
     * Menghapus data assignment & mengubah status karyawan ke Available.
     */
    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $employee = Employee::find($assignment->employee_id);

        if ($employee) {
            $employee->update(['status' => 'Available']);
        }

        $assignment->delete();

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment berhasil dihapus!');
    }
    

    public function confirm($token)
{
    // Cari assignment berdasarkan token
    $assignment = Assignment::where('confirmation_token', $token)->firstOrFail();

    // Jika belum dikonfirmasi, ubah statusnya
    if (!$assignment->is_confirmed) {
        $assignment->is_confirmed = true;
        $assignment->save();

    if ($assignment->status == 'Waiting') {
        $assignment->status = 'Approved';
        $assignment->is_confirmed = true;
        $assignment->status = 'Approved'; 
        $assignment->save();
    }

        // Update status employee
        $employee = Employee::find($assignment->employee_id);
        if ($employee) {
            $employee->update(['status' => 'Assigned']);
        }

        // Update log terkait assignment ini
        EmployeeAssignmentLog::where('assignment_id', $assignment->id)
            ->update(['action' => 'Approved']);
    }

    return redirect()->route('assignments.index')
        ->with('success', 'Assignment berhasil dikonfirmasi!');
}

}
