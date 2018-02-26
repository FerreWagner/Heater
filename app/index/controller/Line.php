<?php
namespace app\index\controller;

use app\index\common\Common;
use think\Cookie;
use think\Request;

class Line extends Products
{
    public function _initialize()
    {
        parent::_initialize();
    }
    
    

    public function line1(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
        
        $y_arr = [];
        $x_arr = [];
        
//         //未选择文件的处理
//         if ($request->file('heater')){
//             $common->getArr($request);
//         }
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
    
    public function line2(Request $request)
    {
        $y_arr = [];
        $x_arr = [];
        
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
        
        $pic_view = Cookie::get('excel_data');  //提取cookie
        
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
    
    public function line3(Request $request)
    {
        $y_arr = [];
        $x_arr = [];
        
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
        
        $pic_view = Cookie::get('excel_data');  //提取cookie
        
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
    
    public function line4(Request $request)
    {
//         $y_arr = [];
//         $x_arr = [];
    
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
    
        $pic_view   = Cookie::get('excel_data');  //提取cookie
        $sheet_name = Cookie::get('sheet_name')[0];
        
        halt($pic_view);
        
//         foreach ($pic_view as $k => $v){
//             $x_arr[] .= $v[0];
//             $y_arr[] .= $v[1];
    
//         }
    
//         $this->view->assign([
//             'x_arr'    => $x_arr,
//             'y_arr'    => $y_arr,
//         ]);
    
        return $this->view->fetch(request()->action());
    }
    
}
