<?php

namespace App\Exports;

use App\Models\EmployeeAssignmentLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeAssignmentLogExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return EmployeeAssignmentLog::with('employee')->get();
    }

    public function headings(): array
    {
        // Define the headings for the export
        return [
            'No',
            'Karyawan',
            'Requestor',
            'Company',
            'Purpose',
            'Meeting Type',
            'Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Status',
            'Approved By Email',
        ];
    }

    public function map($log): array
    {
        return [
            $log->id,
            $log->employee->name ?? 'N/A',
            $log->requestor,
            $log->company,
            $log->purpose,
            $log->meeting_type,
            $log->date,
            $log->start_time,
            $log->end_time,
            $log->action,
            $log->approved_by_email,
        ];
    }
}
