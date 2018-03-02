<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;

use think\Request;

class Article extends Base
{
    /**
     * TIP:存放除products外所有的文章分类
     */
    
    public function _initialize()
    {
        parent::_initialize();
        //右侧cate显示
        $cate        = db('category')->field('id, catename')->where('pid != 0')->cache(config('index_module.cache'))->select();

        $art_model   = new ArticleModel();
        $cate_model  = new CategoryModel();
        $product_id  = $cate_model->findCateId();
        $right_posts = $art_model->field('id, thumb, title, desc')
                                 ->where('cate', 'not in', $product_id)
                                 ->cache(config('index_module.cache'))
                                 ->order('time', 'desc')
                                 ->limit(3)
                                 ->select();
        $this->view->assign([
            'cate'        => $cate,
            'right_posts' => $right_posts,
        ]);
    }
    
    /**
     * cate搜索页
     * @return string
     */
    public function cateSearch()
    {
        $id = input('id');

        //多页面和单页面
        $cate    = new CategoryModel();
        $cate_id = $cate->getCate($id);
        
        //为process || 没有子分类且文章为1或0
        if (count($cate_id) < 2 && count(db('article')->where('cate', $cate_id)->select()) < 2){
            $arti = db('article')
                 ->field('a.title, a.content, a.thumb, a.desc,b.catename')
                 ->alias('a')
                 ->join('heater_category b','a.cate=b.id')
                 ->order('a.order desc')
                 ->cache(config('index_module.cache'))
                 ->where('cate', $cate_id)->find();
        }else {
            $arti = db('article')
                 ->field('a.id,a.thumb,a.desc,a.title,a.tag,a.time,a.cate,a.content,b.catename')
                 ->alias('a')
                 ->join('heater_category b','a.cate=b.id')
                 ->order('a.order desc')
                 ->where('b.id', 'in', $cate_id)
                 ->cache(config('index_module.cache'))
                 ->paginate(config('index_module.propage'));
        }
        
        //当前分类的id和pid
        $my_id    = db('category')->field('id, pid')->cache(config('index_module.cache'))->find($id);
        //catename
        $category = db('category')->field('id, catename')->cache(config('index_module.cache'))->find($id);
        
        
        if ($id == config('index_module.cateprocess')){
            $template = 'process';
        }elseif (!is_object($arti) && count($cate_id) < 2){
            $template = 'single-page';
        }elseif (config('index_module.productid') == $my_id['id'] || config('index_module.productid') == $my_id['pid']){    //只存在一篇或不存在文章 && 还没有子栏目,那么这就是单文章页面
            $template = 'multi-products';
        }else {
            $template = 'multi-blog';
        }
        
        //product页面时
        if ($template == 'multi-products'){
            $cate_id = $cate->getCate(2);   //找到所有products的id和子id
            $bot_pro = db('article')
                     ->field('a.id,a.thumb,a.desc,a.title,a.tag,a.time,a.cate,a.content,b.catename')
                     ->alias('a')
                     ->join('heater_category b','a.cate=b.id')
                     ->order('a.time desc')
                     ->where('b.id', 'in', $cate_id)
                     ->cache(config('index_module.cache'))
                     ->limit(8)
                     ->select();
            $this->view->assign('bot_pro', $bot_pro);
        }
        
        $this->view->assign([
            'arti'      => $arti,
            'category'  => $category,
        ]);
        
        return $this->view->fetch($template);
    }

    
    /**
     * normal文章数据显示
     */
    public function blog(Request $request)
    {
        $model      = new ArticleModel();
        $blog       = $model->blogData(input('id'));
        
        //处理浏览数据
        $this->artSee($request, input('id'));
        
        $this->view->assign([
            'blog' => $blog,
        ]);

        return $this->view->fetch('blog');
    }
    

    /**
     * tag/keywords/desc/title 都可以作为搜索依据
     * @param Request $request
     */
    public function search(Request $request)
    {
        //对恶意的多个参数查询处理
//         if (count($request->param()) > 1){
//             $this->redirect('index/index/index');
//         }
    
        //参数值处理成字符串
        $arr = $request->param();
        if (!empty($arr['search'])){
            $map = $arr['search'];
        }elseif (!empty($arr['keywords'])) {
            $map = $arr['keywords'];
        }elseif (!empty($arr['tag'])){
            $map = $arr['tag'];
        }
        
        $category   = new CategoryModel();
        $pro_cateid = $category->findCateId();
        
        //对tag/keywords title/desc的查询
        if (!empty($arr['keywords']) || !empty($arr['tag'])){
            $art = db('article')
                   ->field('id,thumb,desc,title,tag,time,cate,content')
                   ->where('tag|keywords', 'like', '%'.$map.'%')
                   ->whereNotIn('cate', $pro_cateid)
                   ->cache(config('index_module.cache'))
                   ->paginate(config('index_module.searchpage'), false, ['query' => $request->param()]);
        }elseif (!empty($arr['search'])){
            $art = db('article')
                   ->field('id,thumb,desc,title,tag,time,cate,content')
                   ->where('title|desc', 'like', '%'.$map.'%')
                   ->whereNotIn('cate', $pro_cateid)
                   ->cache(config('index_module.cache'))
                   ->paginate(config('index_module.searchpage'), false, ['query' => $request->param()]);
        }
        
        $this->view->assign([
            'arti'  => $art,
        ]);
        
        return $this->view->fetch('multi-blog');
    }
    

    public function artSee(Request $request, $rid)
    {
        $see_time  = db('artsee')->field('time')->where('ip', $request->ip())->order('time', 'desc')->find();
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
