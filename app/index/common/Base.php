<?php
namespace app\index\common;

use think\Controller;
use app\admin\model\System;
use app\index\model\Article as ArticleModel;
use think\Request;


class Base extends Controller
{
    
    public function _initialize()
    {
        $this->cate();
        
        //system数据
        $art        = new ArticleModel();
        $system     = new System();
        $sys        = $system->getSys();
        $baseblog   = $art->footerPost();
        $link       = db('link')->field('name, url')->order('sort', 'desc')->select();
        $basetag    = explode(',', $sys['tag']);
        $this->view->assign([
            'sys'      => $sys,
            'baseblog' => $baseblog,
            'basetag'  => $basetag,
            'link'     => $link,
        ]);
    }
    
    /**
     * 获取前台导航栏
     */
    public function cate(){
        $cateres   = db('category')->where(['pid' => 0])->order('sort', 'asc')->select(); //顶级分类的pid=0    cache(config('index_module.cache'))->
        foreach ($cateres as $k => $v){
            $child = db('category')->where(['pid' => $v['id']])->order('sort', 'asc')->select();    //->cache(config('index_module.cache'))
            if($child){    //如果存在子级栏目
                $cateres[$k]['child'] = $child;
            }else{
                $cateres[$k]['child'] = 0;
            }
        }
        
        $this->view->assign('cateres',$cateres);
    }
    
    public function getBrowser()
    {
    
        switch ($_SERVER['HTTP_USER_AGENT'])
        {
            case null:
                return 'machine';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9.0'):
                return 'ie9';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8.0'):
                return 'ie8';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 7.0'):
                return 'ie7';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0'):
                return 'ie6';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Firefox'):
                return 'fox';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Chrome'):
                return 'chrome';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Safari'):
                return 'safari';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'Opera'):
                return 'opera';
                break;
    
            case false !== strpos($_SERVER['HTTP_USER_AGENT'],'360SE'):
                return '360se';
                break;
    
            default:
                return 'notidentify';
                break;
    
        }
    
    }
    
    public function artSee(Request $request, $rid)
    {
        $see_time  = db('artsee')->field('time')->where('ip', $request->ip())->where('rid', $rid)->order('time', 'desc')->find();
        
        if (empty($see_time)){    //(time() - $see_time['time']) > 30 ||
    
            //sina地理位置接口
            $area      = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip={$request->ip()}");
            $arr_data  = json_decode($area, true);
            $error     = json_last_error();
    
            //json是否存在错误
            if (!empty($error)) {
                $see = [
                    'type'     => $this->getBrowser(),
                    'rid'      => $rid,
                    'ip'       => $request->ip(),
                    'country'  => '',
                    'province' => '',
                    'city'     => '',
                    'time'     => time(),
                ];
            }else {
                $see = [
                    'type'     => $this->getBrowser(),
                    'rid'      => $rid,
                    'ip'       => $request->ip(),
                    'country'  => $arr_data['country'],
                    'province' => $arr_data['province'],
                    'city'     => $arr_data['city'],
                    'time'     => time(),
                ];
            }
            db('artsee')->insert($see);
        }
    
    }
    
    
}
