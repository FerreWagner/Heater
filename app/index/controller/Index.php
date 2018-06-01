<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Article as ArticleModel;
use think\Request;

class Index extends Base
{
    public function index(Request $request)
    {
        //游客记录
        $this->tourist($request);
        
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
            'count_art'    => $this->countArtSee($product), //首页产品的artsee数据
        ]);
        
        return $this->view->fetch('index');
    }


    /**
     * 游客记录
     */
    public function tourist(Request $request)
    {
        $see_time  = db('tourist')->field('time')->where('ip', $request->ip())->order('time', 'desc')->find();
        if (empty($see_time)){    //(time() - $see_time['time']) > 30 || 
            
            //sina地理位置接口
            $area      = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip={$request->ip()}");
            $arr_data  = json_decode($area, true);
            $error     = json_last_error();
            
            //json是否存在错误
            if (!empty($error)) {
                $see = [
                    'type'     => $this->getBrowser(),
                    'ip'       => $request->ip(),
                    'country'  => '',
                    'province' => '',
                    'city'     => '',
                    'time'     => time(),
                ];
            }else {
                $see = [
                    'type'     => $this->getBrowser(),
                    'ip'       => $request->ip(),
                    'country'  => $arr_data['country'],
                    'province' => $arr_data['province'],
                    'city'     => $arr_data['city'],
                    'time'     => time(),
                ];
            }
            db('tourist')->insert($see);
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
    
    /**
     * 首页artsee数据
     * @param unknown $art_data
     * @return number[]|string[]
     */
    public function countArtSee($art_data)
    {
        $count = [];
        foreach ($art_data as $k => $v){
            $count[] .= db('artsee')->where('rid', $v->id)->count();
        }
        
        return $count;
    }
    
    
}
