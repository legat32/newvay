<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
//CModule::IncludeModule("sale");
//CModule::IncludeModule("catalog");
//CModule::IncludeModule("iblock"); 




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
		//$arrForReport[$arRes["ID"]] = $arRes["NAME"];
	}
	//prn($arOffers);



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
	//prn($arDel);
	
	
	$str = date("d.m.Y H:i:s")."\n";
	if(count($arDel) <1 ) $str.="Нет товаров без торговых предложений";
	foreach($arDel as $k=>$v) 
	{
		if(CIBlockElement::Delete($k))
			$str .= "Удалено: ".$v."\n";
		else 
			$str .= "ОШИБКА УДАЛЕНИЯ: ".$v."\n";	
	}
	
	$title =  date("d.m.Y H:i:s").((count($arDel) < 1) ? " Нет удалений" : " Удалено ".count($arDel)." товаров без торговых предложений");
	mail("turtell@yandex.ru", $title, $str);
	
	

}

deleteProductsWithoutOffers();





// Функция проходит по всем торговым предложениям каждого товара
// если в рамках одного товара есть предложения, время обновления которых значительно 
// отличается от времени обновления остальных предложений в этом товаре, то оно удаляется
// (это означает что предложений пропало из выгрузки, что означает что нет свободного остатка)

function deleteOldOffers() 
{
	$razbros = 120; // интервал времени в сек. после которого предложение считается необновленным
	
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
			if(($k == 165581)||($k == 165576))
			{
				$del[] = $k;
				$delReport[] = $arrForReport[$k];
			}
			*/
			
		}

	}

	/*
	for($i=0; $i<count($del); $i++) {
		$DB->StartTransaction();
		if(!CIBlockElement::Delete($del[$i]))
		{
			$strWarning .= 'Error!';
			$DB->Rollback();
		}
		else
			$DB->Commit();
		
		}
	*/
	mail("turtell@yandex.ru", date("d.m.Y H:i:s").": Удалено ".count($del)." устаревших предложений", date("d.m.Y H:i:s")."\n".implode("\n", $delReport));
	//prn($delReport);
	return "deleteOldOffers();";

}

//echo deleteOldOffers();


/*
foreach($arr as $k=>$t) {
	if(count($t)<2) continue;
	echo "<hr/>".$k."<hr/>";
	if(count($t) == 2) 
	{
		$razn = abs($t[0]-$t[1]);
		if($razn>1) 
		{
			echo "<br/>ТУТ БОЛЬШЕ ЕДИНИЦЫ!!!!!!!!";
			prn($t);
			echo "<br/>";
		}
	}
	if(count($t)>2) prn($t);
	}
*/

//prn($arr);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>