<?php

function getformat($data,$parent_id=0){
    static $list = [];
    foreach($data as $v){
        if($v->parent_id == $parent_id){
            $list[]= $v;
            getformat($data,$v->id);
        }
    }
    return $list;
}



?>