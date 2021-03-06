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
        $x_arr = $y_arr = [];
        
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
        $x_arr = $y_arr = [];
    
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
    
    public function bar4(Request $request)
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
    
    public function bar5(Request $request)
    {
        $x_arr = [];
    
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        
        $pic_view  = Cookie::get('excel_data');
        $title     = implode('', $common->deleteEmpty(array_pop($pic_view)));    //最后一行剔除并转化为字符串
        $sub_title = implode('', $common->deleteEmpty(array_pop($pic_view)));    //最后一行剔除并转化为字符串
        
        
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
        }
        
        $this->view->assign([
            'title'    => $title,
            'sub'      => $sub_title,
            'x_arr'    => $x_arr,
            'pic_view' => $pic_view,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    public function bar6(Request $request)
    {
        $x_arr = [];
    
        $common = new Common();
        $common->checkExcel();
    
        $common->getForm($request);
    
        $pic_view  = Cookie::get('excel_data');
    
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
        }
    
        $this->view->assign([
            'x_arr'    => $x_arr,
            'pic_view' => $pic_view,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
    
    public function bar7(Request $request)
    {
    
        $common = new Common();
        $common->checkExcel();
    
        $common->getForm($request);
    
        $pic_view  = Cookie::get('excel_data');
        $title     = implode('', $common->deleteEmpty(array_pop($pic_view)));    //最后一行剔除并转化为字符串
        
        $this->view->assign([
            'bar_title' => $title,
            'pic_view'  => $pic_view,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    public function bar8(Request $request)
    {
        $x_arr = $y_arr = [];
        
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        
        $pic_view  = Cookie::get('excel_data');
        $title     = implode('', $common->deleteEmpty(array_pop($pic_view)));    //最后一行剔除并转化为字符串
        
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];
        }
        
        $this->view->assign([
            'x_arr'     => $x_arr,
            'y_arr'     => $y_arr,
            'bar_title' => $title,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    public function bar9(Request $request)
    {
        $x_arr = $y_arr = [];
        
        $common = new Common();
        $common->checkExcel();
        
        $common->getForm($request);
        
        $pic_view = Cookie::get('excel_data');
        $title    = $common->deleteEmpty(array_shift($pic_view));    //第一行剔除
        $bar_line = $common->deleteEmpty(array_shift($pic_view));    //第一行剔除
        $bar_x    = $common->deleteEmpty(array_shift($pic_view));    //第一行剔除
        
        $this->view->assign([
            'bar_title' => $title,
            'bar_line'  => $bar_line,
            'bar_x'     => $bar_x,
            'pic_view'  => $pic_view,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
    public function bar10(Request $request)
    {
        $x_arr = $y_arr = [];
    
        $common = new Common();
        $common->checkExcel();
    
        $common->getForm($request);
    
        $pic_view  = Cookie::get('excel_data');
        $title     = $common->deleteEmpty(array_shift($pic_view));    //第一行剔除
    
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];
        }
    
        $this->view->assign([
            'x_arr'     => $x_arr,
            'y_arr'     => $y_arr,
            'bar_title' => $title,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
    public function bar11(Request $request)
    {
        $arr = [];
    
        $common = new Common();
        $common->checkExcel();
    
        $common->getForm($request);
    
        $pic_view  = Cookie::get('excel_data');
        $bar_year  = $common->deleteEmpty(array_shift($pic_view));    //第一行剔除
        $bar_cate  = $common->deleteEmpty(array_shift($pic_view));    //第一行剔除
        
        foreach ($pic_view as $_k => $_v){
            $arr[] = $common->deleteEmpty($_v);
        }
        
        $this->view->assign([
            'bar_cate'  => $bar_cate,
            'bar_year'  => $bar_year,
            'arr_data'  => $arr,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
}
