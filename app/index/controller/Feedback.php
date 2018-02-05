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
            $res ? $this->redirect('index/index/index') : $this->error('Pls contact Admin');
        }
    }
    
    
    
    /**
     * 邮件服务
     */
    public function mailServe($email, $content)
    {
        if (Mail::isMail() == config('mail.close')) return true;
    
        //         $user_email = session('user_data')['email'];
    
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
