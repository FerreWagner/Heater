<?php
namespace app\index\controller;

use app\index\common\Base;

class Index extends Base
{
    public function index()
    {
        $this->banner();
        return $this->view->fetch('index');
    }
    
    
    
    public function banner()
    {
        $banner = db('banner')->field('title,desc,thumb,link,sort')->select();
        $this->view->assign('banner', $banner);
    }
    
    public function cateSearch()
    {
        $param = input('cate');
//        db('article')->
        return $this->view->fetch('list');
    }
    
    
}
