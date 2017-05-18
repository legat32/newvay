<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?


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

if(isset($arConfig["INTERVAL"])) $interval = intVal($arConfig["INTERVAL"][0]);
else $interval = 1000000; 








 
CModule::IncludeModule("iblock");


// Пути по именам разделов
$arSections = Array();
$arPath = Array();
$arFilter = array('IBLOCK_ID' => 6, 'ACTIVE' => 'Y', 'CNT_ACTIVE' => 'Y'); 
$arSelect = array('ID', 'IBLOCK_SECTION_ID', 'NAME', 'SORT', 'ELEMENT_CNT', 'DEPTH_LEVEL');
$rsSection = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter, true, $arSelect);
while($arSection = $rsSection->Fetch()) {
	if($arSection["ELEMENT_CNT"] < 1) continue;
	$arPath[$arSection["DEPTH_LEVEL"]] = $arSection["NAME"];
	$path = "";
	for($i=0; $i<$arSection["DEPTH_LEVEL"]; $i++) $path .= $arPath[$i]."/";
	$path .= $arSection["NAME"]."/";
	$arSections[$arSection["ID"]] = trim(substr($path, 1, strLen($path)-2));
}






$arID = Array();
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ACTIVE" => "Y"), false, false, Array("ID", "NAME"));
while($arRes = $dbRes->GetNext())
{
	$arID[] = $arRes["ID"];
}
sort($arID);
//prd($arID);


$step = intVal($_GET["step"]);
if($step>=count($arID)) 
{
	wLog($_SERVER["REMOTE_ADDR"]."; ERROR. Too much step value, current limit is ".(count($arID)-1));
	die("Too much step value, current limit is ".(count($arID)-1));	
}





echo "STAT;".$step."-".($step+$interval)." from ".count($arID)."<br/>";
echo "STAT;GOOD;".implode(";", $arConfig["PRODUCT_FIELDS"])."<br/>";
echo "STAT;OFFER;".implode(";", $arConfig["OFFER_FIELDS"])."<br/>";
$arStepID = Array();
for($i=$step; $i<($step+$interval); $i++)
{
	if(!isset($arID[$i])) break;
	$arStepID[] = $arID[$i];
}
//prn($arConfig);
//prd($arStepID);






$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ACTIVE" => "Y", "ID" => $arStepID), false, false, Array("ID", "SECTION_ID", "PROPERTY_CML2_ARTICLE", "XML_ID", "NAME", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_MORE_PHOTO", "PROPERTY_DLINA_IZDELIYA_SM", "PROPERTY_SHIRINA", "PROPERTY_SOSTAV", "PROPERTY_COLLECTION"));
$num = 0;
$arGoods = Array();
while($arRes = $dbRes->GetNext())
{
	//prn($arRes);
	$arGoods[$arRes["ID"]]["ARTIKUL"] = $arRes["PROPERTY_CML2_ARTICLE_VALUE"];
	$arGoods[$arRes["ID"]]["NAME"] = $arRes["NAME"];
	$arGoods[$arRes["ID"]]["XML_ID"] = $arRes["XML_ID"];
	$arGoods[$arRes["ID"]]["SECTION"] = $arSections[$arRes["IBLOCK_SECTION_ID"]];
	$arGoods[$arRes["ID"]]["URL"] = "http://".$_SERVER["SERVER_NAME"].$arRes["DETAIL_PAGE_URL"];
	$arGoods[$arRes["ID"]]["SOSTAV"] = str_replace(";", ",", $arRes["PROPERTY_SOSTAV_VALUE"]);
	$arGoods[$arRes["ID"]]["DLINA"] = str_replace(";", ",", $arRes["PROPERTY_DLINA_IZDELIYA_SM_VALUE"]);
	$arGoods[$arRes["ID"]]["SHIRINA"] = str_replace(";", ",", $arRes["PROPERTY_SHIRINA_VALUE"]);
	
	// детальное фото
	if(in_array("DETAIL_PICTURE", $arConfig["PRODUCT_FIELDS"]))
	{
		$src = "";
		if($arRes["DETAIL_PICTURE"]>0) 
		{
			$t = CFile::GetFileArray($arRes["DETAIL_PICTURE"]);
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
							"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arRes["PROPERTY_COLLECTION_VALUE"].".png"
							)
						)
					);
			$src = "http://".$_SERVER["SERVER_NAME"].$arFileTmp["src"];
		}
		$arGoods[$arRes["ID"]]["DETAIL_PICTURE"] = "[".$t["DESCRIPTION"]."|".$src."]";
	}
	
	// MORE_PHOTO
	if(in_array("MORE_PHOTO", $arConfig["PRODUCT_FIELDS"]))
	{
		if($arRes["PROPERTY_MORE_PHOTO_VALUE"]>0)
		{
			$t = CFile::GetFileArray($arRes["PROPERTY_MORE_PHOTO_VALUE"]);
			$arFileTmp = CFile::ResizeImageGet(
				$arRes["PROPERTY_MORE_PHOTO_VALUE"],
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
							"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arRes["PROPERTY_COLLECTION_VALUE"].".png"
							)
						)
					);
			$arGoods[$arRes["ID"]]["MORE_PHOTO"] .= "[".$t["DESCRIPTION"]."|"."http://".$_SERVER["SERVER_NAME"].$arFileTmp["src"]."]";
		}
	}
	$num++;
	//if($num>1000) break;
}

$arSort = Array();
foreach($arGoods as $key => $ar) $arSort[$ar["URL"]] = $key;
ksort($arSort);
$arNew = Array();
foreach($arSort as $k => $v) $arNew[$v] = $arGoods[$v];
$arGoods = $arNew;






$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $arStepID), false, false, Array("ID", "XML_ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.ID", "CATALOG_QUANTITY", "PROPERTY_COLOR", "PROPERTY_SIZE", "CATALOG_GROUP_3"));
$num = 0;
$arOffers = Array();
while($arRes = $dbRes->GetNext())
{
	//echo $num."<br/>";
	//prn($arRes);
	if($arRes["CATALOG_QUANTITY"] > 0)
	{
		$t = explode("#", $arRes["XML_ID"]);
		$arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["OFFERS"][$arRes["XML_ID"]] = Array(
			"NAME" => $arRes["NAME"],
			"PRICE_OPT" => $arRes["CATALOG_PRICE_3"],
			"QUANTITY" => $arRes["CATALOG_QUANTITY"],
			"COLOR" => $arRes["PROPERTY_COLOR_VALUE"],
			"SIZE" => $arRes["PROPERTY_SIZE_VALUE"],
			"XML_ID" => $arRes["XML_ID"],
			"URL" => $arGoods[$arRes["PROPERTY_CML2_LINK_VALUE"]]["URL"]."?offer=".$t[1]
			);
		$arOffers[$arRes["PROPERTY_CML2_LINK_VALUE"]]++;
	}
	$num++;
	//if($num>1000) break;
}
//prn($arGoods);
//prn($arOffers);
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

//echo "ok";
foreach($arRes as $row) echo $row."<br/>";
wLog($_SERVER["REMOTE_ADDR"]."; OK");




/*
if(($step+$interval)<=count($arID))
{
	//echo '<hr/><a id="go" href="/tools/img_sync_all.php?step='.($step+$interval).'">Следующий шаг</a>';
	?>
	<script>
		setTimeout( function(){document.location.href='/tools/export/indexEx.php?client=<?=$CLIENT?>&step=<?=($step+$interval)?>';}, 5000);
	</script>
	<?
}
else echo "FINISHED";
*/
?>