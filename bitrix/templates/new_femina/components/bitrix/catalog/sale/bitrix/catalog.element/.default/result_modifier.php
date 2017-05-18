<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$curSkuView = COption::GetOptionString("eshop", "catalogDetailSku", "select", SITE_ID);

if(is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"]))
{
	$pricesCount = count($arResult["CAT_PRICES"]);
	$arOffersIblock = CIBlockPriceTools::GetOffersIBlock($arResult["IBLOCK_ID"]);
	$OFFERS_IBLOCK_ID = is_array($arOffersIblock)? $arOffersIblock["OFFERS_IBLOCK_ID"]: 0;
	$dbOfferProperties = CIBlock::GetProperties($OFFERS_IBLOCK_ID, Array(), Array("!XML_ID" => "CML2_LINK"));
	$arIblockOfferProps = array();
	$offerPropsExists = false;
	while($arOfferProperties = $dbOfferProperties->Fetch())
	{
		if (!in_array($arOfferProperties["CODE"],$arParams["OFFERS_PROPERTY_CODE"]))
			continue;
		$arIblockOfferProps[] = array("CODE" => $arOfferProperties["CODE"], "NAME" => $arOfferProperties["NAME"]);
		$offerPropsExists = true;
	}

	foreach($arIblockOfferProps as $key => $arCode)
	{
		$emptyProp = true;
		foreach($arResult["OFFERS"] as $key2=>$arOffer)
		{
			if (array_key_exists($arCode["CODE"], $arOffer["PROPERTIES"]) && !empty($arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]))
				$emptyProp = false;
		}
		if ($emptyProp)
			unset($arIblockOfferProps[$key]);
	}
	
	$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
	$arNotify = unserialize($notifyOption);

	$arSku = array();
	$allSkuNotAvailable = true;
	foreach($arResult["OFFERS"] as $arOffer)
	{
		foreach($arOffer["PRICES"] as $code=>$arPrice)
		{
			if($arPrice["CAN_ACCESS"])
			{
				if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"])
				{
					$minOfferPrice = $arPrice["DISCOUNT_VALUE"];
					$minOfferPriceFormat = $arPrice["PRINT_DISCOUNT_VALUE"];
				}
				else
				{
					$minOfferPrice = $arPrice["VALUE"];
					$minOfferPriceFormat = $arPrice["PRINT_VALUE"];
				}
				
				if ($minItemPrice > 0 && $minOfferPrice < $minItemPrice)
				{
					$minItemPrice = $minOfferPrice;
					$minItemPriceFormat = $minOfferPriceFormat;
				}
				elseif ($minItemPrice == 0)
				{
					$minItemPrice = $minOfferPrice;
					$minItemPriceFormat = $minOfferPriceFormat;
				}
			}
		}
		$arSkuTmp = array();
		if ($offerPropsExists)
		{
			foreach($arIblockOfferProps as $key => $arCode)
			{
				if (!array_key_exists($arCode["CODE"], $arOffer["PROPERTIES"]))
				{
					$arSkuTmp[] = GetMessage("EMPTY_VALUE_SKU");
					continue;
				}
				if (empty($arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]))
					$arSkuTmp[] = GetMessage("EMPTY_VALUE_SKU");
				elseif (is_array($arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]))
					$arSkuTmp[] = implode("/", $arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"]);
				else
					$arSkuTmp[] = $arOffer["PROPERTIES"][$arCode["CODE"]]["VALUE"];
			}
		}
		else
		{
			if (in_array("NAME", $arParams["OFFERS_FIELD_CODE"]))
				$arSkuTmp[] = $arOffer["NAME"];
			else
				break;
		}
		$arSkuTmp["ID"] = $arOffer["ID"];
		foreach ($arOffer["PRICES"] as $code=>$arPrice)
		{
			if($arPrice["CAN_ACCESS"])
			{
				$arSkuTmp["PRICES"][$code]["TITLE"] = ($pricesCount > 1) ? $arResult["CAT_PRICES"][$code]["TITLE"] : "";
				if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"])
				{
					$arSkuTmp["PRICES"][$code]["PRICE"] = $arPrice["PRINT_VALUE"];
					$arSkuTmp["PRICES"][$code]["DISCOUNT_PRICE"] = $arPrice["PRINT_DISCOUNT_VALUE"];
				}
				else
				{
					$arSkuTmp["PRICES"][$code]["PRICE"] = $arPrice["PRINT_VALUE"];
					$arSkuTmp["PRICES"][$code]["DISCOUNT_PRICE"] = "";
				}
			}
		}

		if (CModule::IncludeModule('sale'))
		{
			$dbBasketItems = CSaleBasket::GetList(
				array(
					"ID" => "ASC"
				),
				array(
					"PRODUCT_ID" => $arOffer['ID'],
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL",
				),
				false,
				false,
				array()
			);
			$arSkuTmp["CART"] = "";
			if ($arBasket = $dbBasketItems->Fetch())
			{
				if($arBasket["DELAY"] == "Y")
					$arSkuTmp["CART"] = "delay";
				elseif ($arBasket["SUBSCRIBE"] == "Y" &&  $arNotify[SITE_ID]['use'] == 'Y')
					$arSkuTmp["CART"] = "inSubscribe";
				else
					$arSkuTmp["CART"] = "inCart";
			}
		}
		$arSkuTmp["CAN_BUY"] = $arOffer["CAN_BUY"];
		if ($arOffer["CAN_BUY"])
			$allSkuNotAvailable = false;
		$arSkuTmp["ADD_URL"] = htmlspecialcharsback($arOffer["ADD_URL"]);
		$arSkuTmp["SUBSCRIBE_URL"] = htmlspecialcharsback($arOffer["SUBSCRIBE_URL"]);
		$arSkuTmp["COMPARE"] = "";
		if (isset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$arOffer["ID"]]))
			$arSkuTmp["COMPARE"] = "inCompare";
		$arSkuTmp["COMPARE_URL"] = htmlspecialcharsback($arOffer["COMPARE_URL"]);
		$arSku[] = $arSkuTmp;
	}
	$arResult["MIN_PRODUCT_OFFER_PRICE"] = $minItemPrice;
	$arResult["MIN_PRODUCT_OFFER_PRICE_PRINT"] = $minItemPriceFormat;


	if ((!is_array($arIblockOfferProps) || empty($arIblockOfferProps)) && is_array($arSku) && !empty($arSku))
		$arIblockOfferProps[] = array("CODE" => "TITLE", "NAME" => GetMessage("CATALOG_OFFER_NAME"));
	$arResult["SKU_ELEMENTS"] = $arSku;
	$arResult["SKU_PROPERTIES"] = $arIblockOfferProps;
	$arResult["ALL_SKU_NOT_AVAILABLE"] = $allSkuNotAvailable;
}
$arResult["POPUP_MESS"] = array(
	"addToCart" => GetMessage("CATALOG_ADD_TO_CART"),
	"inCart" => GetMessage("CATALOG_IN_CART"),
	"delayCart" => GetMessage("CATALOG_IN_CART_DELAY"),
	"subscribe" =>  GetMessage("CATALOG_SUBSCRIBE"),
	"inSubscribe" =>  GetMessage("CATALOG_IN_SUBSCRIBE"),
	"notAvailable" =>  GetMessage("CATALOG_NOT_AVAILABLE"),
	"addCompare" => GetMessage("CT_BCE_CATALOG_COMPARE"),
	"inCompare" => GetMessage("CATALOG_IN_COMPARE"),
	"chooseProp" => GetMessage("CATALOG_CHOOSE"),
);
//$arResult["PREVIEW_TEXT"] = strip_tags($arResult["PREVIEW_TEXT"]);
$this->__component->arResult["DISPLAY_PROPERTIES"] = $arResult["DISPLAY_PROPERTIES"];
$this->__component->arResult["DETAIL_TEXT"] = $arResult["DETAIL_TEXT"];
$this->__component->arResult["CAN_BUY"] = $arResult["CAN_BUY"];

