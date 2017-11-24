<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDoor extends Model
{
    protected $table = 'to_door';
    public $timestamps = false;
    /**
     * 定义上门服务与门店的关系
     */
    public function store(){
        return $this->hasOne('App\Store','id','store_id');
    }
}
