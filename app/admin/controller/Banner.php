<?php

namespace app\admin\controller;


use app\admin\common\Base;
use app\admin\common\Mail;
use think\Request;
use think\Loader;
use think\Validate;
use app\admin\model\Banner as BannerModel;



class Banner extends Base
{
    
    public function index()
    {
        $banner = db('banner')->select();
        $this->view->assign('banner', $banner);
        return $this->view->fetch('banner-list');
    }
    
    public function edit(Request $request, $id)
    {
        if ($request->isPost()){
            $data = $request->param();
            $validate = Loader::validate('Banner');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            
            $_banner = new BannerModel();
            $save    = $_banner->update($data);
            
            if($save){
                $this->success('修改成功！',url('admin/banner/index'));
            }else{
                $this->error('修改失败！');
            }
            return;
        }
        
        $banner = db('banner')->find($id);
        $this->view->assign('banner', $banner);
        return $this->view->fetch('banner-edit');
    }
    
    public function add(Request $request)
    {
        //add
        if ($request->isPost()){

            $token      = Validate::token('__token__','',['__token__'=>input('param.__token__')]);    //CSRF validate
            if (!$token) $this->error('CSRF ATTACK.');

            $data = input('post.');
            $data['time'] = time();    //写入时间戳
            $validate = Loader::validate('Banner');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $_banner = new BannerModel();
            if($_banner->allowField(true)->save($data)){
                $this->redirect('admin/banner/index');
            }else{
                $this->error('添加失败');
            }
        }
        return $this->view->fetch('banner-add');
    }
    
    public function delete($id)
    {
        if(BannerModel::destroy($id)){
            $this->success('删除成功！',url('admin/banner/index'));
        }else{
            $this->error('删除失败！');
        }
    }
    

}
