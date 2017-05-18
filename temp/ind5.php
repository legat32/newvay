<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?

/*
function deleteEmptyOffers() 
{

	global $DB;
	
	CModule::IncludeModule("sale");
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("iblock");

	$arFilter = Array("IBLOCK_ID" => 7, "ACTIVE" => "Y", "<CATALOG_QUANTITY" => 1);
	$dbRes = CIBlockElement::GetList( Array(), $arFilter, false, false, Array("ID", "NAME", "CATALOG_QUANTITY") );

	$del = Array();
	while($arRes = $dbRes->GetNext())
	{
		$del[$arRes["ID"]] = $arRes["NAME"];
	}

	$str = date("d.m.Y H:i:s")."\n";
	if(count($del) <1 ) $str.="No empty offers";
	foreach($ar as $id => $name) 
	{
		if(CIBlockElement::Delete($id))
			$str .= "Deleted: ".$name." [".$id."]\n";
		else 
			$str .= "DELETION ERROR: ".$name." [".$id."]\n";	
	}

	$title =  date("d.m.Y H:i:s").((count($del) < 1) ? " No empty offers" : " Deleted ".count($del)." empty offers");
	mail("turtell@yandex.ru", $title, $str);
	
	return "deleteEmptyOffers();";

}
*/

deleteEmptyOffers();


?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>