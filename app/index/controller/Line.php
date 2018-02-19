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
        if (is_null(Cookie::get('excel_data'))){
            $this->error('请重复导入Excel数据');
        }

        $y_arr = [];
        $x_arr = [];
        //未选择文件的处理
        if ($request->file('heater')){
            $common = new Common();
            $common->getArr($request);
        }

        $pic_view = Cookie::get('excel_data');
        foreach ($pic_view as $k => $v){
            $x_arr[] .= $v[0];
            $y_arr[] .= $v[1];

        }

        $this->view->assign([
            'pic_view' => $pic_view,
            'x_arr'    => $x_arr,
            'y_arr'    => $y_arr,
        ]);

        return $this->view->fetch(request()->action());
    }
}
