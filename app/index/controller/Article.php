<?php
namespace app\index\controller;

use app\index\common\Base;
use app\index\model\Article as ArticleModel;

class Article extends Base
{
    /**
     * TIP:存放除products外所有的文章分类
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
    
}
