<?php

namespace Saeed\LoginLog\Console;

use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;
use Saeed\LoginLog\Model\LoginLog;

class ClearCommand extends Command
{

    protected $signature = 'login-log:clear';


    protected $description = 'Clear old login history record';


    public function handle()
    {
        $UserModel = config('LoginLog.UserModel');
        $users = $UserModel::all();
        foreach ($users as $user) {
            $loginHistory = LoginLog::where('user_id', $user->id)->get();
            if (count($loginHistory) > config('LoginLog.count')) {
                LoginLog::where('user_id', $user->id)->orderby('date', 'asc')->take(count($loginHistory) - config('LoginLog.count'))->delete();
            }
        }
    }
}