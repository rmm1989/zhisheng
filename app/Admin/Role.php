<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    public $timestamps = false;
    /**
     * 定义角色与权限的关系
     */
    public function privilege(){
        return $this->hasMany('App\Admin\Privilege','id','priv_ids');
    }
}
