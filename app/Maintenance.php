<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table = 'maintenance';
    public $timestamps = false;

    /**
     * 定义设备保养与门店的关系
     */
    public function store(){
        return $this->hasOne('App\Store','id','store_id');
    }
}
