<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceFault extends Model
{
    protected $table = 'service_fault';
    public $timestamps = false;
    /**
     * 定义故障处理与门店的关系
     */
    public function store(){
        return $this->hasOne('App\Store','id','store_id');
    }
}
