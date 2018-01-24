<?php

namespace app\admin\controller;

use app\admin\common\Base;
use think\Request;
use app\admin\model\Category as CateGoryModel;
use think\Loader;
use think\Validate;

class Category extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        //cate data
        $catemodel = new CateGoryModel();
        
        $_cateres  = $catemodel->catetree();    //执行模型层的数据处理
        
        //count cate data
        $cate_count = CateGoryModel::count();
        
        //cate add
        if($request->isPost()){
            
            $token      = Validate::token('__token__','',['__token__'=>input('param.__token__')]);    //CSRF validate
            if (!$token) $this->error('CSRF ATTACK.');
            
            $_data = input('post.');
            $validate = Loader::validate('Category');
            if(!$validate->scene('save')->check($_data)){
                $this->error($validate->getError());
            }
            
//             $catemodel->data($_data);
//             $_add = $catemodel->save();

            $_add = $catemodel->allowField(true)->save($_data);
            $_add ? $this->redirect('admin/category/index') : $this->error('Add Cate Error.Dear');
        }
        
        $this->view->assign([
            'cate_count' => $cate_count,
            '_cateres'   => $_cateres,
        ]);
        return $this->view->fetch('category-list');
    }


    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $_cate     = new CateGoryModel();
        $_cates    = CateGoryModel::find($id);
        $_cateres  = $_cate->catetree();    //执行模型层的数据处理
        
        $this->view->assign([
            '_cates'   => $_cates,
            '_cateres' => $_cateres,
        ]);
        return $this->view->fetch('category-edit');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        if($request->isPost()){
            $_data    = input('post.');
            $validate = Loader::validate('Category');
            if(!$validate->scene('edit')->check($_data)){
                $this->error($validate->getError());
            }
            
            $res = CateGoryModel::update($_data, ['id' => $_data['id']]);
            $res ? $this->redirect('admin/category/index') : $this->error('Edit Cate Error.Dear');
        }
    }

    /**
     * 删除指定资源
     */
    public function delete()
    {
        $del = db('category')->delete(input('id'));
        $del ? $this->redirect('admin/category/index') : $this->error('Link Delete Error,Dear');
    }
}
