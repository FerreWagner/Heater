<?php
namespace app\index\controller;

use app\index\common\Base;

class Products extends Base
{
    
    public function index()
    {
        $pro = db('article')
             ->field('a.*, b.catename')
             ->alias('a')
             ->join('heater_category b', 'a.cate=b.id')
             ->find(input('id'));
        
         $this->view->assign('pro', $pro);
        return $this->view->fetch();
    }
}
