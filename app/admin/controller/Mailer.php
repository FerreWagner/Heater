<?php
namespace app\admin\controller;

use app\admin\common\Mail;
use app\admin\common\Base;

class Mailer extends Base
{
    /**
     * 后台邮件服务设置
     */
    public function admin()
    {
        if (Mail::isMail() == config('mail.close')) return $this->view->fetch('close');
        
        //读取表单/修改配置
        if (request()->isPost()){
            $mail = new Mail();
            $mail->getParam();
            $mail->setXml(request()->action());
            $this->success('Email Set Success');
        }
        
        //存在与否及其初始化
        if (file_exists('admin_mail.xml')){
            $xml_file = simplexml_load_file('admin_mail.xml');
            $xml_file = json_decode(json_encode($xml_file), true);
        }else {
            //data init
            $xml_file = $this->xmlInit();
        }
        
        $this->view->assign('xml_file', $xml_file);
        return $this->view->fetch();
    }
    
    /**
     * 首页邮件服务设置
     */
    public function index()
    {
        if (Mail::isMail() == config('mail.close')) return $this->view->fetch('close');  
        
        if (request()->isPost()){
            $mail = new Mail();
            $mail->getParam();
            $mail->setXml(request()->action());
            $this->success('Email Set Success');
        }
        
        if (file_exists('index_mail.xml')){
            $xml_file = simplexml_load_file('index_mail.xml');
            $xml_file = json_decode(json_encode($xml_file), true);
        }else {
            $xml_file = $this->xmlInit();
        }
        
        $this->view->assign('xml_file', $xml_file);
        return $this->view->fetch();
    }
    
    
    /**
     * xml数据初始化
     */
    public function xmlInit()
    {
        return [
            'host'            => '',
            'port'            => '',
            'username'        => '',
            'password'        => '',
            'outtitle'        => '',
            'title'           => '',
            'content'         => '',
            'line'            => '',
            'recive_name'     => '',
            'recive_address'  => '',
            'recive_username' => '',
            
        ];
    }
    
}