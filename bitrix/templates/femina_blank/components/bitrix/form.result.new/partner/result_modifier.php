<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// ID поля "Данные заявки" (см.в настройках вопросов для формы)
$QUESTION_ID = 448;
//prn($_REQUEST);

global $USER;
$rsUsers = CUser::GetList(($by="ID"), ($order="desc"), array("ID"=>$USER->GetID()),array("SELECT"=>array("UF_*")));
$text = "";
if($arUser = $rsUsers->GetNext()) {
	//prn($arUser);
	
	if($_REQUEST["type"]=="joint") $text.= "CОВМЕСТНЫЕ ПОКУПКИ\r\n\r\n";
	if($_REQUEST["type"]=="dealer") $text.= "ОПТОВОЕ СОТРУДНИЧЕСТВО\r\n\r\n"; 
	
	$text.= "Ф.И.О.: ".$arUser["LAST_NAME"]." ".$arUser["NAME"]."\r\n";
	$text.= "E-mail: ".$arUser["EMAIL"]."\r\n";
	
	if($_REQUEST["type"]=="joint") {
		$text.= "Паспортные данные: ".$arUser["UF_PASSPORT"]."\r\n";
		$text.= "ИНН (физ.лицо): ".$arUser["UF_FIZ_INN"]."\r\n";
		if(count($arUser["UF_DOC"])>0) {
			$text.= "\r\nПрикрепленные файлы:\r\n";
			foreach($arUser["UF_DOC"] as $doc) {
				$arFile = CFile::GetFileArray($doc);
				$text.= SITE_SERVER_NAME.$arFile["SRC"]."\r\n";
				}
			}
		};
		
	if($_REQUEST["type"]=="dealer") {
		$text.= "Название компании: ".$arUser["UF_COMPANY_NAME"]."\r\n";
		$text.= "Юридический адрес: ".$arUser["UF_COMPANY_ADDRESS"]."\r\n";
		$text.= "ИНН: ".$arUser["UF_INN"]."\r\n";
		$text.= "КПП: ".$arUser["UF_KPP"]."\r\n";
		$text.= "Р/сч: ".$arUser["UF_R_SCHET"]."\r\n";
		$text.= "Кор/сч: ".$arUser["UF_KOR_SCHET"]."\r\n";
		$text.= "Телефон: ".$arUser["UF_COMPANY_PHONE"]."\r\n";
		if(count($arUser["UF_COMPANY_DOC"])>0) {
			$text.= "\r\nПрикрепленные файлы:\r\n";
			foreach($arUser["UF_COMPANY_DOC"] as $doc) {
				$arFile = CFile::GetFileArray($doc);
				$text.= SITE_SERVER_NAME.$arFile["SRC"]."\r\n";
				}
			}
		};
		
	
		
	}


$arResult["QUESTIONS"]["SIMPLE_QUESTION_".$QUESTION_ID]["HTML_CODE"]='<textarea readonly="readonly" name="form_textarea_'.$arResult['arAnswers']['SIMPLE_QUESTION_'.$QUESTION_ID][0]['ID'].'" cols="'.$arResult['arAnswers']['SIMPLE_QUESTION_'.$QUESTION_ID][0]['FIELD_WIDTH'].'" rows="'.$arResult['arAnswers']['SIMPLE_QUESTION_'.$QUESTION_ID][0]['FIELD_HEIGHT'].'" class="inputtextarea">'.$text.'</textarea>';
?>