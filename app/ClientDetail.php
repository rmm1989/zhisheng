<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDetail extends Model
{
    protected $table = 'client_detail';
    public $timestamps = false;
    /**
     * 定义客户与设备之间的关系(一对多)
     */
    public function instrument(){
        return $this->hasMany('App\Instrument','id','instrument_id');
    }
}
