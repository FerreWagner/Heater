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
    
    public function add(Request $request)
    {
        if ($request->isPost()){
            halt(1);
        }
        return $this->view->fetch('banner-add');
    }
    
    public function delete($id)
    {
        
    }
    
    public function img()
    {
        return json_encode(['code' => 0, 'msg' => 'success', 'data' => ['src' => 'url', 'ext' => 'jpg']]);
    }
    
}
