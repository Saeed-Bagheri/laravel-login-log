<?php

namespace Saeed\LoginLog\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Saeed\LoginLog\Mail\SendLoginInfo;


class LoginLog extends Model
{
    use Notifiable;
    protected $fillable = ['user_id', 'date', 'ip'];
    protected $table = "LoginLog";
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(config('LoginLog.UserModel'));
    }

    public function SendEmail()
    {
        if (config('LoginLog.sendEmail')) {
            $email = config('LoginLog.EmailFieldName');
            Mail::to(auth()->user()->$email)->send(new SendLoginInfo());
        }
    }


}
