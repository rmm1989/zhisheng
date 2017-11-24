<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table = 'privilege';
    public $timestamps = false;
    public function role(){
        return $this->hasMany('App\Admin\Role','priv_ids','id');
    }
}
