<?php


return [

    'UserModel' => \App\User::class,
    'UserTableName' => 'users',

    'count' => 10, // Only store 10 last record and delete old record
    // To use these feature you must run php artisan login-history:clear
    // or you can set Schedule and cron job for do this
    // for example $schedule->command('login-log:clear')->daily()


    //send login information to user email
    'sendEmail' => true,
    'EmailFieldName' => 'email', // What is Your Email Field Name in User Model
    'EmailSubject' => 'Login alert',
    'onQueue' => 'default' // if your queue connections is redis or database , you can change send login email  queue name

];
