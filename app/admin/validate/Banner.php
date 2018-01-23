<?php
namespace app\admin\validate;
use think\Validate;

class Banner extends Validate
{
    protected $rule = [     //错误规则
        'title'    => 'unique:banner|require|max:255',    //此处的unique必须跟表明(如link),才能生效
        'desc'     => 'require',
        'link'     => 'require|url',
        'sort'     => 'require|number',
    ];

    protected $message = [
        'title.require'   => '标题不得为空',
        'title.unique'    => '标题不得重复',
        'desc.require'    => '描述不得为空',
        'sort.require'    => '文章内容不得为空',
        'sort.number'     => '排序必须为数字',
    ];

    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add' => ['title', 'desc', 'link', 'sort'],
        'edit'=> ['title', 'desc', 'link', 'sort'],               //这里只是定义继承了title和cate的验证，content没有定义
    ];
}
