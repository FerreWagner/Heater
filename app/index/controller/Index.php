<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Article as ArticleModel;

class Index extends Base
{
    public function index()
    {
        //游客记录
        $this->tourist();
        
        $this->banner();
        $this->countSee();
        
        $art       = new ArticleModel();
        //首页article部分数据
        $product   = $art->product();
        $design    = $art->design();
        $fea       = $art->features();
        $client    = $art->clients();
        $pro_count = $art->countProduct();
        
        $this->view->assign([
            'product'      => $product,
            'design'       => $design,
            'fea'          => $fea,
            'client'       => $client,
            'pro_count'    => $pro_count,
            'banner'       => $this->banner(),
            'count_artsee' => $this->countSee(),
            'day_work'     => $this->dayWork(),
        ]);
        
        return $this->view->fetch('index');
    }


    /**
     * 游客记录
     */
    public function tourist()
    {
        $time = db('tourist')->field('time')->where('ip', request()->ip())->order('time', 'desc')->find();
        if (empty($time)){
            $res = db('tourist')->insert(['ip' =>request()->ip(), 'time' => time()]);
            return $res ? true : false;
        }
    }
    /**
     * 首页banner
     */
    public function banner()
    {
        return db('banner')->field('title,desc,thumb,link,sort')->order('sort', 'desc')->select();
    }
    
    
    /**
     * 统计浏览量
     */
    public function countSee()
    {
        return db('artsee')->field('id')->count();
    }
    
    /**
     * 网站工作多久,从2018/2/1开始计算
     */
    public function dayWork()
    {
        return round((time() - 1517414400)/86400, 4);
    }
    
    
    
}
