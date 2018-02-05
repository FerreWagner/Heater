<?php

namespace app\index\model;

use think\Model;

class Article extends Model
{
    
    /**
     * 首页的design页面
     */
    public function design()
    {
        return $this->field('id, title, content')->where('cate', config('index_module.catedesign'))->limit(3)->order('order', 'desc')->select();
    }
    
    /**
     * 首页的features页面
     */
    public function features()
    {
        return $this->field('id, title, content')->where('cate', config('index_module.catefeatures'))->limit(6)->order('order', 'desc')->select();
    }
    
    /**
     * 首页的clients页面
     */
    public function clients()
    {
        return $this->field('id, title, content, thumb, desc, author')->where('cate', config('index_module.cateclients'))->order('order', 'desc')->select();
    }
    
}