/*if (COption::GetOptionString("eshop", "catalogDetailSku", "select", SITE_ID) == "list")
{
	$this->__component->arResult["OFFERS_IDS"] = array();

	if(is_array($arResult["OFFERS"]) && !empty($arResult["OFFERS"])){
		foreach($arResult["OFFERS"] as $arOffer){
			$this->__component->arResult["OFFERS_IDS"][] = $arOffer["ID"];
		}
	}
}    */

if ($arParams['USE_COMPARE'])
{
	$delimiter = strpos($arParams['COMPARE_URL'], '?') ? '&' : '?';

	//$arResult['COMPARE_URL'] = str_replace("#ACTION_CODE#", "ADD_TO_COMPARE_LIST",$arParams['COMPARE_URL']).$delimiter."id=".$arResult['ID'];

	$arResult['COMPARE_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arResult['ID'], array("action", "id")));
}

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
	}
	
	//prn($arResult);
	
}


if (CModule::IncludeModule('currency'))
{
	if (isset($arResult['DISPLAY_PROPERTIES']['MINIMUM_PRICE']))
		$arResult['DISPLAY_PROPERTIES']['MINIMUM_PRICE']['DISPLAY_VALUE'] = FormatCurrency($arResult['DISPLAY_PROPERTIES']['MINIMUM_PRICE']['VALUE'], CCurrency::GetBaseCurrency());
	if (isset($arResult['DISPLAY_PROPERTIES']['MAXIMUM_PRICE']))
		$arResult['DISPLAY_PROPERTIES']['MAXIMUM_PRICE']['DISPLAY_VALUE'] = FormatCurrency($arResult['DISPLAY_PROPERTIES']['MAXIMUM_PRICE']['VALUE'], CCurrency::GetBaseCurrency());
}

