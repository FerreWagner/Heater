<?php
namespace app\index\controller;

use app\index\common\Base;

class Article extends Base
{
    /**
     * TIP:存放除products外所有的文章分类
     */
    
    public function design()
    {
        $design = db('article')->field('id, title, content')->find(input('id'));
        $this->view->assign('design', $design);
        return $this->view->fetch('design');
    }
    
}
