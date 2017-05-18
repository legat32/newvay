<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
// Файл предназначен для выдачи данных по фото PREVIEW, DETAIL и MORE_PHOTO товара с переданным XML_ID
// с подсчетом MD5 каждого файла для будущего сравнения на другом сайте
// Вывод построчный в текстовом формате
?>

<?
$xml = trim(strVal($_GET["xml"]));

$arPict = Array();
if(strLen($xml)>0)
{
	CModule::IncludeModule("iblock");
	
	// соберем массив фото на этом сайте
	$dbRes = CIBlockElement::GetList(Array(), Array("XML_ID" => $xml), false, false, Array("ID", "XML_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_MORE_PHOTO"));
	while($arRes = $dbRes->GetNext())
	{
		//prn($arRes);
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
		$arPict["MORE_PHOTO"][$k]["MD5"] = md5_file($_SERVER["DOCUMENT_ROOT"].$arPic["SRC"]);
	}

	//$txt = implode("\n", $arPict["DETAIL_PICTURE"]);
	//mail("turtell@yandex.ru", "NEWVAY get_photo", $txt);
	
	// вывод в поток данных в текстовом формате
	if(is_array($arPict["PREVIEW_PICTURE"])) 
		echo "PREVIEW_PICTURE;".$arPict["PREVIEW_PICTURE"]["ID"].";http://".$_SERVER["SERVER_NAME"].$arPict["PREVIEW_PICTURE"]["SRC"].";".$arPict["PREVIEW_PICTURE"]["MD5"].";".$arPict["PREVIEW_PICTURE"]["DESCRIPTION"]."\n";
	if(is_array($arPict["DETAIL_PICTURE"])) 
		echo "DETAIL_PICTURE;".$arPict["DETAIL_PICTURE"]["ID"].";http://".$_SERVER["SERVER_NAME"].$arPict["DETAIL_PICTURE"]["SRC"].";".$arPict["DETAIL_PICTURE"]["MD5"].";".$arPict["DETAIL_PICTURE"]["DESCRIPTION"]."\n";
	foreach($arPict["MORE_PHOTO"] as $arPic)
	{
		echo "MORE_PHOTO;".$arPic["ID"].";http://".$_SERVER["SERVER_NAME"].$arPic["SRC"].";".$arPic["MD5"].";".$arPic["DESCRIPTION"]."\n";
	}
}
?>