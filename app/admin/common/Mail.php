<?php
namespace app\admin\common;

use PHPMailer\PHPMailer\PHPMailer;
use app\admin\model\System;

class Mail
{
    #TIPS:QQ邮箱需要做代理邮件的开启，且密码自动生成
    #TIPS:当调用邮件服务类时,初始化设置为：getParam(); init();content();setXml();后台使用服务时，调用replay和send方法；
    
    
    //phpmailer instance
    protected $mail;
    
    //email set
    protected $host;
    protected $port;
    protected $username;
    protected $password;
    //email info
    protected $outtitle;
    protected $title;
    protected $content;
    protected $line;
    
    //email reciver
    public $recive;             //接受方邮箱
    public $recive_name;        //发送方外部显示的接收方名
    public $recive_address;     //发送方邮箱
    public $recive_username;    //接收方内部显示的发送方名
    
    /**
     * 
     * 前台可调用方法：信息体；接收方；名，接收方
     */
    public function init()
    {
        
        $this->mail                = new PHPMailer();
        
        //设置字符集
        $this->mail->CharSet       = "utf-8";
        // 设置错误中文提示
        $this->mail->setLanguage('zh_cn');
        
        
        $this->mail->IsSMTP();
        
        $this->mail->SMTPAuth      = true;
        $this->mail->SMTPKeepAlive = true;
        
        $this->mail->SMTPSecure    = "ssl";  //or tls
        $this->mail->Port          = $this->port ? $this->port : '465'; //阿里云服务商对25端口进行了封禁处理
        
        // 设置邮件优先级 1：高, 3：正常（默认）, 5：低
        $this->mail->Priority      = 1;
        
        //初始化，不必在意
        $this->mail->Host          = $this->host ? $this->host : 'smtp.163.com';
        
        //填写你的邮箱账号和密码
        $this->mail->Username      = $this->username ? $this->username : '1573646491@163.com';
        $this->mail->Password      = $this->password ? $this->password : '1234';
        
        //设置发送方，最好不要伪造地址
        $this->mail->From          = $this->username ? $this->username : '1573646491@163.com';
        // 发送方-邮件外部发件人
        $this->mail->FromName      = $this->recive_username ? $this->recive_username : 'FerreWagner';
        
    }
    
    
    /**
     * 消息体
     */
    public function content($content = '')
    {
        
        //标题，内容，和备用内容
        $this->mail->Subject       = $this->title    ? $this->title    : 'Hello';
        
        //初始化消息体
        if (!empty($content)){
            $this->mail->Body      = $content;
        }else {
            $this->mail->Body      = $this->content  ? $this->content  : 'Nice To Meet You';
        }
        
        //如果邮件不支持HTML格式，则替换成该纯文本模式邮件
        $this->mail->AltBody       = time();
        $this->mail->IsHTML(true);
        
        // 设置邮件每行字符数
        $this->mail->WordWrap      = $this->line ? $this->line : 20; 
        //$this->mail->MsgHTML($body);
    }
    

    /**
     * 回复体
     */
    public function replay($recive, $recive_name = '')
    {
        
        //初始化接收方信息
        $this->recive = $recive;
        if (!empty($recive_name)) $this->recive_name = $recive_name;
        
        
        //设置回复地址
        $this->mail->AddReplyTo($this->recive_address, $this->recive_username);
        
        //设置收件的地址可同时发送多个
        $this->mail->AddAddress($recive, $this->recive_name);
        
        //添加附件，此处附件与脚本位于相同目录下,否则填写完整路径
        //$this->mail->AddAttachment("attachment.zip");
    
        //使用HTML格式发送邮件
        $this->mail->IsHTML(true);
        $this->mail->AltBody = "text/html";
    }
    
    
    /**
     * 通过Send方法发送邮件,根据发送结果做相应处理
     */
    public function send()
    {
        return $this->mail->send();
    }
    
    
    /**
     * 解析xml数据
     */
    public function getXml($module)
    {
        $file_name = $module.'_mail.xml';
        $xml       = simplexml_load_file($file_name);
        
        //读取xml
        $this->host            = $xml->host;
        $this->port            = $xml->port;
        $this->username        = $xml->username;
        $this->password        = $xml->password;
        $this->outtitle        = $xml->outtitle;
        $this->title           = $xml->title;
        $this->content         = $xml->content;
        $this->line            = $xml->line;
        
        $this->recive_name     = $xml->recive_name;
        $this->recive_address  = $xml->recive_address;
        $this->recive_username = $xml->recive_username;
    }
    

    
    
    /**
     * 表单参数获取
     */
    public function getParam()
    {
        $this->host            = request()->param('host');
        $this->port            = request()->param('port');
        $this->username        = request()->param('username');
        $this->password        = request()->param('password');
        $this->outtitle        = request()->param('outtitle');
        $this->title           = request()->param('title');
        $this->content         = request()->param('content');
        $this->line            = request()->param('line');
        
        $this->recive_name     = request()->param('recive_name');
        $this->recive_address  = request()->param('recive_address');
        $this->recive_username = request()->param('recive_username');
        
    }
    
    
    /**
     * XML init
     * xml配置文件写入
     */
    public function setXml($module)
    {
        //文件处理
        $file_name = $module.'_mail.xml';
        if (!file_exists($file_name)){
    
            $xml_prepare = '<?xml version="1.0" encoding="UTF-8"?><'.$module.'></'.$module.'>';
            $file_return = file_put_contents($file_name, $xml_prepare);
    
            if (!$file_return) $this->error('XML '.$module.' file write error.');
        }
    
        $xml = simplexml_load_file($file_name);
    
        //写入XML
        $xml->host             = $this->host            ? $this->host            : 'smtp.163.com';
        $xml->port             = $this->port            ? $this->port            : '25';
        $xml->username         = $this->username        ? $this->username        : '123@163.com';
        $xml->password         = $this->password        ? $this->password        : '1234';
        $xml->outtitle         = $this->outtitle        ? $this->outtitle        : '你好';
        $xml->title            = $this->title           ? $this->title           : '你好,我是Ferre';
        $xml->content          = $this->content         ? $this->content         : '你好,这里是Alexa-Admin.';
        $xml->line             = $this->line            ? $this->line            : 20;
        
        $xml->recive_name      = $this->recive_name     ? $this->recive_name     : session('user_data')['email'];
        $xml->recive_address   = $this->recive_address  ? $this->recive_address  : '123@163.com';
        $xml->recive_username  = $this->recive_username ? $this->recive_username : 'Ferre'; //Ferre To Alexa.
        
        $res = $xml->asXML($file_name);
    }
    
    
    /*
     * 邮件开启服务
     */
    public static function isMail()
    {
        $is_mail_obj = System::field('is_mail')->find(1);
        return $is_mail_obj->is_mail;
    }
    
    
}
