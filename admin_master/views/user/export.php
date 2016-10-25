<?php



require_once 'public/phpexcel/PHPExcel.php';


// 首先创建一个新的对象  PHPExcel object
$objPHPExcel = new PHPExcel();
global $AREAS;
// 设置文件的一些属性，在xls文件——>属性——>详细信息里可以看到这些值，xml表格里是没有这些值的
$objPHPExcel
      ->getProperties()  //获得文件属性对象，给下文提供设置资源
      ->setCreator( "Maarten Balliauw")                 //设置文件的创建者
      ->setLastModifiedBy( "Maarten Balliauw")          //设置最后修改者
      ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
      ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
      ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
      ->setKeywords( "office 2007 openxml php")        //设置标记
      ->setCategory( "Test result file");                //设置类别
// 位置aaa  *为下文代码位置提供锚
// 给表格添加数据
$objPHPExcel->setActiveSheetIndex(0)                 
            ->setCellValue( 'A1', '项目')            
            ->setCellValue( 'B1', '类型' )            
			->setCellValue( 'C1', '测量时间' )         
            ->setCellValue( 'D1', '血糖值');
$num = 2 ;

foreach($sugar_records as $k => $v ){
// var_dump($v);exit;
	$objPHPExcel->setActiveSheetIndex(0)                 
            ->setCellValue( 'A'.$num , '血糖' )            
            ->setCellValue( 'B'.$num , $v['type'] )            
			->setCellValue( 'C'.$num , $v['measuretimes'] )         
            ->setCellValue( 'D'.$num , $v['sugar'] ) ;
	$num = $num + 1 ;	
		// dd($v['sj']);exit;
	
}	
$objPHPExcel->setActiveSheetIndex(0)                 
            ->setCellValue( 'A'.$num , '项目')            
            ->setCellValue( 'B'.$num , '高压值' )            
			->setCellValue( 'C'.$num , '低压值' )         
            ->setCellValue( 'D'.$num , '测量时间');
$num = $num + 1 ;
foreach($pressure_records as $k => $v ){
// var_dump($v);exit;
	$objPHPExcel->setActiveSheetIndex(0)                 
            ->setCellValue( 'A'.$num , '血压' )            
            ->setCellValue( 'B'.$num , $v['high'] )            
			->setCellValue( 'C'.$num , $v['low'] )         
            ->setCellValue( 'D'.$num , $v['measuretimes'] ) ;
	$num = $num + 1 ;	
		// dd($v['sj']);exit;
	
}

$objPHPExcel->setActiveSheetIndex(0)                 
            ->setCellValue( 'A'.$num , '项目')            
            ->setCellValue( 'B'.$num , '测量时间' )            
			->setCellValue( 'C'.$num , '糖化值' );
$num = $num + 1 ;
foreach($protein_records as $k => $v ){
// var_dump($v);exit;
	$objPHPExcel->setActiveSheetIndex(0)                 
            ->setCellValue( 'A'.$num , '糖化血红蛋白' )            
            ->setCellValue( 'B'.$num , $v['measuretimes'] )            
			->setCellValue( 'C'.$num , $v['protein'] ) ;
	$num = $num + 1 ;	
		// dd($v['sj']);exit;
	
}

//得到当前活动的表,注意下文教程中会经常用到$objActSheet
$objActSheet = $objPHPExcel->getActiveSheet();
// 位置bbb  *为下文代码位置提供锚
// 给当前活动的表设置名称
$objActSheet->setTitle('table');

//直接生成EXCEL文件
// $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// $objWriter->save('myexchel.xlsx');

//提示下载一个EXCEL文件2007
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
$objWriter->save( 'php://output');
exit;





 ?>

