<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $status;
    public $receiverRole; // 'pelapor' atau 'terlapor'

    public function __construct($report, $status, $receiverRole)
    {
        $this->report = $report;
        $this->status = $status;
        $this->receiverRole = $receiverRole;
    }

    public function build()
    {
        return $this->subject('Status Laporan Anda')
            ->view('emails.report-status');
    }
}
