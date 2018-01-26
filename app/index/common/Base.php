<?php
namespace app\index\common;

use think\Controller;

class Base extends Controller
{
    
    /**
     * 获取前台导航栏
     * TODO:前台对应order值进行循环
     */
    public function cate(){
        $cateres   = db('category')->where(['pid' => 0])->select(); //顶级分类的pid=0
        foreach ($cateres as $k => $v){
            $child = db('category')->where(['pid' => $v['id']])->order('sort', 'asc')->select();
            if($child){    //如果存在子级栏目
                $cateres[$k]['child'] = $child;
            }else{
                $cateres[$k]['child'] = 0;
            }
        }
        
        $this->view->assign('cateres',$cateres);
    }
    
    
    
}
