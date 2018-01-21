<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    // 定义类型转换
    protected $type = [
        'create_time'    => 'timestamp:Y-m-d H:i:s',
        'update_time'    => 'timestamp:Y-m-d H:i:s',
    ];
    // 定义自动完成的属性
//     protected $insert = ['role' => 1];
}
