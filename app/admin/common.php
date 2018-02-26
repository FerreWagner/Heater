<?php
namespace app\admin;

use think\Cookie;

//公共和稀有方法类
class Common
{
    
    /**
     * 对相应邮件服务的方法做对应处理
     * 定制功能
     */
    
    public static function mailFeedback($action)
    {
        //消息处理,可自定义编写
        return 'ROOT您好,用户'.session('user_name').'在'.date('Y-m-d H:i:s').'操作了'.$action.'方法';
        
    }

}