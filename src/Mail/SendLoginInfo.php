<?php

namespace Saeed\LoginLog\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;

class SendLoginInfo extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $date;
    public $ip;
    public $name;


    public function __construct()
    {
        $this->date = Carbon::now()->toDateTimeString();
        $this->ip = request()->ip();
        $this->name = auth()->user()->name;
    }


    public function build()
    {
        return $this->subject(config('LoginLog.EmailSubject'))->view('LoginLog::email', compact('date', 'ip', 'name'))
            ->onQueue(config('LoginLog.onQueue'));
    }
}
