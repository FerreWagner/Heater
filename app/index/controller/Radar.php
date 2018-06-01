<?php
namespace app\index\controller;

use app\index\common\Common;
use think\Cookie;
use think\Request;

class Radar extends Products
{
    public function _initialize()
    {
        parent::_initialize();
    }
    
    

    
    public function rad1(Request $request)
    {
        $filter = [];
        
        $common = new Common();
        $common->checkExcel();      //数据验证
        $common->getForm($request); //数据表单提取
        
        $pic_view    = Cookie::get('excel_data');  //提取cookie
        $title       = implode('', $common->deleteEmpty(array_shift($pic_view)));
        $rad_cate    = $common->deleteEmpty(array_shift($pic_view));
        $cate_detail = $common->deleteEmpty(array_shift($pic_view));
        
        $i = count($pic_view[0]);
        foreach ($pic_view as $k => $v){
            if ($k == 0){
                $filter = $v;
            }else {
                foreach ($v as $_k => $_v){
                    if ($_v > $filter[$_k]) $filter[$_k] = $_v;
                }
            }
        }
        
        $this->view->assign([
            'rad_title'   => $title,
            'rad_cate'    => $rad_cate,
            'cate_detail' => $cate_detail,
            'max_data'    => $filter,
            'pic_view'    => $pic_view,
        ]);
        
        return $this->view->fetch(request()->action());
    }
    
    
}
