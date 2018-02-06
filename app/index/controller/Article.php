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
        
        //没有子分类且文章为1或0
        if (count($cate_id) < 2 && count(db('article')->where('cate', $cate_id)->select()) < 2){
            $art = db('article')
                 ->field('a.*,b.catename')
                 ->alias('a')
                 ->join('heater_category b','a.cate=b.id')
                 ->order('a.order desc')
                 ->where('cate', $cate_id)->find();
        }else {
            $art = db('article')
                 ->field('a.id,a.thumb,a.desc,a.cate,b.catename')
                 ->alias('a')
                 ->join('heater_category b','a.cate=b.id')
                 ->order('a.order desc')
                 ->where('b.id', 'in', $cate_id)
                 ->paginate(config('index_module.propage'));
        }
        
        $my_id = db('category')->field('id, pid')->find($id);
        
        //catename
        $category = db('category')->field('id, catename')->find($id);
        
        //只存在一篇或不存在文章 && 还没有子栏目,那么这就是单文章页面
        if (!is_object($art) && count($cate_id) < 2){
            $template = 'single-page';
        }elseif ($my_id['id'] == config('index_module.productid') || $my_id['pid'] == config('index_module.productid')){
            $template = 'multi-products';
        }else {
            $template = 'multi-blog';
        }
        
        $this->view->assign([
            'art'      => $art,
            'category' => $category,
        ]);
        
        return $this->view->fetch($template);
    }

    
//     /**
//      * 单页面
//      */
//     public function singlePage()
//     {
//         $art = db('article')
//              ->field('a.id, a.title, a.content, b.catename')
//              ->alias('a')
//              ->join('heater_category b', 'a.cate=b.id')
//              ->find(input('id'));
        
//         $this->view->assign('art', $art);
        
//         return $this->view->fetch('single-page');
//     }
    
    /**
     * normal文章数据显示
     */
    public function blog()
    {
        $model = new ArticleModel();
        $blog  = $model->blogData(input('id'));
        $cate  = db('category')->field('id, catename')->where('pid != 0')->select();
        $this->view->assign([
            'blog' => $blog,
            'cate' => $cate,
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
        if (count($request->param()) > 1){
            $this->redirect('index/index/index');
        }
    
        //参数值处理成字符串
        $arr = $request->param();
        $map = implode('', array_values($arr));
        
        //对tag/keywords title/desc的查询
        if (in_array(implode('', array_keys($request->param())), ['tag', 'keywords'])){
            $art = db('article')
                   ->field('id,thumb,desc,cate')
                   ->where('tag|keywords', 'like', '%'.$map.'%')
                   ->select();
        }elseif (implode('', array_keys($request->param())) == 'search'){
            $art = db('article')
                   ->field('id,thumb,desc,cate')
                   ->where('title|desc', 'like', '%'.$map.'%')
                   ->select();
        }
        
        $this->view->assign([
            'art' => $art,
        ]);
        
        return $this->view->fetch('multi-blog');
    }
    

    
}
