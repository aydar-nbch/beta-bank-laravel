<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CalculationResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $log;

    public function __construct($log)
    {
        $this->log = $log;
    }

    public function build()
    {
        $subject = $this->log instanceof \App\Models\CreditLog
            ? 'Ваш расчёт по кредиту'
            : 'Ваш расчёт по вкладу';

        return $this->subject($subject)
            ->view('emails.calculation')
            ->with(['log' => $this->log]); 
    }
}