<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as IndexCate;

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
        if (!in_array($id, config('index_module.singlepage'))){
            $cate    = new IndexCate();
            $cate_id = $cate->getCate($id);
    
            $art = db('article')
                 ->field('a.id,a.thumb,a.desc,b.catename')
                 ->alias('a')
                 ->join('heater_category b','a.cate=b.id')
                 ->order('a.order desc')
                 ->where('b.id', 'in', $cate_id)
                 ->paginate(config('index_module.propage'));
        }else {
            $art = db('article')->where('id', $id)->select();
        }
    
        //catename
        $category = db('category')->field('id, catename')->find($id);
    
        $this->view->assign([
            'art'      => $art,
            'category' => $category,
        ]);
    
        $template = in_array($id, config('index_module.singlepage')) ? 'single' : 'multi';
        return $this->view->fetch($template);
    }

    
    /**
     * 单页面
     */
    public function singlePage()
    {
        $art = db('article')
             ->field('a.id, a.title, a.content, b.catename')
             ->alias('a')
             ->join('heater_category b', 'a.cate=b.id')
             ->find(input('id'));
        
        $this->view->assign('art', $art);
        
        return $this->view->fetch('single-page');
    }
    
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
                   ->field('id,thumb,desc')
                   ->where('tag|keywords', 'like', '%'.$map.'%')
                   ->select();
        }elseif (implode('', array_keys($request->param())) == 'search'){
            $art = db('article')
                   ->field('id,thumb,desc')
                   ->where('title|desc', 'like', '%'.$map.'%')
                   ->select();
        }
        
        $this->view->assign([
            'art' => $art,
        ]);
        
        return $this->view->fetch('multi');
    }
    

    
}
