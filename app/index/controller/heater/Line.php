<?php
namespace app\index\controller\heater;

use app\index\common\Base;
use think\Request;
use app\index\controller\Products;

class Line extends Base
{
    public function line1(Request $request)
    {
        halt($request);
        $res_data = [];
//         http://fheater.com/index/products/index/id/index/heater.line/bar1
    }
}
