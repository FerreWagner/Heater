<?php

namespace app\admin\model;

use think\Model;

class Category extends Model
{
    /**
     * TIPS:可以再次二次开发对栏目的操作
     */
    
    public function catetree(){      //model层的数据处理
        $_cateres = $this->order('sort desc')->select();
        return $this->sort($_cateres);
    }
    
    /**
     * 找到所有顶级栏目及其子栏目
     * @param unknown $_data
     * @param number $_pid
     * @param number $_level
     * @return number[]
     */
    
    public function sort($_data,$_pid = 0,$_level = 0){
        static $_arr = array();
        foreach ($_data as $_key => $_value){
            //数据的重新排序
            if($_value['pid']    == $_pid){
                $_value['level'] = $_level;
                $_arr[]          = $_value;
                $this->sort($_data,$_value['id'],$_level + 1);
            }
        }
        return $_arr;
    }
    
    
    /**
     * 删除子栏目时需要列出所有子集栏目
     * @param unknown $_cateid
     */
    
    public function getchildrenid($_cateid){
        $_cateres = $this->select();
        return $this->_getchildrenid($_cateres,$_cateid);
    }
    
    /**
     * 找到子集栏目的递归
     * @param unknown $_cateres
     * @param unknown $_cateid
     */
    
    public function _getchildrenid($_cateres,$_cateid){
        static $_arr = array();
        foreach ($_cateres as $_key => $_value){
            if($_value['pid']       == $_cateid){
                $_arr[]             = $_value['id'];
                $this->_getchildrenid($_cateres, $_value['id']);
            }
        }
        return $_arr;   //返回所有找到的子栏目及孙子栏目...的id
    }
}
