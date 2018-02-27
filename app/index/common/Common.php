<?php
namespace app\index\common;

use think\Controller;
use think\Request;
use think\Cookie;

class Common extends Controller
{
    /*
     * 返回文件名
     */
    public function fileName(Request $request)
    {
//         return ROOT_PATH . 'public' . DS . $request->controller() . DS . $request->action() . DS . $request->ip();
        return ROOT_PATH . 'public' . DS . 'Products';
    }
    
    public function fileUpload(Request $request)
    {
        if ($request->isPost()){

            $file = $request->file('heater');
            $path = $this->fileName($request);

            if ($file){
                $info = $file->validate(['ext'=>'XLS,XLSX,xls,xlsx'])->move($path);
                if ($info){
                    cookie('heater_file_name', $info->getRealPath(), config('index_module.cookie_time'));
                    return $info->getRealPath();
                }else{
                    //上传失败获取错误信息
                    $this->error($file->getError());
                }
            }
        }
    }

    //excelPrepare
    public function excelPrepare(Request $request)
    {
        $inputFileName = $this->fileUpload($request);
        date_default_timezone_set('PRC');
        // 读取excel文件
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader     = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel   = $objReader->load($inputFileName);
            
            //获取所有表的表名
            $sheet_name = [];
            foreach($objPHPExcel->getSheetNames() as $name){//循环获取到的工作表名称
                $sheet_name[] = $name;
            }
            
        } catch(\Exception $e) {
            $this->error('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        // 确定要读取的sheet，sheet为excel的左下角的表数量
        $sheet         = $objPHPExcel->getSheet(0);     // 读取第一个工作表
        $highestRow    = $sheet->getHighestRow();       // 取得总行数
        $highestColumn = $sheet->getHighestColumn();    // 取得总列数
        
        //表名写入cookie
        cookie('sheet_name', array_values($sheet_name), config('index_module.cookie_time'));
        
        return [
            'highestRow'    => $highestRow,
            'sheet'         => $sheet,
            'highestColumn' => $highestColumn,
        ];
    }

    //TODO 处理Excel
    public function getArr(Request $request)
    {
        $res_data = [];

        $excel = $this->excelPrepare($request);

        // 获取第1行的数据
        for ($row = 1; $row <= $excel['highestRow']; $row ++){
            // Read a row of data into an array
            $rowData = $excel['sheet']->rangeToArray('A' . $row . ':' . $excel['highestColumn'] . $row, NULL, TRUE, FALSE);
            $rowData = current($rowData);
            //生成数列
            $res_data[] = $rowData;
        }
        
        cookie('excel_data', array_values($res_data), config('index_module.cookie_time'));
        
        if (file_exists(Cookie::get('heater_file_name'))){
            @unlink(Cookie::get('heater_file_name'));
        }
//         return array_values($res_data);
    }
    
    
    

    /**
     * 判断读取Excel数据
     */
    public function checkExcel()
    {
        if (is_null(Cookie::get('excel_data'))){
            $this->error('请重复导入Excel数据');
        }
    }
    
    /**
     * 表单数据的提取
     * @param Request $request
     */
    public function getForm(Request $request)
    {
        //未选择文件的处理
        if ($request->file('heater')){
            $this->getArr($request);
        }
    }
    
    /**
     * 去除数组中的空元素
     * @param unknown $arr
     */
    public function deleteEmpty($arr)
    {
        return array_filter($arr, create_function('$v', 'return !empty($v);'));
    }
    
}
