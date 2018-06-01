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
        
        $x_arr = $y_arr = [];
        
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
        $x_arr = $y_arr = [];
        
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
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
        
        $pic_view   = Cookie::get('excel_data');    //提取cookie
        $sheet_name = Cookie::get('sheet_name')[0]; //sheet表名
        $sheet_cate = $common->deleteEmpty(array_shift($pic_view));  //去空元素后的分类
        $x_arr      = $common->deleteEmpty(array_shift($pic_view));  //去空元素后的横坐标
        $y_arr      = array_slice($pic_view, 0, count($pic_view));
        
        $this->view->assign([
            'sheet_name' => $sheet_name,
            'sheet_cate' => $sheet_cate,
            'x_arr'      => $x_arr,
            'y_arr'      => $y_arr,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    public function line5(Request $request)
    {
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
    
        $pic_view   = Cookie::get('excel_data');    //提取cookie
        $sheet_name = Cookie::get('sheet_name')[0]; //sheet表名
        $sheet_cate = $common->deleteEmpty(array_shift($pic_view));  //去空元素后的分类
        $x_arr      = $common->deleteEmpty(array_shift($pic_view));  //去空元素后的横坐标
        $y_arr      = array_slice($pic_view, 0, count($pic_view));
    
        $this->view->assign([
            'sheet_name' => $sheet_name,
            'sheet_cate' => $sheet_cate,
            'x_arr'      => $x_arr,
            'y_arr'      => $y_arr,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
    public function line6(Request $request)
    {
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
        
        $pic_view = Cookie::get('excel_data');  //提取cookie
        
        $this->view->assign([
            'pic_view'    => $pic_view,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
//     preg_match('/[0-9]/', $str)

    public function line7(Request $request)
    {
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
    
        $pic_view   = Cookie::get('excel_data');    //提取cookie
        $sheet_name = Cookie::get('sheet_name')[0]; //sheet表名
        $sheet_num  = $common->deleteEmpty(array_shift($pic_view));  //去空元素后的分类
        $x_arr      = $pic_view[0];
        
        $real_num   = [];
        foreach ($sheet_num as $v){ //获取纯数字
            if (preg_match('/[0-9]/', $v, $match)){
                $real_num[] = $match[0];
            }
        }
        
        $this->view->assign([
            'x_arr'      => $x_arr,
            'sheet_num'  => $sheet_num,
            'sheet_name' => $sheet_name,
            'real_num'   => $real_num,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
    public function line8(Request $request)
    {
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
        
        $pic_view   = Cookie::get('excel_data');    //提取cookie
        $sheet_name = Cookie::get('sheet_name')[0]; //sheet表名
        $sheet_cate = $common->deleteEmpty(array_shift($pic_view));  //去空元素后的分类
        $x_arr      = $common->deleteEmpty(array_shift($pic_view));  //去空元素后的横坐标
        $y_arr      = array_slice($pic_view, 0, count($pic_view));
        
        $this->view->assign([
            'sheet_name' => $sheet_name,
            'sheet_cate' => $sheet_cate,
            'x_arr'      => $x_arr,
            'y_arr'      => $y_arr,
        ]);
    
        return $this->view->fetch(request()->action());
    }
    
    public function line9(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
        
        $x_arr = $y_arr = [];
        
        $common->getForm($request);
        
        $pic_view   = Cookie::get('excel_data');
        $line_color = $common->deleteEmpty(array_pop($pic_view));
        $bdr_color  = $common->deleteEmpty(array_pop($pic_view));
        $poit_color = $common->deleteEmpty(array_pop($pic_view));
        
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];

        }
        
        $this->view->assign([
            'x_arr'      => $x_arr,
            'y_arr'      => $y_arr,
            'bdr_color'  => $bdr_color[0],
            'line_color' => $line_color[0],
            'poit_color' => $poit_color[0],
        ]);
        return $this->view->fetch(request()->action());
    }
    
    public function line10(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
    
        $x_arr = $y_arr = [];
    
        $common->getForm($request);
    
        $pic_view    = Cookie::get('excel_data');
        $sheet_name  = Cookie::get('sheet_name')[0]; //sheet表名
        $data_format = $common->deleteEmpty(array_pop($pic_view));   //最后一条为数据格式
        $data_danwei = $common->deleteEmpty(array_pop($pic_view));   //倒数第二条为x/y轴的单位
        
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];
        }
        
        $this->view->assign([
            'x_arr'      => $x_arr,
            'y_arr'      => $y_arr,
            'sheet_name' => $sheet_name,
        ]);
        return $this->view->fetch(request()->action());
    }
    
    public function line11(Request $request)
    {
        $common = new Common();
        $common->checkExcel();
        
        $x_arr = $y_arr = [];
        
        $common->getForm($request);
        
        $pic_view   = Cookie::get('excel_data');
        $sheet_name = Cookie::get('sheet_name')[0]; //sheet表名
        
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];
        }
        
        $this->view->assign([
            'x_arr'      => $x_arr,
            'y_arr'      => $y_arr,
            'sheet_name' => $sheet_name,
        ]);
        return $this->view->fetch(request()->action());
    }
    
}
