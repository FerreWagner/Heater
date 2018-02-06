<?php

namespace app\index\model;

use think\Model;

class Article extends Model
{
    
    /**
     * 模型获取器
     * @param unknown $time
     */
    protected function getTimeAttr($time)
    {
        return date('Y-m-d H:i:s', $time);
    }
    
    protected function getTagAttr($tag)
    {
        return explode(',', $tag);
    }
    
    protected function getKeywordsAttr($keywords)
    {
        return explode(',', $keywords);
    }
    
    /**
     * 首页的design页面
     */
    public function design()
    {
        return $this->field('id, title, content')
                    ->where('cate', config('index_module.catedesign'))
                    ->limit(3)
                    ->order('order', 'desc')
                    ->select();
    }
    
    /**
     * 首页的features页面
     */
    public function features()
    {
        return $this->field('id, title, content')
                    ->where('cate', config('index_module.catefeatures'))
                    ->limit(6)
                    ->order('order', 'desc')
                    ->select();
    }
    
    /**
     * 首页的clients页面
     */
    public function clients()
    {
        return $this->field('id, title, content, thumb, desc, author')
                    ->where('cate', config('index_module.cateclients'))
                    ->order('order', 'desc')
                    ->select();
    }
    
    /**
     * 首页页尾的两篇post数据
     */
    public function footerPost()
    {
        return $this->field('id, title, desc, thumb')
                    ->where('cate', config('index_module.cateblog'))
                    ->order('order', 'desc')
                    ->limit(2)
                    ->select();
    }
    
    /**
     * blog详细数据
     * 排除字段的方式
     */
    public function blogData($id)
    {
        return $this->field('id, cate, order', true)
                    ->find($id);
    }
    
    
}
