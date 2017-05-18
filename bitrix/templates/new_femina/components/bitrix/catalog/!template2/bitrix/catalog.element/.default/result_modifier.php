<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();








function sortOffersInItem_($arItem)
{
	global $USER;
	
	$PROPERTY_COLOR_CODE = "=PROPERTY_193";  // код свойства цвет торговых предлжожений 
	$PROPERTY_TONE_CODE = "=PROPERTY_127";   // код свойства оттенок торговых предложений
	
	// сортируем по имени по возрастанию
	$arSort = Array();
	foreach($arItem["OFFERS"] as $k => $arOffer) $arSort[$k] = $arOffer["NAME"];
	asort($arSort);
	$arNew = Array();
	foreach($arSort as $key=>$arr) $arNew[] = $arItem["OFFERS"][$key];
	$arItem["OFFERS"] = $arNew;
	
	if(isset($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_COLOR_CODE]))
	{
		$arColors = $GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_COLOR_CODE];
		$arRes = CIBlockPropertyEnum::GetByID($arColors[0]);
		$FIRST_COLOR = strtoupper($arRes["VALUE"]);
		
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if(stripos(" ".$arOffer["NAME"], $FIRST_COLOR) > 0) $arFirstOffers[] = $arOffer;
			else $arLastOffers[] = $arOffer;			
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
	}
	elseif(isset($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_TONE_CODE]))
	{
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		
		foreach($arItem["OFFERS"] as $arOffer)
		{
			foreach($GLOBALS["arrFilter"]["OFFERS"][$PROPERTY_TONE_CODE] as $color)
			{
				if(in_array($color, $arOffer["DISPLAY_PROPERTIES"]["TONE"]["VALUE"])) $arFirstOffers[] = $arOffer;
				else $arLastOffers[] = $arOffer;
			}
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
		//foreach($arItem["OFFERS"] as $arOffer) prn($arOffer["NAME"]);
	}
	else
	{
		// 1) сначала в качестве главного offer выберем offer с фото
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if(is_array($arOffer["MORE_PHOTO"]) || ( is_array($arOffer["DETAIL_PICTURE"]) && ($arOffer["DETAIL_PICTURE"]["SRC"] != "/upload/no_female_big.gif"))) 
			{
				$FIRST_COLOR = strtoupper(trim($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]));
				//prn($arOffer["NAME"]);
				break;
			};
		};
		//prn($FIRST_COLOR);
		
		
		// 2) далее, если в главном фото товара указан offer с фото, то назначим главным тогда его, иначе оставляем выбранный на первом этапе
		$t = explode("ЦВЕТ", strtoupper($arItem["DETAIL_PICTURE"]["DESCRIPTION"]));
		$var = "";   // возможный вариант цвета
		if(isset($t[1]))
			$var = strtoupper(trim($t[1]));
		else 
			$var = strtoupper(trim($t[0]));
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if( (stripos(" ".$arOffer["NAME"], $var) > 0)/*  && is_array($arOffer["MORE_PHOTO"])*/) 
			{
				$FIRST_COLOR = strtoupper(trim($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]));
				break;
			};
		};
		pra($FIRST_COLOR);
	
		
		
		$arFirstOffers = Array();
		$arLastOffers = Array();
		$arNewOffers = Array();
		
		foreach($arItem["OFFERS"] as $arOffer)
		{
			if(stripos(" ".$arOffer["NAME"], $FIRST_COLOR) > 0) $arFirstOffers[] = $arOffer;
			else $arLastOffers[] = $arOffer;			
		}
		$arNewOffers = array_merge($arFirstOffers, $arLastOffers);
		$arItem["OFFERS"] = $arNewOffers;
	}
	return $arItem;
}






/*
foreach($arResult["OFFERS"] as $arOffer)
{
	prn($arOffer["NAME"]);
	prn($arOffer["CATALOG_QUANTITY"]);
}
echo "<hr>";
*/









// ===========================================================================================
//   Подставим фото для торговых предложений из свойства MORE_PHOTO и DETAIL_PICTURE товара
//   (тело функции в init.php)
// ===========================================================================================
if(function_exists("setOfferPictures"))
	$arResult = setOfferPictures($arResult, false);

// ===========================================================================================
//   Сортируем торговые предложения чтоб первым шло то, чья картинка стоит основной
//   (тело функции в init.php)
// ===========================================================================================
if(function_exists("sortOffersInItem_"))
	$arResult = sortOffersInItem_($arResult);

