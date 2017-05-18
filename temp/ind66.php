<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
 
<?
function checkActiveOffers__() 
{
	CModule::IncludeModule("iblock");
	$arProducts = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7), false, false, Array("ID", "CATALOG_QUANTITY", "CATALOG_GROUP_3", "ACTIVE"));
	$arActions = Array();
	while($arRes = $dbRes->GetNext()) 
	{
		if((($arRes["CATALOG_QUANTITY"] < 1) || ($arRes["CATALOG_PRICE_3"] < 1)) && ($arRes["ACTIVE"] == "Y")) $arActions[$arRes["ID"]] = "N";
		if(($arRes["CATALOG_QUANTITY"] > 0) && ($arRes["CATALOG_PRICE_3"] > 0) && ($arRes["ACTIVE"] == "N")) $arActions[$arRes["ID"]] = "Y";
		//prn($arRes);
		//break;
	}
	prn($arActions);
	
	//$el = new CIBlockElement;
	$str = "";
	foreach($arActions as $id => $act)
	{
		//$res = $el->Update($id, Array("ACTIVE" => $act));
		$str .= $id." - ".$act."\n";
	}
	mail("turtell@yandex.ru", "сheckActiveOffers at ".date("d.m.Y H:i"), $str); 
}

checkActiveOffers__();


?>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>