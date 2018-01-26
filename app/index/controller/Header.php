<?php
namespace app\index\controller;

use app\index\common\Base;

class Header extends Base
{
    
    public function process()
    {
        return $this->view->fetch('process');
    }
}