// ===========================================================================================
//   Обработаем каждое MORE_PHOTO торговых предложений - нужные размеры и логотипы
// ===========================================================================================
foreach($arResult["OFFERS"] as $key => $arOffer)
{
	foreach($arOffer["MORE_PHOTO"] as $imgKey => $arImg)
	{
		$arResult["OFFERS"][$key]["MORE_PHOTO"][$imgKey]["ORIGINAL_PICTURE"] = CFile::ResizeImageGet(
			$arImg["ID"],
			array("width" => WIDTH_ORIGINAL_PHOTO, "height" => HEIGHT_ORIGINAL_PHOTO),
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
		$arResult["OFFERS"][$key]["MORE_PHOTO"][$imgKey]["MAIN_PICTURE"] = CFile::ResizeImageGet(
			$arImg["ID"],
			array("width" => WIDTH_MAIN_PHOTO, "height" => HEIGHT_MAIN_PHOTO),
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
		$arResult["OFFERS"][$key]["MORE_PHOTO"][$imgKey]["PREVIEW_PICTURE"] = CFile::ResizeImageGet(
			$arImg["ID"],
			array("width" => WIDTH_PREVIEW_PHOTO, "height" => HEIGHT_PREVIEW_PHOTO),
			BX_RESIZE_IMAGE_PROPORTIONAL, 
			true
			);
	}
}
/*
foreach($arResult["OFFERS"] as $key => $arOffer)
{
	prn($arOffer["MORE_PHOTO"]);
}
*/


//die();






/*
echo "<hr>";
foreach($arResult["OFFERS"] as $arOffer)
{
	prn($arOffer["NAME"]);
	prn($arOffer["CATALOG_QUANTITY"]);
}
*/





// по умолчанию в качестве основного выбираем первый OFFER
$SHOW_OFFER_ID = 0;
// либо нужно выбрать другой OFFER в зависимости от параметра offer в URL
if(strLen(trim(strVal($_GET["offer"]))) > 0) 
{
	$get_offer = $arResult["XML_ID"]."#".trim(strVal($_GET["offer"]));
	if(strLen($get_offer)>0)
	{
		foreach($arResult["OFFERS"] as $key => $arOffer)
		{
			if($arOffer["XML_ID"] == $get_offer)
			{
				$SHOW_OFFER_ID = $key;
				break;
			}
		}
	}
}
$arResult["DETAIL_PICTURE"] = $arResult["OFFERS"][$SHOW_OFFER_ID]["MORE_PHOTO"][0];
$arResult["MORE_PHOTO"] = $arResult["OFFERS"][$SHOW_OFFER_ID]["MORE_PHOTO"];
















// Создадим таблицу для выбора торговых предложений
// выберем правильные названия цветов и их изображения

$arTmpColors=Array();
$arTmpSizes=Array();
$arColorVars=Array();
foreach($arResult["OFFERS"] as $key => $offer) 
{
	// выясним какой offer нужно показать
	if(strpos(" ".$offer["XML_ID"], strVal($_GET["offer"])) > 0) 
	{
		$arResult["ACTIVE_COLOR_VALUE_ID"] = $offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"];
		$arResult["ACTIVE_SIZE_VALUE_ID"]  = $offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"];
	}
	$arTmpColors[$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
	$arTmpSizes[$offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["SIZE"]["VALUE"];
	if((!in_array($offer["PROPERTIES"]["COLOR"]["VALUE"], $arColorVars))&&(strLen($offer["PROPERTIES"]["COLOR"]["VALUE"])>0)) $arColorVars[]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
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
	$arResult["EXIST_COLORS"] = $arExColors;

	// Если нет ни одного товара в наличии то ставим параметр NO_QUANTITY
	if(count($arResult["EXIST_COLORS"])<1) $arResult["NO_QUANTITY"]="Y";

	
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








// подготвим массив для JS
$arJsPicts = Array();
$arJsEmptyPicts = Array();
foreach($arResult["OFFERS"] as $key => $arOffer)
{
	if($arOffer["MORE_PHOTO"][0]["ID"] == NOFOTO_FILE_ID)
	{
		$arJsEmptyPicts[$arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]] = Array(
			"DESCRIPTION" 	=> $arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"],
			"COLOR"			=> strtoupper($arOffer["PROPERTIES"]["COLOR_LIST"]["VALUE"]),
			"ORIGINAL" 		=> $arOffer["MORE_PHOTO"][0]["ORIGINAL_PICTURE"]["src"],
			"MAIN" 			=> $arOffer["MORE_PHOTO"][0]["MAIN_PICTURE"]["src"],
			"PREVIEW"	 	=> $arOffer["MORE_PHOTO"][0]["PREVIEW_PICTURE"]["src"]
		);	
	}
	else 
	{
		foreach($arOffer["MORE_PHOTO"] as $arImg)
		{
			$t = explode("ЦВЕТ", strtoupper($arImg["DESCRIPTION"]));
			if(count($t)>1) $kod = trim(strtoupper($t[1])); else $kod = trim(strtoupper($t[0]));
			$arJsPicts[$arImg["ID"]]["DESCRIPTION"] = $arImg["DESCRIPTION"];
			$arJsPicts[$arImg["ID"]]["COLOR"]		= $kod;
			$arJsPicts[$arImg["ID"]]["ORIGINAL"] 	= $arImg["ORIGINAL_PICTURE"]["src"];
			$arJsPicts[$arImg["ID"]]["MAIN"] 		= $arImg["MAIN_PICTURE"]["src"];
			$arJsPicts[$arImg["ID"]]["PREVIEW"] 	= $arImg["PREVIEW_PICTURE"]["src"];
		}
	}
}
$arJsEmptyPicts = array_values($arJsEmptyPicts);
$arJsPicts = array_values($arJsPicts);
$arResult["arJsPicts"] = array_merge($arJsEmptyPicts, $arJsPicts);


?>