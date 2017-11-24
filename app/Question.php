<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    public $timestamps = false;
    //试题与试卷是一对多的关系
    public function paper(){
        return $this->hasOne('App\Paper','id','paper_id');
    }
}
