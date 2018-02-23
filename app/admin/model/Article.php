<?php
namespace app\admin\model;
use think\Model;
use think\Request;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Storage\BucketManager;
use Qiniu\Config;

class Article extends Model
{
    /**
     *对文章图片的处理 
     */
    
    protected static function init(){
        Article::event('before_insert', function($_data){
            if (self::getSystem()['type'] == config('website.local')){
                if(@$_FILES['thumb']['tmp_name']){
                    
                    $_file = request()->file('thumb');
                    $_info = $_file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    if ($_info){    //upload success
                        $detail_pic     = 'uploads/'.$_info->getSaveName();  //缩略图原图地址
                        //pic zip
                        $ferreImg       = new \ferreImgDetail();
                        $ferrePath      = 'uploads/thumb';
                        $ferrePic       = $ferreImg->cutImg($detail_pic, 570, 750, 'alexa', 20, $ferrePath);    //具体详见参数
                        $_data['thumb'] = '/uploads/thumb/'.$ferrePic;
                        $_data['pic']   = '/uploads/' . $_info->getSaveName();
                        return $_data['thumb'] ? ['err' => 0, 'msg' => '上传完成', 'data' => $_data['thumb']] : ['err' => 1, 'msg' => '本地上传失败', 'data' => ''];
                    }
                }
            }elseif (self::getSystem()['type'] == config('website.qiniu')){
                
                    $file = request()->file('thumb');
                    //本地路径
                    $filePath = $file->getRealPath();
                    //获取后缀
                    $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
                    //上传到七牛后保存的文件名(加盐)
                    $key = config('qiniu.salt').substr(md5($file->getRealPath()) , 0, 5). date('YmdHis') . rand(0, 9999) . '.' . $ext;
                    //构建鉴权对象
                    $auth = new Auth(config('qiniu.ak'), config('qiniu.sk'));
                    //要上传的空间
                    $token = $auth->uploadToken(config('qiniu.bucket'));
                    //初始化uploadmanager对象并进行文件的上传
                    $uploadMgr = new UploadManager();
                    //调用uploadmanager的putfile方法进行文件的上传
                    list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
                    $_data['pic']    = config('qiniu.domain').'/'.$ret['key'];
                    $err ? $_data['thumb'] = '图片上传失败' : $_data['thumb'] = config('qiniu.domain').'/'.$ret['key'];
                    $_data['thumb']  = 'http://'.$_data['thumb'];
            }elseif (self::getSystem()['type'] == config('website.oss')){
                //TODO 阿里云OSS上传功能
            }
            
            
        });
        

        
        Article::event('before_update', function($_data){
            $_arts = Article::find($_data->id);
            
            if (self::getSystem()['type'] == config('website.local')){
                if($_FILES['thumb']['tmp_name']){
                    $_thumbpath = $_SERVER['DOCUMENT_ROOT'].$_arts['thumb'];
                    if(file_exists($_thumbpath)){
                        @unlink($_thumbpath);
                    }
                    $_file = request()->file('thumb');
                    $_info = $_file->move(ROOT_PATH . 'public' . DS . 'uploads');
                    if ($_info){
                        $detail_pic     = 'uploads'.'/'.$_info->getSaveName();  //缩略图原图地址
                        //pic zip
                        $ferreImg       = new \ferreImgDetail();
                        $ferrePath      = 'uploads/thumb';
                        $ferrePic       = $ferreImg->cutImg($detail_pic, 390, 490, 'alexa', 20, $ferrePath);
                        $_data['thumb'] = '/uploads/thumb/'.$ferrePic;
                        $_data['pic']   = '/uploads/' . $_info->getSaveName();
                        @unlink($_SERVER['DOCUMENT_ROOT'].$_arts['pic']);
                    }
                }
            }elseif (self::getSystem()['type'] == config('website.qiniu')){
                //首先删除图片
                //构建鉴权对象
                $auth      = new Auth(config('qiniu.ak'), config('qiniu.sk'));
                $config    = new Config();
                $bucketMgr = new BucketManager($auth, $config);
                $key       = explode('/', $_arts['thumb'])[1];
                $bucketMgr->delete(config('qiniu.bucket'), $key);   //删除图片
                
                
                
                //上传图片
                $file = request()->file('thumb');
                //本地路径
                $filePath = $file->getRealPath();
                //获取后缀
                $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
                //上传到七牛后保存的文件名(加盐)
                $key = config('qiniu.salt').substr(md5($file->getRealPath()) , 0, 5). date('YmdHis') . rand(0, 9999) . '.' . $ext;
                //要上传的空间
                $token = $auth->uploadToken(config('qiniu.bucket'));
                //初始化uploadmanager对象并进行文件的上传
                $uploadMgr = new UploadManager();
                //调用uploadmanager的putfile方法进行文件的上传
                list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);



                $err ? $_data['thumb'] = '图片上传失败' : $_data['thumb'] = config('qiniu.domain').'/'.$ret['key'];
                $_data['thumb']  = 'http://'.$_data['thumb'];
            }
                
        });
        
        Article::event('before_delete', function($_data){
            
            $_arts = Article::find($_data->id); //按照id找到待修改图片的id值，为了进一步的修改图片位置
            
            if (self::getSystem()['type'] == config('website.local')){
                $_thumbpath = $_SERVER['DOCUMENT_ROOT'].$_arts['thumb'];
                if(file_exists($_thumbpath)){
                    @unlink($_thumbpath);
                    @unlink($_SERVER['DOCUMENT_ROOT'].$_arts['pic']);
                }
            }elseif (self::getSystem()['type'] == config('website.qiniu')){
                $auth      = new Auth(config('qiniu.ak'), config('qiniu.sk'));
                
                $config    = new Config();
                
                $bucketMgr = new BucketManager($auth, $config);
                $key       = explode('/', $_arts['thumb'])[1];
                $err       = $bucketMgr->delete(config('qiniu.bucket'), $key);
//                 if ($err) {
//                     halt($err);
//                 }else {
//                     return true;
//                 }
                
                   
            }

                
        });
        
        
    }
    
    /**
     * 后面会对系统表和写法进行重构，现在先使用此操作取数据
     * @return \think\db\false|PDOStatement|string|\think\Model
     */
    public static function getSystem()
    {
        return db('system')->find();
    }
}