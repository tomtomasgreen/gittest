<?php
// + ------------------
// | Author: LUIJI
// + ------------------

defined('BASEPATH') OR exit('No direct script access allowed');

class NN_certificate {
	
	public function generate_certificate($path, $doctorname, $date, $sn) {
		$image = imagecreatefromjpeg($path . 'images/certificate.jpg');
		imagealphablending($image, true);
		$color = imagecolorallocate($image, 83, 83, 83);
		imagefttext($image, 36, 0, 280, 400, $color, $path . 'fonts/msyh.ttc', $doctorname);
		imagefttext($image, 24, 0, 410, 570, $color, $path . 'fonts/msyh.ttc', $date);
		imagefttext($image, 32, 0, 390, 920, $color, $path . 'fonts/msyh.ttc', $sn);

		// $logo = ImageCreateFromPNG('images/yinzhang.png'); 
		// $logoW = ImageSX($logo); 
		// $logoH = ImageSY($logo); 
		// ImageCopy($image, $logo, 425, 280, 0, 0, 100, 98);

		$app = $path.'../../guanhuai_app/public/certificate/' . $sn . '.jpg';
		$filename = $path . 'certificate/' . $sn . '.jpg';
		Imagejpeg($image, $filename);
		Imagejpeg($image, $app);
		imagedestroy($image);
	}
	
}