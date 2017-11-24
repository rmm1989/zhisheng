<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'paper';
    public $timestamps = false;
    //试卷与试题是一对多的关系
    public function question(){
        return $this->hasMany('App\Question','paper_id','id');
    }
}
