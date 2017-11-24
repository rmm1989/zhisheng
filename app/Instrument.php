<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    protected $table = 'instrument';
    public $timestamps = false;
    /**
     * 定义助听设备与分类的关系(一对一)
     */
    public function cate(){
        return $this->hasOne('App\Cate','id','cate_id');
    }
    /**
     * 定义设备与客户之间的关系(一对一)
     */

}
