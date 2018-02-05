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
        return $this->field('id, title, desc, content')->where('cate', config('index_module.catedesign'))->limit(3)->order('order', 'desc')->select();
    }
    
}
