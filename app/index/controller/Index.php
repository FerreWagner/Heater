<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Category as IndexCate;

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
        $id    = input('id');
        
        //多页面和单页面
        if (!in_array($id, config('index_module.singlepage'))){
            $cate    = new IndexCate();
            $cate_id = $cate->getCate($id);
            
            $art = db('article')
                 ->field('a.id,a.thumb,b.catename')
                 ->alias('a')
                 ->join('heater_category b','a.cate=b.id')
                 ->order('a.order desc')
                 ->where('b.id', 'in', $cate_id)
                 ->paginate(config('index_module.propage'));
        }else {
            $art = db('article')->where('id', $id)->select();
        }
        halt($art);
        
        $template = $id < config('index_module.artlimit') ? 'single' : 'multi';
        return $this->view->fetch($template);
    }
    
    
}
