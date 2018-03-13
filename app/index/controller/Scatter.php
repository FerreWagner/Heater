<?php
namespace app\index\controller;

use app\index\common\Common;
use think\Cookie;
use think\Request;

class Scatter extends Products
{
    public function _initialize()
    {
        parent::_initialize();
    }
    

    public function sca1(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        $pic_view  = Cookie::get('excel_data');
        $sheet_set = $common->deleteEmpty(array_pop($pic_view));  //去空元素后的分类
        
        $this->view->assign([
            'pic_view'    => $pic_view,
            'sheet_set'   => $sheet_set[0],
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    public function sca2(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        $pic_view  = Cookie::get('excel_data');
        $title     = $common->deleteEmpty(array_pop($pic_view));  //去空元素后的分类
        
        
        $this->view->assign([
            'pic_view'    => $pic_view,
            'sca_title'   => $title,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
}
