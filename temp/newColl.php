<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
 
<?



hide_new_coll();






/*
function сheckActiveProducts1()
{
	
	$SECTION_ID = Array(); // ID разделов, товары которых не трогать в части активации/деактивации (НОВЫЕ КОЛЛЕКЦИИ)
	
	$arGoods = Array();
	$dbRes = CIBlockElement::GetList(
		Array(),
		Array("IBLOCK_ID" => 7), 
		false,
		false,
		Array("ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.ACTIVE", "PROPERTY_CML2_LINK.IBLOCK_SECTION_ID", "ACTIVE")
		);
	while($arRes = $dbRes->GetNext()) 
	{
		if(in_array($arRes["PROPERTY_CML2_LINK_IBLOCK_SECTION_ID"], $SECTION_ID)) continue;
		$arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["CURRENT"] = $arRes["PROPERTY_CML2_LINK_ACTIVE"];
		if($arRes["ACTIVE"] == "Y") $arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["COUNT"]++;
		elseif(!isset($arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["COUNT"])) $arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["COUNT"] = 0;
	}	
	$arActions = Array();
	foreach($arGoods as $key => $arGood) 
	{
		if(($arGood["COUNT"] == 0)&&($arGood["CURRENT"] == "Y")) $arActions[$key] = "N";
		if(($arGood["COUNT"] > 0)&&($arGood["CURRENT"] == "N"))  $arActions[$key] = "Y";
	}
	
	$el = new CIBlockElement;
	$str = "";
	foreach($arActions as $id => $act)
	{
		//$res = $el->Update($id, Array("ACTIVE" => $act));
		$str .= $id." - ".$act."\n";
	}
	//mail("turtell@yandex.ru", "сheckActiveProducts at ".date("d.m.Y H:i"), $str); 
	
}


сheckActiveProducts1();
*/





//hide_new_coll() ;














//checkActiveOffers__();


?>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>