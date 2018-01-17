<?php
namespace app\admin\controller;

use app\admin\common\Base;
class Index extends Base
{
    public function index()
    {
        return $this->view->fetch('index');
    }
    
    public function welcome()
    {
        //文章数据
        $art_sum       = db('article')->count();
        $art_today     = db('article')->whereTime('time', 'today')->count();
        $art_yesterday = db('article')->whereTime('time', 'yesterday')->count();
        $art_week      = db('article')->whereTime('time', 'week')->count();
        $art_month     = db('article')->whereTime('time', 'month')->count();
        
        //管理员log数据
        $ad_sum        = db('alog')->where('type', config('alog.normal'))->count();
        $ad_today      = db('alog')->where('type', config('alog.normal'))->whereTime('time', 'today')->count();
        $ad_yesterday  = db('alog')->where('type', config('alog.normal'))->whereTime('time', 'yesterday')->count();
        $ad_week       = db('alog')->where('type', config('alog.normal'))->whereTime('time', 'week')->count();
        $ad_month      = db('alog')->where('type', config('alog.normal'))->whereTime('time', 'month')->count();
        
        $this->view->assign([
            'art_sum'       => $art_sum,
            'art_today'     => $art_today,
            'art_yesterday' => $art_yesterday,
            'art_week'      => $art_week,
            'art_month'     => $art_month,
            'ad_sum'        => $ad_sum,
            'ad_today'      => $ad_today,
            'ad_yesterday'  => $ad_yesterday,
            'ad_week'       => $ad_week,
            'ad_month'      => $ad_month,
        ]);
        
        return $this->view->fetch('welcome');
    }
}
