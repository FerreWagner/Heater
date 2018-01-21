<?php
//后台模块的配置文件
return [
    // 视图输出字符串内容替换
    'view_replace_str'       => [
        //重置admin模块中对应的think/library/think/View.php中的模板常量信息
        '__STATIC__' => '/static/admin',
    ],
];