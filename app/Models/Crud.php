<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class Crud extends Eloquent
{
    protected $connection = "mongodb";
    protected $collection = "user";

    protected $fillables =[
       "_id",
       "name",
       "branch",
       "designation"
    ];
}