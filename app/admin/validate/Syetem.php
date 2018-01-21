<?php
namespace app\admin\validate;

use think\Validate;

class Syetem extends Validate
{
    // 验证规则
    protected $rule = [
        'name'      => 'unique:link|require|min:2',
        'url'       => 'unique:link|require',
    ];

    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add' => ['name' => 'unique:link|require|min:2', 'url'  => 'unique:link|require'],
        'edit'=> ['name' => 'unique:link|require', 'url'  => 'unique:link|require'],
    ];
}