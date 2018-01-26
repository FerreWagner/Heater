<?php
namespace app\index\controller;

use app\index\common\Base;

class Index extends Base
{
    public function index()
    {
        return $this->view->fetch('index');
    }
    
    
    
}
