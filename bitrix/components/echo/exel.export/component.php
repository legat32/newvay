<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$oldini=ini_get('mbstring.func_overload');
if($oldini>0) ini_set('mbstring.func_overload',0);
if(CModule::IncludeModule('echogroup.exelimport')){
	$arParams["ENCODING"]=($arParams["ENCODING"]=="" ? "WINDOWS-1251" : $arParams["ENCODING"] );
	$arParams["TMP_PATH"]=($arParams["TMP_PATH"]=="" ? "/upload/" : $arParams["TMP_PATH"] ); 
	$dir=$_SERVER["DOCUMENT_ROOT"].$arParams["TMP_PATH"];
	if(!is_dir($dir)) mkdir($dir, 0777, true);
	$tmp_filename=date("d-m-y")."_".time().".xls";
	$arParams["FIRST_LINE_STYLE"]=($arParams["FIRST_LINE_STYLE"]=="" ? array("align"=>"center","valign"=>"center") : $arParams["FIRST_LINE_STYLE"] );
	$pExcel = new PHPExcel();
	$pExcel->setActiveSheetIndex(0);
	$aSheet = $pExcel->getActiveSheet();
	$aSheet->setTitle('Tab 1');
	//устанавливаем данные
	//номера по порядку
	foreach($arParams["DATA"] as $i => $arStr)
		foreach($arStr as $j => $cell){
			if($arParams["ENCODING"]!="UTF-8")
				$d=iconv($arParams["ENCODING"],"UTF-8",$cell);
			if($i==0) $aSheet->getStyle(GetLetter($j).($i+1))->getFont()->setBold(true);
			$aSheet->setCellValue(GetLetter($j).($i+1),$d." ");
			//устанавливаем ширину
			if(!preg_match("!\n!i",$cell)&&intval($cel_width[$j])<strlen($cell)) $cel_width[$j]=strlen($cell);
			elseif(preg_match("!\n!i",$cell)){
				$w=explode("\n",$cell);
				foreach($w as $st) if(intval($cel_width[$j])<strlen($st)) $cel_width[$j]=strlen($st);
			}
			if(preg_match("!\n!i",$cell)){
				$size=$aSheet->getStyle(GetLetter($j).($i+1))->getFont()->getSize()+3;
				$h=explode("\n",$cell);
				if(intval($cel_height[$i])<(count($h)*$size)){
					$cel_height[$i]=count($h)*$size;
					$aSheet->getRowDimension(($i+1))->setRowHeight($cel_height[$i]);
				}
			}
			$aSheet->getColumnDimension(GetLetter($j))->setAutoSize(true);
			if($i==0&&is_array($arParams["FIRST_LINE_STYLE"])){
				$style=array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
						'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
						'rotation'   => 0,
						'wrap'       => true
					);
				if($arParams["FIRST_LINE_STYLE"]["align"]!="center") $style["horizontal"]=$arParams["FIRST_LINE_STYLE"]["align"];
				if($arParams["FIRST_LINE_STYLE"]["valign"]!="center") $style["vertical"]=$arParams["FIRST_LINE_STYLE"]["valign"];
				$aSheet->getStyle(GetLetter($j).($i+1))->getAlignment()->applyFromArray($style);
			}
			//раскаментить если надо статическая ширина
			//$aSheet->getColumnDimension(GetLetter($j))->setWidth($cel_width[$j]+1);
		}

	//отдаем пользователю в браузер
	$objWriter = new PHPExcel_Writer_Excel5($pExcel);
	//header('Content-Type: application/vnd.ms-excel');
	//header('Content-Disposition: attachment;filename="export.xls"');
	//header('Cache-Control: max-age=0');
	//$objWriter->save('php://output');

	$objWriter->save($dir.$tmp_filename);
LocalRedirect($arParams["TMP_PATH"].$tmp_filename);
}
?>