<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>



<?
$arPict = Array();
CModule::IncludeModule("iblock");

// соберем массив фото на этом сайте
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6), false, false, Array("ID", "XML_ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_MORE_PHOTO"));
$num = 0;
while($arRes = $dbRes->GetNext())
{
	//prn($arRes);
	
	if(!is_array($arPict[$arRes["XML_ID"]]["PREVIEW_PICTURE"])) 
		if($arRes["PREVIEW_PICTURE"]>0)
		{
			$t = Array();
			$t = CFile::GetFileArray($arRes["PREVIEW_PICTURE"]);
			$arPict[$arRes["XML_ID"]]["PREVIEW_PICTURE"] = Array(
				"SRC" => $t["SRC"],
				"DESCRIPTION" => $t["DESCRIPTION"],
				"SIZE" => $t["FILE_SIZE"],
				"MD5" => md5_file($_SERVER["DOCUMENT_ROOT"].$t["SRC"])
				);
		}
	if(!is_array($arPict[$arRes["XML_ID"]]["DETAIL_PICTURE"])) 
		if($arRes["DETAIL_PICTURE"]>0)
		{
			$t = Array();
			$t = CFile::GetFileArray($arRes["DETAIL_PICTURE"]);
			$arPict[$arRes["XML_ID"]]["DETAIL_PICTURE"] = Array(
				"SRC" => $t["SRC"],
				"DESCRIPTION" => $t["DESCRIPTION"],
				"SIZE" => $t["FILE_SIZE"],
				"MD5" => md5_file($_SERVER["DOCUMENT_ROOT"].$t["SRC"])
				);
		}
	if(is_array($arRes["PROPERTY_MORE_PHOTO_VALUE"]))
	{
		foreach($arRes["PROPERTY_MORE_PHOTO_VALUE"] as $imgID)
		{
			if($imgID>0) 
			{
				$t = array();
				$t = CFile::GetFileArray($imgID);
				$arPict[$arRes["XML_ID"]]["MORE_PHOTO"][] = Array(
					"SRC" => $t["SRC"],
					"DESCRIPTION" => $t["DESCRIPTION"],
					"SIZE" => $t["FILE_SIZE"],
					"MD5" => md5_file($_SERVER["DOCUMENT_ROOT"].$t["SRC"])
				);
			}
		}
	}
	else 
	{
		if($arRes["PROPERTY_MORE_PHOTO_VALUE"] > 0)
		{
			$t = array();
			$t = CFile::GetFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
			$arPict[$arRes["XML_ID"]]["MORE_PHOTO"][] = Array(
				"SRC" => $t["SRC"],
				"DESCRIPTION" => $t["DESCRIPTION"],
				"SIZE" => $t["FILE_SIZE"],
				"MD5" => md5_file($_SERVER["DOCUMENT_ROOT"].$t["SRC"])
			);
			$arPict[$arRes["XML_ID"]]["MORE_PHOTO"][] = CFile::GetFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
		}
	}
	$num++;
	if($num>2000) break;
}

$xml = "08d48e05-20d3-11e6-a256-d067e5f9e4b1";
//prn($arPict);
prn($num);
echo '<img src="'.$arPict[$xml]["DETAIL_PICTURE"]["SRC"].'"/>';


die("123333");
?>
	

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>