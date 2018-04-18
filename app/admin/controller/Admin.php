<?php

namespace app\admin\controller;


use app\admin\common\Base;
use app\admin\model\Admin as AdminModel;
use app\admin\common\Mail;
use think\Request;
use think\Loader;
use think\Validate;



class Admin extends Base
{
    
    #Tips:超级管理员为root权限，理论仅允许开放一个账户，请谨慎添加
    #Tips:二次开发权限相关，请在app/extra/action.php里进行方法写入
    
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $admin = AdminModel::paginate(config('conf.page'));
        
        //admin search function
        if ($request->isPost()){
            $search = $request->param();
            
            if (empty($search['start']) || empty($search['end'])){
                $admin = AdminModel::where('username', 'like', '%'.$search['username'].'%')->paginate(config('conf.page'));
            }else {
                $admin = AdminModel::where('update_time', 'between', [strtotime($search['start']), strtotime($search['end'])])
                                   ->where('username', 'like', '%'.$search['username'].'%')->paginate(config('conf.page'));
            }
        }
        
        $count = AdminModel::count();
        $this->view->assign([
            'admin' => $admin,
            'count' => $count,
        ]);
        
        return $this->view->fetch('admin-list');
        
    }
    
    /**
     * 
     * @param Request $request
     * @param unknown $id
     * @return string
     */
    public function edit(Request $request, $id)
    {
        $admin = AdminModel::find(request()->input($id));
        
        if ($request->isPost()){
//             $update = $request->param();
            $update = request()->post();
            $update['password']    = empty($update['password']) ? $admin['password'] : sha1($update['password'].config('salt.password_salt'));
            $update['update_time'] = time();
            
            $res = AdminModel::update($update);
            $res ? $this->redirect('admin/admin/index') : $this->error('数据更新失败');
        }
        
        
        $this->view->assign('admin', $admin);
        return $this->view->fetch('admin-edit');
    }
    
    
    /**
     * 
     * @param Request $request
     * @return string
     */
    public function add(Request $request)
    {
        if ($request->isPost()){
            
            $token      = Validate::token('__token__','',['__token__'=>input('param.__token__')]);    //CSRF validate
            if (!$token) $this->error('CSRF ATTACK.');
            
            $data = $request->param();
            
            if ($data['password'] != $data['repass']) $this->error('两次密填写不一致');
            
            $data['password']      = sha1($data['password'].config('salt.password.salt'));
            $data['create_time']   = time();
            $data['update_time']   = time();
            
            $validate = Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            
            //mail serve
            $this->mailServe($data['email'], $data['username'].config('mail.resgiter_content'));
            
            $model = new AdminModel();
            $res   = $model->allowField(true)->save($data);
            
            
            $res ? $this->redirect('admin/admin/index') : $this->error('管理员添加失败.');
        }
        
        return $this->view->fetch('admin-add');
    }
    
    
    public function delete($id)
    {
        $res = AdminModel::destroy($id);
        $res ? $this->redirect('admin/admin/index') : $this->error('删除管理员失败');
    }
    
    
    /**
     * admin switch
     * @param unknown $id
     */
    public function trans($id)
    {
        $admin = AdminModel::where('id', $id)->field(['switch', 'id'])->find();
        $admin['switch'] = $admin['switch'] == 'true' ? 'false' : 'true';
        $res   = AdminModel::update(['switch' => $admin['switch']], ['id' => $admin['id']]); //update
        
        $res ? $this->redirect('admin/admin/index') : $this->error('更新失败');
    }
    
    
    
    /**
     * admin log data list
     */
    public function logList()
    {
        $log_data  = db('alog')->where('name', session('user_name'))->order('id', 'desc')->paginate(config('conf.page'));
        $log_count = db('alog')->where('name', session('user_name'))->count('id');
        
        //root role
        if (session('user_data')['role'] == config('role.role_root')){
            $log_data  = db('alog')->order('id', 'desc')->paginate(config('conf.page'));
            $log_count = db('alog')->count('id');
        }
        
        $this->view->assign([
            'alog'      => $log_data,
            'log_count' => $log_count,
        ]);
        
        return $this->view->fetch('admin-log');
    }
    

    
}
