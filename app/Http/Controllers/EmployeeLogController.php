<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeAssignmentLog;
use App\Exports\EmployeeAssignmentLogExport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeLogController extends Controller
{
    public function index()
{
    $logs = EmployeeAssignmentLog::with(['employee', 'assignment'])
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('employee.logs', compact('logs'));
}

public function store(Request $request)
{
    $assignment = Assignment::create([
        'employee_id' => $request->employee_id,
        'company' => $request->company,
        'purpose' => $request->purpose,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'requestor' => $request->requestor,
        'meeting_type' => $request->meeting_type,
    ]);

    return redirect()->route('assignments.index')->with('success', 'Karyawan berhasil diassign.');
}


public function export()
{
    return Excel::download(new EmployeeAssignmentLogExport, 'employee_assignment_logs.xlsx');
}

}
