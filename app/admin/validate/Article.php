<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule = [     //错误规则
        'title'    => 'unique:article|require|max:60',    //此处的unique必须跟表明(如link),才能生效
        'cate'     => 'require',
        'content'  => 'require',
    ];
    
    protected $message = [
        'title.require'   => '标题不得为空',
        'title.unique'    => '标题不得重复',
        'cate.require'    => '文章所属栏目不得为空',
        'content.require' => '文章内容不得为空',
    ];
    
    protected $scene = [    //场景有二,一个是添加,一个是编辑
        'add' => ['title' => 'unique:article|require','cate','content'],
        'edit'=> ['title','cate'],               //这里只是定义继承了title和cate的验证，content没有定义
    ];
}
