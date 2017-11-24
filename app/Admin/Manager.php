<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    protected $table = 'manager';
    public $timestamps = false;
    protected $fillable = ['username','password','phone','email','role_id','status','time','remember_token'];
    /*
     * 定义管理员与角色之间的关系
     */
    public function role(){
        return $this->hasOne('App\Admin\Role','id','role_id');
    }
}
