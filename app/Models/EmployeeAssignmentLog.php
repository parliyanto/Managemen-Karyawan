<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAssignmentLog extends Model
{
    protected $fillable = [
        'employee_id',
        'requestor',
        'company',
        'purpose',
        'meeting_type',
        'date',
        'start_time',
        'end_time',
        'action',
        'created_by',
        'approved_by_email'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
