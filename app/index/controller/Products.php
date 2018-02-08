<?php
namespace app\index\controller;

use app\index\common\Base;
use think\Request;

class Products extends Base
{
    
    /**
     * 产品展示页
     */
    public function index()
    {
        $pro = db('article')
             ->field('a.*, b.catename')
             ->alias('a')
             ->join('heater_category b', 'a.cate=b.id')
             ->find(input('id'));
        
        $this->view->assign('pro', $pro);
        return $this->view->fetch();
    }
    
    /*
     * 返回文件名
     */
    private function fileName(Request $request)
    {
        return ROOT_PATH . 'public' . DS . $request->controller() . DS . $request->action() . DS . $request->ip();
    }
    
    public function bar1(Request $request)
    {
        if ($request->isPost()){
            
            $file = $request->file('heater');
            $path = $this->fileName($request);
            
            if ($file){
                $info = $file->validate(['ext'=>'XLS,XLSX,xls,xlsx'])->move($path);
                if ($info){
                    //TODO 处理Excel
                    
                }else{
                    //上传失败获取错误信息
                    $this->error($file->getError());
                }
            }
        }
    }
    
    
    
    
}
