<?php
namespace app\index\controller;

use app\index\common\Common;
use think\Cookie;
use think\Request;

class Bar extends Products
{
    public function _initialize()
    {
        parent::_initialize();
    }
    
    public function bar1(Request $request)
    {
        $y_arr = [];
        $x_arr = [];
        
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        
        $pic_view = Cookie::get('excel_data');
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];
        
        }
        
        halt($x_arr);
        $this->view->assign([
            'x_arr'    => $x_arr,
            'y_arr'    => $y_arr,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
}
