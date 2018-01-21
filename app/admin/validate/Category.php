<?php
namespace app\admin\validate;
use think\Validate;
class Category extends Validate
{
    protected $rule = [     //错误规则
        'catename' => 'unique:category|require|max:25',
    ];
    
    protected $message = [
        'catename.require' => '栏目名称不得为空',
        'catename.unique'  => '栏目名称不得重复',
    ];
    
    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'save' => ['catename'],
        'edit' => ['catename'],
    ];
}