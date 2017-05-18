<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(is_array($arResult["DETAIL_PICTURE"]))
{


	$arResult["DETAIL_IMG"] = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE'],
		array("width" => 333, "height" => 500),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		true,
		$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real",  
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
				
	$arResult["ORIGINAL_IMG"] = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE'],
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
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
			
	/*
	prn($arResult["DETAIL_PICTURE"]);
	prn($arResult["DETAIL_IMG"]);
	prn($arResult["ORIGINAL_IMG"]);
	*/
}

//pra($arResult["PROPERTIES"]["COLLECTION"]["VALUE"]);
//pra($_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png");
//pra($arResult['MORE_PHOTO']);

if (is_array($arResult['MORE_PHOTO']) && count($arResult['MORE_PHOTO']) > 0)
{
	unset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']);

	foreach ($arResult['MORE_PHOTO'] as $key => $arFile)
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array("name" => "sharpen", "precision" => $arParams["SHARPEN"]);
		}
		$arFileTmp = CFile::ResizeImageGet(
			$arFile,
			array("width" => $arParams["DISPLAY_MORE_PHOTO_WIDTH"], "height" => $arParams["DISPLAY_MORE_PHOTO_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, $arFilter
		);
		
		
		/* ========= ЗАГОТОВКА ДЛЯ ФОТО ПО КЛИКУ =======
		$arFileMoreOriginal = CFile::ResizeImageGet(
			$arFile,
			array("width" => 332, "height" => 500),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
		*/
		
		$arFileOriginal = CFile::ResizeImageGet(
			$arFile,
			array(),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
		
		

		$arFile['PREVIEW_WIDTH'] = $arFileTmp["width"];
		$arFile['PREVIEW_HEIGHT'] = $arFileTmp["height"];

		$arFile['SRC'] = $arFileTmp['src'];
		$arResult['MORE_PHOTO'][$key] = $arFile;
		$arResult['MORE_PHOTO'][$key]["ORIGINAL"] = $arFileOriginal;
		//$arResult['MORE_PHOTO'][$key]["FOR_MAIN_PICTURE"] = $arFileMoreOriginal;     // ДЛЯ ФОТО ПО КЛИКУ
	}
	
	//prn($arResult);
	
}

//pra($arResult["OFFE);
$arImages = Array();
if(is_array($arResult["DETAIL_PICTURE"])) $arImages[] = $arResult["DETAIL_PICTURE"]["DESCRIPTION"];
foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $k => $id) $arImages[] = $arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$k];
$arResult["IMAGES"] = $arImages;
//pra($arImages);



// Создадим таблицу для выбора торговых предложений
// выберем правильные названия цветов и их изображения

