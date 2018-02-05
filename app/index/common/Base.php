<?php
namespace app\index\common;

use think\Controller;
use app\admin\model\System;
use app\index\model\Article as ArticleModel;


class Base extends Controller
{
    
    public function _initialize()
    {
        $this->cate();
        
        //system数据
        $art    = new ArticleModel();
        $system = new System();
        $sys    = $system->getSys();
        $blog   = $art->footerPost();
        $tag    = explode(',', $sys['tag']);
        $this->view->assign([
            'sys'    => $sys,
            'blog'   => $blog,
            'tag'    => $tag,
        ]);
    }
    
    /**
     * 获取前台导航栏
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
