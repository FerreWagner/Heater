<?php
namespace app\index\controller;

use app\index\common\Base;
use think\Request;

class Products extends Base
{
    
    /**
     * 产品展示页
     */
    public function index(Request $request)
    {
        if ($request->isPost()){
            halt($request->file());
        }
        
        $pro = db('article')
             ->field('a.*, b.catename')
             ->alias('a')
             ->join('heater_category b', 'a.cate=b.id')
             ->find(input('id'));
        
        $this->view->assign('pro', $pro);
        return $this->view->fetch();
    }
    
    
    
}
