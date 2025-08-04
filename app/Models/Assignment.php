<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'requestor', 'company', 'meeting_type', 'purpose', 'date', 'start_time', 'end_time', 'confirmation_token',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
