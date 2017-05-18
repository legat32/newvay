<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");


$arSelect = Array("ID", "PROPERTY_CML2_LINK", "CATALOG_GROUP_2");
$arFilter = Array("IBLOCK_ID" => 7, "ACTIVE" => "Y");
$dbRes = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
$arr = Array();
while($arRes = $dbRes->GetNext())
{
	//prn($arRes);
	if( (!isset($arr[$arRes["PROPERTY_CML2_LINK_VALUE"]])) || ($arRes["CATALOG_PRICE_2"] < $arr[$arRes["PROPERTY_CML2_LINK_VALUE"]]) )
		$arr[$arRes["PROPERTY_CML2_LINK_VALUE"]] = $arRes["CATALOG_PRICE_2"];
	//$arr[$arRes["PROPERTY_CML2_LINK_VALUE"]][$arRes["ID"]] = $arRes["CATALOG_PRICE_2"];
	//if(trim($arRes["CODE"])=="") $arr[$arRes["ID"]] = $arRes["NAME"];
	//if(!in_array($arRes["PROPERTY_COLOR_VALUE"], $arr1)) $arr1[$arRes["PROPERTY_COLOR_VALUE"]] = $arRes["PROPERTY_COLOR_TONE_VALUE"];
	//echo $arRes["PROPERTY_COLOR_VALUE"].";".$arRes["PROPERTY_COLOR_TONE_VALUE"]."<br/>";
	//prn($arRes);
	//echo $arRes["NAME"]."<br/>";
}

prn($arr);


foreach($arr as $id => $price)
{
	CIBlockElement::SetPropertyValuesEx($id, 6, Array("JOINT_PRICE_MIN" => $price));
	//break;
}

//$arParams = array("replace_space"=>"-","replace_other"=>"-");
//$trans = Cutil::translit($name,"ru",$arParams);


//$el = new CIBlockElement; 
//$res = $el->Update(158400, Array("NAME"=>"Жакет жен. 9517"));


foreach($arr as $id => $name) 
{
	//$arParams = array("replace_space"=>"-","replace_other"=>"-","change_case" => "L");
	//$trans = Cutil::translit($name, "ru", $arParams);
	//$el = new CIBlockElement; 
	//$res = $el->Update($id, Array("NAME"=>$name));
	//$el->Update($id, );
	//if($res) echo "ok"; else echo "no";
	//echo $name."[".$id."] = ".$trans."<br/>";
	//CIBlockElement::SetPropertyValuesEx($id, 6, array("COLLECTION" => "VESNUSHKI"));
}


//prn($arr);







//ksort($arr1);
//prn($arr1);
/*
foreach($arr1 as $k=>$v) {
	echo $k.";".$v."<br/>";
	}

/*
$arSelect = Array("ID", "NAME", "PROPERTY_SOSTAV", "XML_ID");
$arFilter = Array("IBLOCK_ID"=>6, "ACTIVE"=>"Y");
$dbRes = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($arRes = $dbRes->GetNext())
{
	if(trim($arRes["PROPERTY_SOSTAV_VALUE"]) == "")
		echo $arRes["NAME"]." ".$arRes["PROPERTY_SOSTAV_VALUE"]."<br/>";
	//if(!in_array($arRes["PROPERTY_COLOR_VALUE"], $arr1[$arRes["PROPERTY_COLOR_TONE_VALUE"]])) $arr1[$arRes["PROPERTY_COLOR_TONE_VALUE"]][] = $arRes["PROPERTY_COLOR_VALUE"];
}
//prn($arr1);

*/
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>