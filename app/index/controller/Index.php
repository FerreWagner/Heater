<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Article as ArticleModel;
use app\admin\model\System;
use app\index\model\Category as IndexCate;

class Index extends Base
{
    public function index()
    {
        $this->banner();
        $this->product();
        
        $art    = new ArticleModel();
        $system = new System();
        
        //单页面数据
        $design = $art->design();
        $fea    = $art->features();
        $client = $art->clients();
        
        $this->view->assign([
            'design' => $design,
            'fea'    => $fea,
            'client' => $client,
        ]);
        
        return $this->view->fetch('index');
    }
    

    public function product()
    {
        $cate    = new IndexCate();
        $pro_pid = $cate->findCateId();
    
        $product = db('article')
        ->field('id, title, thumb, keywords, desc')
        ->where('cate', 'in', $pro_pid)
        ->order('order', 'desc')
        ->limit(6)
        ->select();
    
        //TODO 1、七牛云图片显示处理 2、七牛云图片长宽处理
    
        $this->view->assign('product', $product);
    }
    
    public function banner()
    {
        $banner = db('banner')->field('title,desc,thumb,link,sort')->select();
        $this->view->assign('banner', $banner);
    }
    

    
    
    
}