$this->__component->SetResultCacheKeys(array("DISPLAY_PROPERTIES"));
$this->__component->SetResultCacheKeys(array("DETAIL_TEXT"));
$this->__component->SetResultCacheKeys(array("CAN_BUY"));
//$this->__component->SetResultCacheKeys(array("OFFERS_IDS"));



// Создадим таблицу для выбора торговых предложений
// выберем правильные названия цветов и их изображения

$arTmpColors=Array();
$arTmpSizes=Array();
$arColorVars=Array();
foreach($arResult["OFFERS"] as $key => $offer) {
	$arTmpColors[$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
	$arTmpSizes[$offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["SIZE"]["VALUE"];
	if((!in_array($offer["PROPERTIES"]["COLOR"]["VALUE"], $arColorVars))&&(strLen($offer["PROPERTIES"]["COLOR"]["VALUE"])>0)) $arColorVars[]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
	}
$arColors=Array();
$arSizes=Array();
foreach($arTmpColors as $k=>$v) if(trim($v)!="") $arColors[$v]["ITEMS"][]=$k;
foreach($arTmpSizes as $k=>$v) if(trim($v)!="") $arSizes[$v][]=$k;

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


/*
$db_res = CCatalogGroup::GetGroupsList(array("GROUP_ID"=>2, "BUY"=>"N"));
while ($ar_res = $db_res->Fetch())
{
   echo $ar_res["CATALOG_GROUP_ID"].", ";
}
*/

	
	
/*
unset($first);
foreach($arResult["OFFERS"] as $key=>$offer) {
	if($offer["CATALOG_QUANTITY"]>0) {
		$arResult["START_OFFER_COLOR"]=$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"];
		$arResult["START_OFFER_SIZE"]=$offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"];
		break;
		}
	}
*/
	
	
/*if($USER->isAuthorized()) $price_group=2;
else $price_group=3;

$arSelect=Array();
$arSizes=Array();
foreach($arResult["OFFERS"] as $key => $offer) {
	if((strLen($offer["PROPERTIES"]["COLOR"]["VALUE"])>0)&&(strLen($offer["PROPERTIES"]["SIZE"]["VALUE"])>0)) {
		$arSelect[$offer["PROPERTIES"]["COLOR"]["VALUE"]][$offer["PROPERTIES"]["SIZE"]["VALUE"]] = Array(
			"ID" => $offer["ID"],
			"COUNT" => $offer["CATALOG_QUANTITY"],
			"PRICE_GROUP" => $price_group,
			"PRICE" => $offer["CATALOG_PRICE_".$price_group]
			);
		$arSizes[$offer["PROPERTIES"]["SIZE"]["VALUE"]]=1;
		}
	};
ksort($arSizes);

foreach($arSelect as $key => $offer) {
	foreach($arSizes as $size=>$val) {
		if(!isset($offer[$size])) $arSelect[$key][$size]=false;
		}
	ksort($arSelect[$key]);
}

ksort($arSelect);

$arResult["SKU"]=$arSelect;
//print_r($arSizes);
*/

//prn($arResult);

?>