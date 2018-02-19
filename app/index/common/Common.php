<?php
namespace app\index\common;

use think\Controller;
use think\Request;

class Common extends Controller
{
    /*
     * 返回文件名
     */
    public function fileName(Request $request)
    {
        return ROOT_PATH . 'public' . DS . $request->controller() . DS . $request->action() . DS . $request->ip();
    }

    public function fileUpload(Request $request)
    {
        if ($request->isPost()){

            $file = $request->file('heater');
            $path = $this->fileName($request);

            if ($file){
                $info = $file->validate(['ext'=>'XLS,XLSX,xls,xlsx'])->move($path);
                if ($info){
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
        } catch(\Exception $e) {
            $this->error('加载文件发生错误："'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        // 确定要读取的sheet，sheet为excel的左下角的表数量
        $sheet         = $objPHPExcel->getSheet(0);     // 读取第一个工作表
        $highestRow    = $sheet->getHighestRow();       // 取得总行数
        $highestColumn = $sheet->getHighestColumn();    // 取得总列数

        return [
            'highestRow'    => $highestRow,
            'sheet'         => $sheet,
            'highestColumn' => $highestColumn
        ];
    }

    //TODO 处理Excel
    public function getArr(Request $request)
    {
        $res_data = [];

        $excel = $this->excelPrepare($request);

        // 获取第2行的数据
        for ($row = 2; $row <= $excel['highestRow']; $row ++){
            // Read a row of data into an array
            $rowData = $excel['sheet']->rangeToArray('A' . $row . ':' . $excel['highestColumn'] . $row, NULL, TRUE, FALSE);
            $rowData = current($rowData);
            //这里得到的rowData都是一行的数据，得到数据后自行处理，我们这里只打出来看看效果
            $res_data[] = $rowData;
        }
        cookie('excel_data', array_values($res_data), config('index_module.cookie_time'));
//         return array_values($res_data);
    }
}
