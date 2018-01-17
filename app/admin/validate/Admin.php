<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [     //错误规则
        'username'    => 'unique:admin|require|max:20|min:2',    //此处的unique必须跟表明(如link),才能生效
        'password'    => 'require|min:4',
        'email'       => 'email',
    ];
    
    protected $message = [
        'username.require'   => '昵称不得为空',
        'username.unique'    => '昵称不得重复',
        'password.require'   => '密码不得为空',
        'email.require'      => 'email不得为空',
    ];
    
    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add' => ['username', 'password', 'email'],
        'edit'=> ['username', 'email'],               //这里只是定义继承了username和email的验证，password没有定义
    ];
}
