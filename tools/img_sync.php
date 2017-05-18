<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
// файл прдназначен для синхронизации фото этого сайта с сайтом-образцом
// сначала выбираем в массив PREVIEW, DETAIL и MORE_PHOTO по своим файлам по заданному XML_ID с подсчетом md5 для файлов
// запрашиваем скрипт http://sogrevay.ru/tools/get_photo.php и получаем аналогичную инфу с сайта-образца в текстовом формате
// сравниваем 
// обновляем в соответствии с сайтом-образцом при необходимости
?>

<?

$xml = trim(strVal($_GET["xml"]));

// выбираем данные по своим файлам
$arPict = Array();
if(strLen($xml)>0)
{
	CModule::IncludeModule("iblock");
	
	$dbRes = CIBlockElement::GetList(Array(), Array("XML_ID" => $xml), false, false, Array("ID", "XML_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_MORE_PHOTO"));
	while($arRes = $dbRes->GetNext())
	{
		//prn($arRes);
		$ID = $arRes["ID"];
		if(!is_array($arPict["PREVIEW_PICTURE"])) 
			if($arRes["PREVIEW_PICTURE"]>0)
				$arPict["PREVIEW_PICTURE"] = CFile::GetFileArray($arRes["PREVIEW_PICTURE"]);
		if(!is_array($arPict["DETAIL_PICTURE"])) 
			if($arRes["DETAIL_PICTURE"]>0)
				$arPict["DETAIL_PICTURE"] = CFile::GetFileArray($arRes["DETAIL_PICTURE"]);
		if(is_array($arRes["PROPERTY_MORE_PHOTO_VALUE"]))
		{
			foreach($arRes["PROPERTY_MORE_PHOTO_VALUE"] as $imgID)
			{
				if($imgID>0) $arPict["MORE_PHOTO"][] = CFile::GetFileArray($imgID);
			}
		}
		else 
		{
			if($arRes["PROPERTY_MORE_PHOTO_VALUE"] > 0)
				$arPict["MORE_PHOTO"][] = CFile::GetFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
		}
	}
	
	// подсчитаем md5 для каждого файла
	if(is_array($arPict["PREVIEW_PICTURE"])) $arPict["PREVIEW_PICTURE"]["MD5"] = md5_file($_SERVER["DOCUMENT_ROOT"].$arPict["PREVIEW_PICTURE"]["SRC"]);
	if(is_array($arPict["DETAIL_PICTURE"])) $arPict["DETAIL_PICTURE"]["MD5"] = md5_file($_SERVER["DOCUMENT_ROOT"].$arPict["DETAIL_PICTURE"]["SRC"]);
	foreach($arPict["MORE_PHOTO"] as $k => $arPic)
	{
		if($arPic["SRC"]) $arPict["MORE_PHOTO"][$k]["MD5"] = md5_file($_SERVER["DOCUMENT_ROOT"].$arPic["SRC"]);
	}
	
	// запрашиваем с сайта-образца
	$res = QueryGetData("www.sogrevay.ru", 80, "/tools/get_photo.php", "xml=".$xml, $errno, $errstr);
	$t = explode("\n", $res);
	$arRemote = Array();
	foreach($t as $row)
	{
		if(trim($row) == "") continue;
		$tt = explode(";", $row);
		$one = Array(
				"ID" => $tt[1],
				"SRC" => $tt[2],
				"MD5" => $tt[3],
				"DESCRIPTION" => $tt[4]
			);
		if($tt[0] == "PREVIEW_PICTURE") $arRemote["PREVIEW_PICTURE"] = $one;
		if($tt[0] == "DETAIL_PICTURE") $arRemote["DETAIL_PICTURE"] = $one;
		if($tt[0] == "MORE_PHOTO")	$arRemote["MORE_PHOTO"][] = $one;
	}
	
	
	
	
	
	
	
	// сравниваем
	
	$arActions = Array(
		"PREVIEW_PICTURE" => "",
		"DETAIL_PICTURE" => "",
		"MORE_PHOTO" => ""
	);

	// превью
	if(($arPict["PREVIEW_PICTURE"]["MD5"] == $arRemote["PREVIEW_PICTURE"]["MD5"]) && ($arPict["PREVIEW_PICTURE"]["DESCRIPTION"] == $arRemote["PREVIEW_PICTURE"]["DESCRIPTION"]))
		$arAction["PREVIEW_PICTURE"] = "SYNC";
	else
	{
		if(is_array($arPict["PREVIEW_PICTURE"]) && !is_array($arRemote["PREVIEW_PICTURE"])) $arAction["PREVIEW_PICTURE"] = "DEL";
		if(!is_array($arPict["PREVIEW_PICTURE"]) && is_array($arRemote["PREVIEW_PICTURE"])) $arAction["PREVIEW_PICTURE"] = "ADD";
		if(is_array($arPict["PREVIEW_PICTURE"]) && is_array($arRemote["PREVIEW_PICTURE"])) 	$arAction["PREVIEW_PICTURE"] = "UPD";
	}
	
	// детальное
	if(($arPict["DETAIL_PICTURE"]["MD5"] == $arRemote["DETAIL_PICTURE"]["MD5"]) && ($arPict["DETAIL_PICTURE"]["DESCRIPTION"] == $arRemote["DETAIL_PICTURE"]["DESCRIPTION"]))
		$arAction["DETAIL_PICTURE"] = "SYNC";
	else
	{
		if(is_array($arPict["DETAIL_PICTURE"]) && !is_array($arRemote["DETAIL_PICTURE"])) $arAction["DETAIL_PICTURE"] = "DEL";
		if(!is_array($arPict["DETAIL_PICTURE"]) && is_array($arRemote["DETAIL_PICTURE"])) $arAction["DETAIL_PICTURE"] = "ADD";
		if(is_array($arPict["DETAIL_PICTURE"]) && is_array($arRemote["DETAIL_PICTURE"]))  $arAction["DETAIL_PICTURE"] = "UPD";
	}
	
	// more_photo
	$arAction["MORE_PHOTO"] = "SYNC";
	if(!is_array($arPict["MORE_PHOTO"]) && is_array($arRemote["MORE_PHOTO"])) $arAction["MORE_PHOTO"] = "UPD";
	foreach($arPict["MORE_PHOTO"] as $k => $arPic)
	{
		if(($arPict["MORE_PHOTO"][$k]["MD5"] == $arRemote["MORE_PHOTO"][$k]["MD5"]) && ($arPict["MORE_PHOTO"][$k]["DESCRIPTION"] == $arRemote["MORE_PHOTO"][$k]["DESCRIPTION"]))
			continue;
		else
		{
			$arAction["MORE_PHOTO"] = "UPD";
			break;
		}
	}


	//prn($arRemote);
	//prn($arPict);
	//prn($arAction);


	
	
	
	
	// выполняем действия по PREVIEW
	if(($arAction["PREVIEW_PICTURE"] == "ADD")||($arAction["PREVIEW_PICTURE"] == "UPD"))
	{
		$arImg = CFile::MakeFileArray($arRemote["PREVIEW_PICTURE"]["SRC"]);
		$arImg["description"] = $arRemote["PREVIEW_PICTURE"]["DESCRIPTION"];
		$el = new CIBlockElement;
		$res = $el->Update($ID, Array("PREVIEW_PICTURE" => $arImg));
	}
	if($arAction["PREVIEW_PICTURE"] == "DEL")
	{
		$el = new CIBlockElement;
		$res = $el->Update($ID, Array("PREVIEW_PICTURE" => Array("del" => "Y")));
	}
	
	
	// выполняем действия по DETAIL
	if(($arAction["DETAIL_PICTURE"] == "ADD")||($arAction["DETAIL_PICTURE"] == "UPD"))
	{
		$arImg = CFile::MakeFileArray($arRemote["DETAIL_PICTURE"]["SRC"]);
		$arImg["description"] = $arRemote["DETAIL_PICTURE"]["DESCRIPTION"];
		$el = new CIBlockElement;
		$res = $el->Update($ID, Array("DETAIL_PICTURE" => $arImg));
	}
	if($arAction["DETAIL_PICTURE"] == "DEL")
	{
		$el = new CIBlockElement;
		$res = $el->Update($ID, Array("DETAIL_PICTURE" => Array("del" => "Y")));
	}
	
	// выполняем действия по MORE_PHOTO
	if($arAction["MORE_PHOTO"] == "UPD")
	{
		$arProps = Array();
		foreach($arRemote["MORE_PHOTO"] as $k => $arImg)
		{
			$arOne = CFile::MakeFileArray($arRemote["MORE_PHOTO"][$k]["SRC"]);
			$arOne["description"] = $arRemote["MORE_PHOTO"][$k]["DESCRIPTION"];
			$arProps["MORE_PHOTO"][] = $arOne;
		}
		if(count($arProps) < 1) 
		{
			foreach($arPict["MORE_PHOTO"] as $arImg) 
			{
				$arOne = CFile::MakeFileArray($arImg["ID"]);
				$arOne["del"] = "Y";
				$arProps["MORE_PHOTO"][] = $arOne;
			}
		}
		CIBlockElement::SetPropertyValuesEx($ID, false, $arProps);
	}
	
	mail("turtell@yandex.ru", "SOGREVAY to NEWVAY sync images for ".$xml, $xml);

}
?>