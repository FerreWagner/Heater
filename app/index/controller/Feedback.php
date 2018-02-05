<?php
namespace app\index\controller;

use app\index\common\Base;
use app\admin\common\Mail;
use think\Request;
use think\Validate;
use app\index\model\Feedback as FeedbackModel;

class Feedback extends Base
{
    
    public function add(Request $request)
    {
        if ($request->isPost()){
            
            $token      = Validate::token('__token__','',['__token__'=>input('param.__token__')]);    //CSRF validate
            if (!$token) $this->error('CSRF ATTACK.');
            
            $data = $request->param();
            $data['time'] = time();
            $data['ip']   = $_SERVER['REMOTE_ADDR'];
            
            $validate = new Validate([
                'name'  => 'require|max:20',
                'email' => 'require|max:30|email',
            ]);
            
            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }

            $model = new FeedbackModel();
            $res   = $model->indexAdd($data);
            
            $this->feedMail('1573646491@qq.com', '名为'.$data['name'].'的用户'.$data['email'].'在'.date("Y-m-d H:i:s",time()).'向您反馈了消息:'.$data['message']);
            
            $res ? $this->success('您的信息已发送至管理员邮箱,谢谢您的反馈.', 'index/index/index') : $this->error('Pls contact Admin');
        }
    }
    
    
    
    /**
     * 邮件服务
     */
    public function feedMail($email, $content)
    {
        if (Mail::isMail() == config('mail.close')) return true;
    
        $mail = new Mail();
        $mail->getXml('admin');
        $mail->init();
        $mail->content($content);
        $mail->replay($email);
    
        if (!$mail->send()){
            $this->error('Mail Server Error.');
        }
    
    }
}
