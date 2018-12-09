<?php

namespace Saeed\LoginLog;


use Carbon\Carbon;
use Saeed\LoginLog\Model\LoginLog as LoginLogModel;

trait LoginLog
{
    public function storeLoginInfo()
    {
        $this->loginLog()->create([
            'user_id' => auth()->user()->id,
            'date' => Carbon::now()->toDateTimeString(),
            'ip' => request()->getClientIp()
        ])->SendEmail();

    }


    public function lastLoginIp()
    {
        return $this->loginLog()->first()->ip ?? request()->getClientIp();
    }

    public function lastLoginDate()
    {
        return $this->loginLog()->first()->date ?? now();
    }

    public function previousLoginIp()
    {
        return $this->loginLog()->skip(1)->first()->ip ?? $this->lastLoginIp();
    }

    public function previousLoginDate()
    {
        return $this->loginLog()->skip(1)->first()->date ?? $this->lastLoginDate();


    }


    public function loginLog()
    {
        return $this->hasMany(LoginLogModel::class)->latest('date');
    }
}