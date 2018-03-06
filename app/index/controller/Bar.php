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
        
        $this->view->assign([
            'x_arr'    => $x_arr,
            'y_arr'    => $y_arr,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    public function bar2(Request $request)
    {
        $y_arr = [];
        $x_arr = [];
    
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        
        $pic_view = Cookie::get('excel_data');
        $color    = implode('', $common->deleteEmpty(array_pop($pic_view)));    //最后一行剔除并转化为字符串
        
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];
    
        }
        
        $this->view->assign([
            'color'    => $color,
            'x_arr'    => $x_arr,
            'y_arr'    => $y_arr,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
    public function bar3(Request $request)
    {
        $x_arr = [];
        
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        
        $pic_view   = Cookie::get('excel_data');
        $sheet_cate = $common->deleteEmpty(array_shift($pic_view));
        $x_arr      = $common->deleteEmpty(array_shift($pic_view));
        
        
        $this->view->assign([
            'x_arr'      => $x_arr,
            'sheet_cate' => $sheet_cate,
            'sheet_data' => $pic_view,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
}
