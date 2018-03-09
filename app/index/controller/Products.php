<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\common\Common;
use think\Request;
use app\index\model\Category;

class Products extends Base
{
    public $pro;
    
    /**
     * 产品展示页
     */
    public function _initialize()
    {
        parent::_initialize();
        
        $cate    = new Category();
        $cate_id = $cate->findCateId();
        
        $this->pro = db('article')
            ->field('a.*, b.catename')
            ->alias('a')
            ->join('heater_category b', 'a.cate=b.id')
//             ->cache(config('index_module.cache'))
            ->find(input('id'));

        $bot_pro1 = db('article')
            ->field('id,thumb,desc,title')
            ->order('time desc')
            ->whereIn('cate', $cate_id)
            ->limit(4)
//             ->cache(config('index_module.cache'))
            ->select();

        $this->view->assign([
            'pro'      => $this->pro,
            'bot_pro1' => $bot_pro1,
        ]);
    }


    public function index(Request $request)
    {
        //拼接跳转url
        if ($request->isPost()){
//            $url_detail = 'index/heater.'.$pro['catename'].'/'.explode('.', $pro['desc'])[0];
//            halt($url_detail);
            $url_detail = 'index/'.$this->pro['catename'].'/'.explode('.', $this->pro['desc'])[0];
//            halt($url_detail);
//             $method     = strtolower($pro['catename']);
//             $da = $this->$method($request);
            $common = new Common();
            $common->getArr($request);
//             Url::build($url_detail, ['data' => $get_arr]);
            $this->redirect($url_detail, ['id' => input('id')]);
        }
        return $this->view->fetch();
    }
    
}