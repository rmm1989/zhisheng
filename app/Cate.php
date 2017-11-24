<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'cate';
    public $timestamps = false;

    //定义分类与设备的关系(一对多)
    public function instrument(){
        return $this->hasMany('App\Instrument','cate_id','id');
    }
}