$arTmpColors=Array();
$arTmpSizes=Array();
$arColorVars=Array();
foreach($arResult["OFFERS"] as $key => $offer) {
	
	// выясним какой offer нужно показать
	if(strpos(" ".$offer["XML_ID"], strVal($_GET["offer"])) > 0) 
	{
		//$arActiveOffer = $offer;
		$arResult["ACTIVE_COLOR_VALUE_ID"] = $offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"];
		$arResult["ACTIVE_SIZE_VALUE_ID"]  = $offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"];
	}
	
	//pra(strVal($_GET["offer"]));
	//pra($offer["XML_ID"]);
	//pra("<hr/>");
	
	$arTmpColors[$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
	$arTmpSizes[$offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["SIZE"]["VALUE"];
	if((!in_array($offer["PROPERTIES"]["COLOR"]["VALUE"], $arColorVars))&&(strLen($offer["PROPERTIES"]["COLOR"]["VALUE"])>0)) $arColorVars[]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
	}
	
	
// Ели предложение указано в URL, но его нет на сайте
if(strLen(strVal($_GET["offer"])) > 0)
{
	if(!isset($arResult["ACTIVE_COLOR_VALUE_ID"]) && !isset($arResult["ACTIVE_SIZE_VALUE_ID"]))
		define("ERROR_404", "Y");
}
	
	
$arColors=Array();
$arSizes=Array();
foreach($arTmpColors as $k=>$v) if(trim($v)!="") $arColors[$v]["ITEMS"][]=$k;
foreach($arTmpSizes as $k=>$v) if(trim($v)!="") $arSizes[$v][]=$k;

//prn($arColors);
if(count($arColors)>0) 
{
	$arSelect = Array("NAME","XML_ID","DETAIL_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>8, "XML_ID" => $arColorVars);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($arFields = $res->GetNext()) {
		$arColors[$arFields["XML_ID"]]["DISPLAY_NAME"]=$arFields["NAME"];
		$arColors[$arFields["XML_ID"]]["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 30, "height" => 30), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arColors[$arFields["XML_ID"]]["DETAIL_PICTURE"] = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 150, "height" => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		}

	ksort($arSizes);
	ksort($arColors);

	$arResult["SKU_TABLE"]=Array(
		"COLORS" => $arColors,
		"SIZES" => $arSizes
		);

		
		
		
		
	// Перечень существующих значений цветов (для подсветки цветов которые есть в наличии при загрузке страницы)
	$arExColors = Array();
	foreach($arResult["OFFERS"] as $key=>$offer) {
		if($offer["CATALOG_QUANTITY"]>0) {
			$arExColors[]=$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"];
			}
		}
	$arResult["EXIST_COLORS"]=$arExColors;

	// Если нет ни одного товара в наличии то ставим параметр NO_QUANTITY
	if(count($arResult["EXIST_COLORS"])<1) $arResult["NO_QUANTITY"]="Y";
}



//pra($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]);
//pra($_GET["color"]);
foreach($arResult["SKU_TABLE"]["COLORS"] as $ccode => &$arColor)
{
	// выясним какой цвет сразу переключить при загрузке страницы, если указан color в URL
	if($ccode == $arActiveColor) pra("YES");
	/*
	$colorcode = str_replace("/", "", str_replace("-", "", str_replace(" ", "", str_replace(".", "", $ccode))));
	if(!empty($_GET["color"]))
	{
		if(trim($_GET["color"]) == trim($colorcode)) 
		{
			$arColor["ACTIVE_COLOR"] = "Y";
			$arResult["OFFER_TO_SHOW"] = $arColor["ITEMS"][0];
		}
	}
	*/
	
	foreach($arResult["IMAGES"] as $desc)
	{
		if(stripos(" ".$desc, trim($ccode)) > 0) 
		{
			$arColor["PHOTO_IS"] = "Y";
		}
	}
}




// ===========================================================================================
//   Сформируем таблицу для вывода свойств в табличном виде (отсортировав по SORT)
// ===========================================================================================
$arSort = Array();
foreach($arResult["DISPLAY_PROPERTIES"] as $key => $arProp)
{
	$arSort[$key] = $arProp["SORT"];
	if(strpos($arProp["DISPLAY_VALUE"], "||")>0)
	{
		$t = explode("||", $arProp["DISPLAY_VALUE"]);
		$arSizeColumns = explode(";", $t[0]);
	}
}

asort($arSort);
$arNew = Array();
foreach($arSort as $code => $arProp)
{
	$arNew[$code] = $arResult["DISPLAY_PROPERTIES"][$code];
}
$arResult["DISPLAY_PROPERTIES"] = $arNew;


$prop_table = "<table class='good_props col".count($arSizeColumns)."'>";
if(count($arSizeColumns)>0)
{

	$prop_table .= "<tr><th>Размер</th>";
	foreach($arSizeColumns as $val)
	{
		$prop_table .= "<th>".$val."</th>";
	}
	$prop_table .= "</tr>";
}
foreach($arResult["DISPLAY_PROPERTIES"] as $arProp)
{
	if($arProp["CODE"] == "MORE_PHOTO") continue;
	if($arProp["CODE"] == "CML2_ARTICLE") continue;
	if(strpos($arProp["DISPLAY_VALUE"], "||")>0)
	{
		$t = explode("||", $arProp["DISPLAY_VALUE"]);
		$arSizeValues = explode(";", $t[1]);
		$prop_table .= "<tr>";
		$prop_table .= "<td>".$arProp["NAME"]."</td>";
		foreach($arSizeValues as $dVal)
		{
			$prop_table .= "<td>".$dVal."</td>";
		}
		$prop_table .= "</tr>";
	}
	else
	{
		$prop_table .= "<tr>";
		$prop_table .= "<td>".$arProp["NAME"]."</td>";
		$prop_table .= "<td colspan='".count($arSizeColumns)."'>".$arProp["DISPLAY_VALUE"]."</td>";
		$prop_table .= "</tr>";
	}
}
$prop_table .= "</table>";
$arResult["PROPS_TABLE"] = $prop_table;




//pra($_SERVER);
//pra($_SERVER["QUERY_STRING"]);
//pra($_GET["color"]);
//pra($arResult);
//pra($arResult["SKU_TABLE"]);
//pra($arResult["PROPERTIES"]["DLINA_RUKAVA_SM"]["VALUE"]);

//pra($arResult["PROPERTIES"]["DLINA_IZDELIYA_SM"]["NAME"]);
//pra($arResult["PROPERTIES"]["DLINA_IZDELIYA_SM"]["VALUE"]);
?>