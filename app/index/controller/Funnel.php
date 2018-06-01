<?php
namespace app\index\controller;

use app\index\common\Common;
use think\Cookie;
use think\Request;

class Funnel extends Products
{
    public function _initialize()
    {
        parent::_initialize();
    }
    

    public function fun1(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
        
//         $y_arr = [];
        $x_arr = [];
        
        $common->getForm($request);
        
        $pic_view   = Cookie::get('excel_data');
        $_title     = $common->deleteEmpty(array_pop($pic_view));
        $_subtitle  = $common->deleteEmpty(array_pop($pic_view));
        
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
//             $y_arr[] .= $v[1];

        }
        
        $this->view->assign([
            'x_arr'      => $x_arr,
            'pic_view'  => $pic_view,
            '_title'     => $_title[0],
            '_subtitle'  => $_subtitle[0],
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    public function fun2(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
    
        $x_arr = $x_arr1 = $y_arr = $y_arr1 = [];
    
        $common->getForm($request);
    
        $pic_view   = Cookie::get('excel_data');
        $_title     = $common->deleteEmpty(array_pop($pic_view));
    
        foreach ($pic_view as $k => $v){
            $x_arr[]  .= $v[0];
            $y_arr[]  .= $v[1];
            $x_arr1[] .= $v[2];
            $y_arr1[] .= $v[3];
        }
        
        $fir_data = array_combine($y_arr, $x_arr);
        $sec_data = array_combine($y_arr1, $x_arr1);
        
        $this->view->assign([
            'x_arr'     => $x_arr,
            'x_arr1'    => $x_arr1,
            'f_data'    => $fir_data,
            's_data'    => $sec_data,
            'bar_title' => $_title,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
}
