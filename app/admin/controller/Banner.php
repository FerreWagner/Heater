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
    
    public function edit(Request $request)
    {
        if ($request->isPost()){
            //TODO 处理编辑数据
        }
        
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
            $article = new BannerModel();
            if($article->allowField(true)->save($data)){
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
