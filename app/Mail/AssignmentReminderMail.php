<?php

namespace App\Mail;

use App\Models\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignmentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $assignment;

    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
    }

    public function build()
    {
        $confirmUrl = route('assignments.confirm', ['token' => $this->assignment->confirmation_token]);
        
          return $this->subject('Assignment Reminder')
                ->view('emails.assignment')
                ->with([
                    'employee'       => $this->assignment->employee->name,
                    'purpose'        => $this->assignment->purpose,
                    'date'           => $this->assignment->date,
                    'time'           => $this->assignment->start_time . ' - ' . $this->assignment->end_time,
                    'requestor'      => $this->assignment->requestor ?? 'N/A',
                    'company'        => $this->assignment->company ?? 'N/A',
                    'meeting_type'   => $this->assignment->meeting_type ?? 'N/A',
                    'confirmUrl' => $confirmUrl
                ]);
    }
}
