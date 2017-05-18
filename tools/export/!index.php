<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?

//prn($_GET);

// читаем configs
$f = file(__DIR__."/config.txt");
$arConfig = Array();
foreach($f as $row)
{
	$t = explode(";", $row);
	$params = Array();
	foreach($t as $part) 
	{
		$tt = explode(";", $part);
		foreach($tt as $p)
		{
			$ttt = explode("=", $p);
			if($t[0] != $ttt[0])
				$params[$ttt[0]] = explode(",", $ttt[1]);
		}
	}
	$arConfig[$t[0]] = $params;
}



function wLog($str)
{
	$f = fopen($_SERVER["DOCUMENT_ROOT"]."/tools/export/log.txt", "a+");
	fwrite($f, date("d.m.Y H:i:s", time())." - ".$str."\n");
	fclose($f);	
}


$CLIENT = strVal(trim($_GET["client"]));
$SECTION = strVal(trim($_GET["section"]));
wLog($_SERVER["REMOTE_ADDR"]."; ".$_SERVER["REQUEST_URI"]);

// идентифицируем клиента по логину client
if(!isset($arConfig[$client])) 
{
	wLog($_SERVER["REMOTE_ADDR"]."; ERROR. Client is not identified");
	die("Client is not identified");
}
else $arConfig = $arConfig[$client];

// проверим соответсвие IP адреса
if(!in_array($_SERVER["REMOTE_ADDR"], $arConfig["IP"])) {
	wLog($_SERVER["REMOTE_ADDR"]."; ERROR. Client identified, incorrect IP address");
	die("Client identified. But incorrect IP address");	
}


//prn($arConfig);
//die();


$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ACTIVE" => "Y"), false, false, Array("ID", "PROPERTY_CML2_ARTICLE", "XML_ID", "NAME", "DETAIL_PICTURE", "DETAIL_PAGE_URL"));
$num = 0;
$arGoods = Array();
while($arRes = $dbRes->GetNext())
{
	$src = "";
	if(in_array("DETAIL_PICTURE", $arConfig["PRODUCT_FIELDS"]))
	{
		if($arRes["DETAIL_PICTURE"]>0) 
		{
			$arFileTmp = CFile::ResizeImageGet(
				$arRes["DETAIL_PICTURE"],
				array("width" => 550, "height" => 800),
				BX_RESIZE_IMAGE_PROPORTIONAL, 
				true,
				$arFilters = Array(
						array(
							"name" => "watermark", 
							"position" => "bottom right", 
							//"position" => "center", 
							"alpha_level" => "30", 
							"size"=>"big", 
							"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_VAY.png"
							)
						)
					);
			$src = "http://".$_SERVER["SERVER_NAME"].$arFileTmp["src"];
		}
	}
	$arGoods[$arRes["ID"]] = Array(
		"ARTIKUL" => $arRes["PROPERTY_CML2_ARTICLE_VALUE"],
		"NAME" => $arRes["NAME"],
		"XML_ID" => $arRes["XML_ID"],
		"URL" => "http://".$_SERVER["SERVER_NAME"].$arRes["DETAIL_PAGE_URL"],
		"DETAIL_PICTURE" => $src
		);
	$num++;
	//if($num>100) break;
}

$arSort = Array();
foreach($arGoods as $key => $ar) $arSort[$ar["URL"]] = $key;
ksort($arSort);
$arNew = Array();
foreach($arSort as $k => $v) $arNew[$v] = $arGoods[$v];
$arGoods = $arNew;



//prn($arGoods);

//die();

$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ACTIVE" => "Y"), false, false, Array("ID", "XML_ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.ID", "CATALOG_QUANTITY", "PROPERTY_COLOR", "PROPERTY_SIZE"));
$num = 0;
$arOffers = Array();
while($arRes = $dbRes->GetNext())
{
	if($arRes["CATALOG_QUANTITY"] > 0)
	{
		$t = explode("#", $arRes["XML_ID"]);
		$arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["OFFERS"][$arRes["XML_ID"]] = Array(
			"NAME" => $arRes["NAME"],
			"QUANTITY" => $arRes["CATALOG_QUANTITY"],
			"COLOR" => $arRes["PROPERTY_COLOR_VALUE"],
			"SIZE" => $arRes["PROPERTY_SIZE_VALUE"],
			"XML_ID" => $arRes["XML_ID"],
			"URL" => $arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["URL"]."?offer=".$t[1]
			);
		$arOffers[$arRes["PROPERTY_CML2_LINK_VALUE"]]++;
	}
	$num++;
	//if($num>10) break;
}
//die();


$arRes = Array();
foreach($arGoods as $arGood)
{
	$str = "";
	$str .= "GOOD;";	
	foreach($arConfig["PRODUCT_FIELDS"] as $field) $str .= $arGood[trim($field)].";";
	$arRes[] = substr($str, 0, strLen($str)-1);

	foreach($arGood["OFFERS"] as $arOffer)
	{
		$strOffer = "";
		$strOffer .= "OFFER;";
		foreach($arConfig["OFFER_FIELDS"] as $field) $strOffer .= $arOffer[trim($field)].";";
		$arRes[] = substr($strOffer, 0, strLen($strOffer)-1);
	}
}


foreach($arRes as $row) echo $row."<br/>";
wLog($_SERVER["REMOTE_ADDR"]."; OK");


?>