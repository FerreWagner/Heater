<?php

namespace app\admin\controller;


use app\admin\common\Base;


class Visu extends Base
{
    /*
     * TIPS:前台数据可视化请参照Echarts API开发,特别感谢Echarts
     * 
     */
    public function browser()
    {
        $chrome = db('artsee')->where('type', 'chrome')->count();
        $fox    = db('artsee')->where('type', 'fox')->count();
        $ie     = db('artsee')->where('type', 'like', '%ie%')->count();
        $safari = db('artsee')->where('type', 'safari')->count();
        $not    = db('artsee')->where('type', 'notidentify')->count();
        
        $this->view->assign([
            'chrome' => $chrome,
            'fox'    => $fox,
            'ie'     => $ie,
            'safari' => $safari,
            'not'    => $not,
        ]);
        
        return $this->view->fetch();
    }
    
    
    public function view()
    {
        //初始化
        $year  = config('date.year') - 1;
        $mouth = config('date.mouth') + 1;
        $see   = $view_date = [];
        
        //按过去一年查询,文章阅读数量
        for ($i = 12; $i > 0; $i --){
            
            $see[] = db('artsee')->whereTime('time', 'between', [''.$year.'-'.$this->mouthDetail($mouth).'-1', ''.$year.'-'.$this->mouthDetail($mouth).'-'.$this->dateDetail($year, $mouth).''])->count();
            $view_date[] = $mouth;
            
            $mouth ++;
            if ($mouth == 13){
                $mouth = 1;
                $year  = config('date.year');
            }
            
        }
        
        $this->view->assign([
            'see'       => $see,
            'view_date' => $view_date,
        ]);
//         dump($see);die;
        return $this->view->fetch();
    }
    
    
    /**
     * 后台访问数据图表
     */
    public function end()
    {
        $error = $normal = $my = [];
        
        for ($i = 7; $i >= 1; $i --){
            $where = [time() - 86400*$i, time() - 86400*($i - 1)];
            if ($i == 1){
                $where = [time() - 86400*$i, time()];
            }
            $error[]  = db('alog')->where('type', config('alog.error'))->whereTime('time', 'between', $where)->count();
            $normal[] = db('alog')->where('type', config('alog.normal'))->whereTime('time', 'between', $where)->count();
            $my[]     = db('alog')->where('type', config('alog.normal'))->where('name', session('user_name'))->whereTime('time', 'between', $where)->count();
            
        }
        
        $this->view->assign([
            'error'   => $error,
            'normal'  => $normal,
            'my'      => $my,
        ]);
        
        return $this->view->fetch();
    }
    
    public function area()
    {
        $ip = db('tourist')->column('ip');
//         $a = file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=42.236.93.76');
//         dump($a);die;
        //入库时接入三方接口对ip地域写入，此时查询
//         foreach ($ip as $k => $v){
//             $ip_data[] = file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$v);
//         }
        return $this->view->fetch();
    }
    
    
    

}
