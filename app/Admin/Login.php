<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Login extends Authenticatable
{
    protected $table = 'manager';
    public $timestamps = false;
    protected $fillable = ['username','password','phone','email','role_id','status','time','remember_token'];
}

