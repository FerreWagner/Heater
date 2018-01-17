<?php
namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use think\Session;
use think\Validate;
use app\admin\model\Admin as AdminModel;

class Login extends Base
{
    
    /**
     * 显示资源列表 && 登录1
     *
     * @return \think\Response
     */
    
    public function index()
    {
        $this->alreadyLogin();
        return $this->view->fetch('login');
    }
    
    
    /**
     * @param Request $request
     */
    
    public function login(Request $request)
    {
        if ($request->isPost()){
            
            $token      = Validate::token('__token__','',['__token__'=>input('param.__token__')]);    //CSRF validate
            if (!$token) $this->error('CSRF ATTACK.');
            
            $admin_data = input('post.');
            $res = AdminModel::where('username', $admin_data['username'])->find();
            
            //卸任状态处理
            if ($res['switch'] == config('switch.off')) $this->error('您已经被卸任了管理员职位');
            
            //admin log data add
            db('alog')->insert([
                'type' => password_verify($res['password'], password_hash(sha1($admin_data['password'].config('salt.password_salt')), PASSWORD_DEFAULT)) ? 1 : 0,
                'name' => $admin_data['username'],
                'ip'   => $_SERVER['REMOTE_ADDR'],
                'time' => time()
            ]);
            
            
            if (!$res){
                $this->error('Error,Dear');
            }elseif (password_verify($res['password'], password_hash(sha1($admin_data['password'].config('salt.password_salt')), PASSWORD_DEFAULT))){
                
                //admin data detail
                $in_res = AdminModel::where('username', $res['username'])->setInc('count');
                $up_res = AdminModel::where('username', $res['username'])->update(['update_time' => time()]);
                
                if (!$in_res || !$up_res) $this->error('admin data update error.');
                
                //add session
                Session::set('user_name', $res['username']);
                Session::set('user_data', $res);
                return $this->redirect('admin/index/index');
                
            }else {
                $this->error('Error,Dear');
            }
        }
    }
    
    
    /**
     * logout
     */
    
    public function logout()
    {
        Session::delete('user_name');
        Session::delete('user_data');
        $this->success('Logout Success.Dear.', 'admin/login/index');
    }
}