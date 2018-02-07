<?php

namespace app\index\model;

use think\Model;

class Category extends Model
{
    
    /**
     * 找到栏目的子栏目id
     * @param unknown $id
     * @return unknown
     */
    public function getCate($id)
    {
        $arr = [];
        
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
    
    
    /**
     * 找到产品栏目的id及其下的子栏目
     * @return NULL[]
     */
    public function findCateId()
    {
        $cate_pid = [];
        
        $cateres = $this->field('id, pid')->select();
        foreach ($cateres as $k => $v){
            if (config('index_module.productid') == $v->pid){
                $cate_pid[] = $v->id;
            }
        }
        $cate_pid[] = config('index_module.productid');
        return $cate_pid;
    }
    
}
