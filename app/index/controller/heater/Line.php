<?php
namespace app\index\controller\heater;

use app\index\common\Base;
use think\Cookie;

class Line extends Base
{
    public function line1()
    {
        halt(Cookie::get('excel_data'));
//         http://fheater.com/index/products/index/id/index/heater.line/bar1
    }
}
