<?php
namespace app\index\controller\heater;

use app\index\common\Base;
use app\index\model\Category;
use think\Cookie;

class Line extends Base
{
    public function _initialize()
    {
        parent::_initialize();
        $pro = db('article')
            ->field('a.*, b.catename')
            ->alias('a')
            ->join('heater_category b', 'a.cate=b.id')
            ->find(input('id'));

        $bot_pro1 = db('article')
                  ->field('id,thumb,desc,title')
                  ->order('time desc')
                  ->limit(4)
                  ->select();

        $this->view->assign([
            'pro'      => $pro,
            'bot_pro1' => $bot_pro1,
        ]);
    }

    public function line1()
    {
        $pic_view = Cookie::get('excel_data');
//        halt($pic_view);
        $this->view->assign('pic_view', $pic_view);
        return $this->view->fetch('products/index');

//         http://fheater.com/index/products/index/id/index/heater.line/bar1
    }
}
