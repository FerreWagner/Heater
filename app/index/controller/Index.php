<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Category as IndexCate;
use app\index\model\Article as ArticleModel;
use app\admin\model\System;

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
        $blog   = $art->footerPost();
        
        
        $this->view->assign([
            'design' => $design,
            'fea'    => $fea,
            'client' => $client,
            'blog'   => $blog,
        ]);
        
        return $this->view->fetch('index');
    }
    
    
    
    public function banner()
    {
        $banner = db('banner')->field('title,desc,thumb,link,sort')->select();
        $this->view->assign('banner', $banner);
    }
    
    /**
     * cate搜索页
     * @return string
     */
    public function cateSearch()
    {
        $id = input('id');
        
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
        
        //catename
        $category = db('category')->field('id, catename')->find($id);
        
        $this->view->assign([
            'art'      => $art,
            'category' => $category,
        ]);
        
        $template = in_array($id, config('index_module.singlepage')) ? 'single' : 'multi';
        return $this->view->fetch($template);
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
    
    
    
}
