<?php

class ferreImgDetail
{
    public $suffix = array('JPG', 'JPEG', 'BMP', 'PCX', 'TIFF', 'GIF', 'JPEG', 'TGA', 'EXIF', 'FPX', 'SVG', 'PSD', 'CDR', 'PCD', 'DXF', 'UFO', 'EPS', 'AI', 'PNG', 'HDRI', 'RAW', 'WMF', 'LIC', 'EMF');
    
    
    /**
     * pic zip
     * @param unknown $background
     * @param unknown $new_width
     * @param unknown $new_height
     * @param unknown $newfile
     * @param unknown $quality
     * @return string
     */
    public function cutImg($background, $new_width, $new_height, $newfile, $quality = 60, $filedir = 'ferreImg')
    {
        $back_fir   = explode('.', $background)[0];
        $back_las   = explode('.', $background)[1];
        if (!in_array(strtoupper($back_las), $this->suffix)){
            die('Picture Format Error');
        }
        
        //处理图片类型
        @$alia      = isset($back_las) ? $back_las : die('Pic File Not Exists!');               //源文件名处理
        @$now_alia  = isset(explode('.', $newfile)[0]) ? explode('.', $newfile)[0] : $newfile;  //新文件名处理
        $newfile    = $now_alia.time().sha1($_SERVER['REMOTE_ADDR']).'.'.$alia;                 //高并发的文件名处理
        
        list($s_w, $s_h) = getimagesize($background);   //获取原图片高度、宽度
        if ($new_width && ($s_w < $s_h)) {
            $new_width   = ($new_height / $s_h) * $s_w;
        } else {
            $new_height  = ($new_width / $s_w) * $s_h;
        }
        
        $new        = imagecreatetruecolor($new_width, $new_height);
        switch (strtoupper($back_las))
        {
            case 'JPEG':
                $img    = imagecreatefromjpeg($background);
                break;
            case 'JPG':
                $img    = imagecreatefromjpeg($background);
                break;
            case 'PNG':
                $img    = imagecreatefrompng($background);
                break;
            case 'GIF':
                $img    = imagecreatefromgif($background);
                break;
            default:
                die('Sorry,Now we can only detail JPEG/JPG/PNG/GIF Format!');
        }
        
        imagecopyresampled($new, $img, 0, 0, 0, 0, $new_width, $new_height, $s_w, $s_h);        //图片裁剪替换
        
        switch (strtoupper($back_las))
        {
            case ('JPEG' || 'JPG'):
                imagejpeg($new, $newfile, $quality);
                break;
            case 'PNG':
                imagepng($new, $newfile, $quality);
                break;
            case 'GIF':
                imagegif($new, $newfile, $quality);
                break;
            default:
                die('Sorry,Now we can only detail JPEG/JPG/PNG/GIF Format!');
        }
        imagedestroy($new);
        imagedestroy($img);
        
        //转移图片到指定目录
        $this->moveDir($newfile, $filedir);
        
        return $newfile;
    }
    
    /**
     * pic move
     * @param unknown $filename
     * @param unknown $filedir
     */
    public function moveDir($filename, $filedir)
    {
        if (!is_dir($filedir)){
            $mkres = mkdir($filedir);
            if ($mkres == false){
                die('You do not have permission to create directories!');
            }
        }
        
        $res = copy($filename, $filedir . '/' . $filename);
        $res == true ? unlink($filename) : die('New File Not Move Success!');
    }
}
    
?>