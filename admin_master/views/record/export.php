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
            ->setCellValue( 'A1', '序号')            
            ->setCellValue( 'B1', '姓名' )            
			->setCellValue( 'C1', '手机' )         
            ->setCellValue( 'D1', '邮箱')                    
            ->setCellValue( 'E1', '城市' )           
			->setCellValue( 'F1', '主管医生' ) ;
$num = 2 ;

foreach($export_all as $k => $v ){
// var_dump($v);exit;
	$objPHPExcel->setActiveSheetIndex(0)                 
            ->setCellValue( 'A'.$num , $v[0]['id'] )            
            ->setCellValue( 'B'.$num , $v[0]['username'] )            
			->setCellValue( 'C'.$num , $v[0]['mobile'] )         
            ->setCellValue( 'D'.$num , $v[0]['email'] )                    
            ->setCellValue( 'E'.$num , $AREAS[$v[0]['city']] )           
			->setCellValue( 'F'.$num , $v[0]['doctor_name'] ) ;
	$num = $num + 1 ;	
		// dd($v['sj']);exit;
	if( array_key_exists( 'sj' , $v ) )	{
		// var_dump("sddf");exit;
		foreach($v['sj'] as $k1 => $v1){
			
			if( $k1 == 1 ){
				$objPHPExcel->setActiveSheetIndex(0)                 
					->setCellValue( 'A'.$num , '')            
					->setCellValue( 'B'.$num , '项目' )            
					->setCellValue( 'C'.$num , '类型' )         
					->setCellValue( 'D'.$num , '血糖值')                    
					->setCellValue( 'E'.$num , '来源' )           
					->setCellValue( 'F'.$num , '测量时间' ) ;
				$num = $num +1 ;	
				foreach($v1 as $k2 => $v2){
					$objPHPExcel->setActiveSheetIndex(0)                 
						->setCellValue( 'A'.$num , '' )            
						->setCellValue( 'B'.$num , '血糖' )            
						->setCellValue( 'C'.$num , $v2['type'] )         
						->setCellValue( 'D'.$num , $v2['sugar'] )                    
						->setCellValue( 'E'.$num , '手动录入' )           
						->setCellValue( 'F'.$num , $v2['measuretimes'] ) ;
					$num =  $num + 1 ;	
				}
			}else if( $k1 == 2 ){
				$objPHPExcel->setActiveSheetIndex(0)                 
					->setCellValue( 'A'.$num , '')            
					->setCellValue( 'B'.$num , '项目' )            
					->setCellValue( 'C'.$num , '低压' )         
					->setCellValue( 'D'.$num , '高压')                    
					->setCellValue( 'E'.$num , '来源' )           
					->setCellValue( 'F'.$num , '测量时间' ) ;
				$num = $num +1 ;	
				foreach($v1 as $k2 => $v2){
					$objPHPExcel->setActiveSheetIndex(0)                 
						->setCellValue( 'A'.$num , '' )            
						->setCellValue( 'B'.$num , '血压' )            
						->setCellValue( 'C'.$num , $v2['high'] )         
						->setCellValue( 'D'.$num , $v2['low'] )                    
						->setCellValue( 'E'.$num , '手动录入' )           
						->setCellValue( 'F'.$num , $v2['measuretimes'] ) ;
					$num =  $num + 1 ;	
				}
			}else if( $k1 == 3 ){
				$objPHPExcel->setActiveSheetIndex(0)                 
					->setCellValue( 'A'.$num , '')            
					->setCellValue( 'B'.$num , '项目' )            
					->setCellValue( 'C'.$num , '糖化值' )         
					->setCellValue( 'D'.$num , '来源')                    
					->setCellValue( 'E'.$num , '测量时间' )           
					->setCellValue( 'F'.$num , '' ) ;
				$num = $num +1 ;	
				foreach($v1 as $k2 => $v2){
					$objPHPExcel->setActiveSheetIndex(0)                 
						->setCellValue( 'A'.$num , '' )            
						->setCellValue( 'B'.$num , '糖化' )            
						->setCellValue( 'C'.$num , $v2['protein'] )         
						->setCellValue( 'D'.$num , '手动录入' )                    
						->setCellValue( 'E'.$num , $v2['measuretimes'] )           
						->setCellValue( 'F'.$num , '' ) ;
					$num =  $num + 1 ;	
				}	
			}
		}
	}	
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
header('Content-Disposition: attachment;filename="ExportData-' . date('YmdHis', time()) . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
$objWriter->save( 'php://output');
exit;





 ?>

