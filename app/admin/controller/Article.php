<?php

namespace app\admin\controller;

use think\Request;
use app\admin\common\Base;
use think\Loader;
use app\admin\model\Article as ArticleModel;
use think\Validate;
use app\admin\model\System;

class Article extends Base
{
    
    /**
     * 前置操作
     */
//     protected $beforeActionList  = [
//         'mailServe' => ['only' => 'delete'],    //前置操作的方法请勿在前添加空格
//     ];
    
    
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $article = db('article')->field('a.*,b.catename')->alias('a')->join('heater_category b','a.cate=b.id')->order('a.id desc')->paginate(config('conf.page'));
        $count   = db('article')->count();
        //search function
        if ($request->isPost()){
            $search  = $request->param();
            
            if (empty($search['start']) || empty($search['end'])){
                $article = db('article')->field('a.*,b.catename')->alias('a')->join('heater_category b','a.cate=b.id')->order('a.id desc')
                                        ->where('title', 'like', '%'.$search['title'].'%')->paginate(config('conf.page'));
                
            }else {
                $article = db('article')->field('a.*,b.catename')->alias('a')->join('heater_category b','a.cate=b.id')->order('a.id desc')
                                        ->where('time', 'between', [strtotime($search['start']), strtotime($search['end'])])
                                        ->where('title', 'like', '%'.$search['title'].'%')->paginate(config('conf.page'));
                
            }
        }
        
        //list
        $this->view->assign([
            'article' => $article,
            'count'   => $count,
        ]);
        return $this->view->fetch('article-list');
    }


    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function add(Request $request)
    {
        //add
        if ($request->isPost()){
            
            $token        = Validate::token('__token__','',['__token__'=>input('param.__token__')]);    //CSRF validate
            if (!$token) $this->error('CSRF ATTACK.');
            
            $data = input('post.');
            //处理tag
            $data['tag']  = implode(',', $data['tag']);
            $data['time'] = time();
            
            $validate = Loader::validate('Article');
            
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            
            $article = new ArticleModel();
            if($article->allowField(true)->save($data)){
                $this->redirect('admin/article/index');
            }else{
                $this->error('添加失败');
            }
            return;
        }
        
        //page
        $system = System::find(1);
        $cate   = db('category')->field(['id', 'catename'])->order('sort', 'asc')->select();
        
        //处理tag
        $tag    = explode(',', $system->tag);
        
        $this->view->assign([
            'cate' => $cate,
            'tag'  => $tag,
        ]);
        
        return $this->view->fetch('article-add');
    }
    


    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->isPost()){
            
            $data = $request->param();
            $validate = Loader::validate('Article');
            
            //处理tag
            $data['tag']  = implode(',', $data['tag']);
            
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            
            $article = new ArticleModel;
            $save=$article->update($data);
            
            if($save){
                $this->redirect('admin/article/index');
//                 $this->success('修改文章成功！',url('admin/article/index'));
            }else{
                $this->error('修改文章失败！');
            }
            return;
        }
        
        //cate data && article data
        $cate    = db('category')->field(['id', 'catename'])->order('sort', 'asc')->select();
        $article = db('article')->find($id);
        
        $system  = System::find(1);
        $tag     = explode(',', $system->tag);   //处理系统tag
        $art_tag = explode(',', $article['tag']);//文章tag
        
        //七牛图片处理
//         if (!empty($article['thumb']) && substr($article['thumb'], 1, 7) != 'uploads') {
//             $article['thumb'] = 'http://'.$article['thumb'];
//         }
        
        $this->assign([
            'cate'    => $cate,
            'article' => $article,
            'tag'     => $tag,
            'art_tag' => $art_tag,
        ]);
        
        return $this->view->fetch('article-edit');
    }


    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        if(ArticleModel::destroy($id)){
            $this->success('删除文章成功！',url('admin/article/index'));
        }else{
            $this->error('删除文章失败！');
        }
    }
    
    
    
    //七牛test
    //     public function upload(Request $request)
    //     {
    
    //         if ($request->isPost()){
    
    //             $file = $request->file('thumb');
    //             //本地路径
    //             $filePath = $file->getRealPath();
    //             //获取后缀
    //             $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);
    //             //上传到七牛后保存的文件名(加盐)
    //             $key = config('salt.password_salt').substr(md5($file->getRealPath()) , 0, 5). date('YmdHis') . rand(0, 9999) . '.' . $ext;
    
    //             $ak = config('qiniu.ak');
    //             $sk = config('qiniu.sk');
    
    //             //构建鉴权对象
    //             $auth = new Auth($ak, $sk);
    //             //要上传的空间
    //             $bucket = config('qiniu.bucket');
    //             $domain = config('qiniu.domain');
    //             $token = $auth->uploadToken($bucket);
    
    //             //初始化uploadmanager对象并进行文件的上传
    //             $uploadMgr = new UploadManager();
    
    //             //调用uploadmanager的putfile方法进行文件的上传
    //             list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
    
    //             if ($err !== null){
    //                 return ['err' => 1, 'msg' => $err, 'data' => ''];
    //             }else {
    //                 //返回图片的完整URL
    //                 return ['err' => 0, 'msg' => '上传完成', 'data' => ($domain.'/'.$ret['key'])];
    //             }
    
    //         }
    
    //     }
    
}
