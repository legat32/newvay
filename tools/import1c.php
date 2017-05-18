<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?
//prn($_GET);
//prn($_POST);
//prn($_FILES);
//prn($_SERVER);


function сheckActiveProducts_()
{
	$SECTION_ID = Array(319); // ID разделов, товары которых не трогать в части активации/деактивации (НОВЫЕ КОЛЛЕКЦИИ)
	
	$arGoods = Array();
	$dbRes = CIBlockElement::GetList(
		Array(),
		Array("IBLOCK_ID" => 7), // инфоблок товаров
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
		$res = $el->Update($id, Array("ACTIVE" => $act));
		$str .= $id." - ".$act."\n";
	}
	mail("turtell@yandex.ru", "сheckActiveProducts at ".date("d.m.Y H:i"), $str); 
	
}


$fcode = "datafile";

if(file_exists($_FILES[$fcode]["tmp_name"])) 
{
	// читаем что пришло в массив
	$arOffers = Array();
	if($_FILES[$fcode]["tmp_name"])
	{
		$csv = file($_FILES[$fcode]["tmp_name"]);
		$f = fopen($_SERVER["DOCUMENT_ROOT"]."/tools/importlog.txt", "a+");
		fwrite($f, date("d.m.Y H:i:s", time())." - ".$_SERVER["REMOTE_ADDR"]."\n");	
		$num = 0;
		foreach($csv as $row) 
		{
			if(trim($row) == "") continue; 
			$t = explode(";", $row);
			$arOffers[trim($t[0])] = trim($t[1]);
			fwrite($f, trim($row)."\n");	
			$num++;
		}
		fwrite($f, "count - ".$num."\n");	
		fwrite($f, "\n");	
		fclose($f);
	}
	//prn($arOffers);
	
	
	$totalFlag = true;
	Cmodule::IncludeModule('catalog');
	if(count($arOffers)>0)
	{
		$dbRes = CIBlockElement::GetList(Array(), Array("XML_ID" => array_keys($arOffers)), false, false, Array("ID", "XML_ID"));
		while($arRes = $dbRes->GetNext())
		{
			$res = CCatalogProduct::Update($arRes["ID"], array('QUANTITY' => $arOffers[$arRes["XML_ID"]]));
			if(!$res) $totalFlag = false;
			//prn($arRes["XML_ID"]." = ".$arOffers[$arRes["XML_ID"]]." - ".($res ? "OK" : "ERROR"));
		}
	}
	else 
		echo "ERROR. Empty file";

	сheckActiveProducts_();
	
	if($totalFlag) echo "OK"; else echo "ERROR";
	
}
else echo "ERROR. No file";
?>