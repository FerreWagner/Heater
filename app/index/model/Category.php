<?php

namespace app\index\model;

use think\Model;

class Category extends Model
{
    public function getCate($id)
    {
        static $arr = [];
        
        //为子级栏目的处理
        $get = $this->field('id, pid')->find($id);
        if ($get->pid != 0){
            return $arr = $get->id;
        }
        
        //为顶级栏目的处理
        $son = $this->field('id, pid')->where('pid', 'NEQ', 0)->select();
        foreach ($son as $k => $v){
            if ($get->id == $v->pid){
                $arr[] = $v->id;
            }
        }
        $arr = empty($arr) ? $get->id : $arr;
        return $arr;
    }
}
