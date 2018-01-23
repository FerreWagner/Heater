<?php

namespace app\admin\controller;


use app\admin\common\Base;
use app\admin\common\Mail;
use think\Request;
use think\Loader;
use think\Validate;



class Banner extends Base
{
    public function index()
    {
        return $this->view->fetch('banner-list');
    }
    
    public function edit(Request $request)
    {
        if ($request->isPost()){
            //TODO 处理编辑数据
        }
        
        return $this->view->fetch('banner-edit');
    }
    
    public function delete($id)
    {
        
    }
    
}
