<?


// Функция проходит по всем товарам и удаляет те, у которых нет ни одного предложения

function deleteProductsWithoutOffers() 
{
	$dbRes = CIBlockElement::GetList(
		Array(),
		Array("IBLOCK_ID" => 7), // инфоблок предложений
		false,
		false,
		Array("ID", "PROPERTY_CML2_LINK")
		);
	$arOffers = Array();
	while($arRes = $dbRes->GetNext()) 
	{	
		$arOffers[$arRes["PROPERTY_CML2_LINK_VALUE"]][] = $arRes["ID"];
	}


	$dbRes = CIBlockElement::GetList(
		Array(),
		Array("IBLOCK_ID" => 6), // инфоблок товаров
		false,
		false,
		Array("ID", "NAME")
		);
	$arDel = Array();	
	while($arRes = $dbRes->GetNext()) 
	{	
		if(!isset($arOffers[$arRes["ID"]])) $arDel[$arRes["ID"]] = $arRes["NAME"];
	}
	
	
	$str = date("d.m.Y H:i:s")."\n";
	if(count($arDel) <1 ) $str.="Not exists goods without SKU";
	foreach($arDel as $k=>$v) 
	{
		$str .= $v." - ";
		//$str .= "\n";
		if(CIBlockElement::Delete($k))
			$str .= "deleted";
		else 
			$str .= "DELETION ERROR!";	
		$str .= "\n";
	}
	
	$title =  date("d.m.Y H:i:s").((count($arDel) < 1) ? " No goods deletion" : " Deleted ".count($arDel)." goods without SKU");
	mail("turtell@yandex.ru", $title, $str);
	
	return "deleteProductsWithoutOffers();";
	
}







// Удаление торговых предложений, где количество равно нулю

function deleteEmptyOffers1() 
{
	global $APPLICATION;
	global $USER;

	CModule::IncludeModule("iblock");
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
	
	$dbRes = CIBlockElement::GetList(
		Array(),
		Array("IBLOCK_ID" => 7, "<CATALOG_QUANTITY" => 1), // инфоблок предложений
		false,
		false,
		Array("ID", "NAME", "CATALOG_GROUP_1")
		);
	$arDel = Array();
	while($arRes = $dbRes->GetNext()) 
	{	
		$arDel[$arRes["ID"]] = $arRes["NAME"];
	}
	
	$str = date("d.m.Y H:i:s")."\n";
	if(count($arDel) <1 ) $str.="Not exists empty offers";
	foreach($arDel as $k=>$v) 
	{
		$str .= $v." - ";
		if(CIBlockElement::Delete($k))
			$str .= "deleted";
		else 
			$str .= "DELETION ERROR!";	
		$str .= "\n";
	}
	
	$title =  date("d.m.Y H:i:s").((count($arDel) < 1) ? " No offers deletion" : " Deleted ".count($arDel)." empty offers");
	mail("turtell@yandex.ru", $title, $str);

	return "deleteEmptyOffers1();";
	
}








// Функция проходит по всем торговым предложениям каждого товара
// если в рамках одного товара есть предложения, время обновления которых значительно 
// отличается от времени обновления остальных предложений в этом товаре, то оно удаляется
// (это означает что предложений пропало из выгрузки, что означает что нет свободного остатка)

function deleteOldOffers() 
{
	$razbros = 120; // интервал времени в сек. после которого предложение считается необновленным
	
	CModule::IncludeModule("iblock");
	
	$dbRes = CIBlockElement::GetList(
		Array(),
		Array("IBLOCK_ID" => 7), // инфоблок предложений
		false,
		false,
		Array("ID", "NAME", "TIMESTAMP_X_UNIX", "PROPERTY_CML2_LINK")
		);
		
	$arr = Array();
	$arrForReport = Array();
	while($arRes = $dbRes->GetNext()) 
	{	
		$arr[$arRes["PROPERTY_CML2_LINK_VALUE"]][$arRes["ID"]] = $arRes["TIMESTAMP_X_UNIX"];
		$arrForReport[$arRes["ID"]] = $arRes["NAME"];
	}
	
	$del = Array();
	$delReport = Array();
	foreach($arr as $product_id => $times) 
	{
		$etalon = max($times);
		foreach($times as $k => $v) 
		{
			if(($etalon - $v) >= $razbros) 
			{
				$del[] = $k;
				$delReport[] = $arrForReport[$k];
			}
			
			/*
			if(($k == 165566)||($k == 165567))
			{
				$del[] = $k;
				$delReport[] = $arrForReport[$k];
			}
			*/
			
		}

	}

	$str = date("d.m.Y H:i:s")."\n";
	if(count($del) <1 ) $str.="Нет устаревших элементов";
	for($i=0; $i<count($del); $i++) {
		if(CIBlockElement::Delete($del[$i]))
			$str .= "Удалено: ".$arrForReport[$del[$i]]."\n";
		else 
			$str .= "ОШИБКА УДАЛЕНИЯ: ".$arrForReport[$del[$i]]."\n";
		
		}
	
	$title =  date("d.m.Y H:i:s").((count($del) < 1) ? " Нет удалений предложений" : " Удалено ".count($del)." устаревших элементов");
	mail("turtell@yandex.ru", $title, $str);

	return "deleteOldOffers();";

}
?>