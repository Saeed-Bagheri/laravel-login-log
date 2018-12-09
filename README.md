# Laravel Login Log
[![Latest Stable Version](https://poser.pugx.org/saeed/laravel-login-log/v/stable)](https://packagist.org/packages/saeed/laravel-login-log)
[![License](https://poser.pugx.org/saeed/laravel-login-log/license)](https://packagist.org/packages/saeed/laravel-login-log)
[![Total Downloads](https://poser.pugx.org/saeed/laravel-login-log/downloads)](https://packagist.org/packages/saeed/laravel-login-log)



## Installation

> Laravel Login Log requires Laravel 5.5 or higher, and PHP 7.0+.

You may use Composer to install Laravel Login Log into your Laravel project:

    composer require saeed/laravel-login-log

### Configuration

After installing the Laravel Login Log, publish its config and email view, using the `vendor:publish` Artisan command:

    php artisan vendor:publish --tag=Login-log

Next, you need to migrate your database. The Laravel Login Log migration will create the table your application needs to store Login logs:

    php artisan migrate

Finally, add the `LoginLog` traits to your authenticatable model (by default, `App\User` model). These traits provides various methods to allow you to get common login log data, such as last login time and last login IP address:

```php
use Illuminate\Notifications\Notifiable;
use Saeed\LoginLog\LoginLog;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, LoginLog;
}
```

### Basic Usage

Get all Login logs for the user:

```php
User::find(1)->loginLog()->get();
```

Get the user last login Info:

```php
User::find(1)->lastLoginDate();

User::find(1)->lastLoginIp();
```

Get the user previous login time & ip address (ignoring the current login):

```php
auth()->user()->previousLoginIp();

auth()->user()->previousLoginDate();
```

### Send login information to user email

To use these feature you can change config file on
``config/LoginLog.php``

```php
    'sendEmail' => true,
    'EmailFieldName' => 'email',
    'EmailSubject' => 'Login alert',
    'onQueue'=>'default'
```


### Clear old logs

You may clear the old authentication log records using the `login-log:clear` Artisan command:

    php artisan login-log:clear

Records that is older than the number  specified in the `count` option in your `config/LoginLog.php` will be deleted:

```php
'count' => 10,
```



## License

Laravel Authentication Log is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
