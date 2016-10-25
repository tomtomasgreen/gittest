<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');
class PIC{
    function random($len) {
        $srcstr = "1a2s3d4f5g6hj8k9qwertyupzxcvbnm";
        mt_srand();
        $strs = "";
        for ($i = 0; $i < $len; $i++) {
            $strs .= $srcstr[mt_rand(0, 30)];
        }
        return $strs;
    }
    function getpic(){
        $str = $this->random(4);
        $width  = 50;
        
        //��֤��ͼƬ�ĸ߶�
        $height = 25;
        
        //������Ҫ������ͼ���ͼƬ��ʽ
        header("Content-type: image/PNG");
        //����һ��ͼ��
        $im = imagecreate($width, $height);
        
        //����ɫ
        $back = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        
        //ģ������ɫ
        $pix  = imagecolorallocate($im, 187, 230, 247);
        
        //����ɫ
        $font = imagecolorallocate($im, 41, 163, 238);
        
        //��ģ�����õĵ�
        mt_srand();
        for ($i = 0; $i < 1000; $i++) {
            imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $pix);
        }
        
        //����ַ�
        imagestring($im, 5, 7, 5, $str, $font);
        
        //�������
        imagerectangle($im, 0, 0, $width -1, $height -1, $font);
        
        //���ͼƬ
        //imagepng($im);
        Imagegif($im);
        imagedestroy($im);
        
        //$str = md5($str);
        return $str;
        //ѡ�� cookie
        //SetCookie("verification", $str, time() + 7200, "/");
        
        //ѡ�� Session
        //$_SESSION["verification"] = $str;
        
    }
}