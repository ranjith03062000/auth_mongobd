<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        '_id',
        'password',
        'email_id',
    ];
}
