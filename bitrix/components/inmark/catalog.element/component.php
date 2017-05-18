<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
global $DB;
/** @global CUser $USER */
global $USER;
/** @global CMain $APPLICATION */
global $APPLICATION;
/** @global CCacheManager $CACHE_MANAGER */
global $CACHE_MANAGER;

//die('tut');

CUtil::InitJSCore(array('popup'));

/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);

$arParams["ELEMENT_ID"] = intval($arParams["~ELEMENT_ID"]);
if($arParams["ELEMENT_ID"] > 0 && $arParams["ELEMENT_ID"]."" != $arParams["~ELEMENT_ID"])
{
	ShowError(GetMessage("CATALOG_ELEMENT_NOT_FOUND"));
	@define("ERROR_404", "Y");
	if($arParams["SET_STATUS_404"]==="Y")
		CHTTP::SetStatus("404 Not Found");
	return;
}

$arParams["SECTION_URL"]=trim($arParams["SECTION_URL"]);
$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);
$arParams["BASKET_URL"]=trim($arParams["BASKET_URL"]);
if(strlen($arParams["BASKET_URL"])<=0)
	$arParams["BASKET_URL"] = "/personal/basket.php";

$arParams["ACTION_VARIABLE"]=trim($arParams["ACTION_VARIABLE"]);
if(strlen($arParams["ACTION_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["ACTION_VARIABLE"]))
	$arParams["ACTION_VARIABLE"] = "action";

$arParams["PRODUCT_ID_VARIABLE"]=trim($arParams["PRODUCT_ID_VARIABLE"]);
if(strlen($arParams["PRODUCT_ID_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_ID_VARIABLE"]))
	$arParams["PRODUCT_ID_VARIABLE"] = "id";

$arParams["PRODUCT_QUANTITY_VARIABLE"]=trim($arParams["PRODUCT_QUANTITY_VARIABLE"]);
if(strlen($arParams["PRODUCT_QUANTITY_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_QUANTITY_VARIABLE"]))
	$arParams["PRODUCT_QUANTITY_VARIABLE"] = "quantity";

$arParams["PRODUCT_PROPS_VARIABLE"]=trim($arParams["PRODUCT_PROPS_VARIABLE"]);
if(strlen($arParams["PRODUCT_PROPS_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_PROPS_VARIABLE"]))
	$arParams["PRODUCT_PROPS_VARIABLE"] = "prop";

$arParams["SECTION_ID_VARIABLE"]=trim($arParams["SECTION_ID_VARIABLE"]);
if(strlen($arParams["SECTION_ID_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["SECTION_ID_VARIABLE"]))
	$arParams["SECTION_ID_VARIABLE"] = "SECTION_ID";

$arParams["META_KEYWORDS"] = trim($arParams["META_KEYWORDS"]);
$arParams["META_DESCRIPTION"] = trim($arParams["META_DESCRIPTION"]);
$arParams["BROWSER_TITLE"] = trim($arParams["BROWSER_TITLE"]);

$arParams["SET_TITLE"] = $arParams["SET_TITLE"]!="N";
$arParams["ADD_SECTIONS_CHAIN"] = $arParams["ADD_SECTIONS_CHAIN"]!="N"; //Turn on by default

if(!is_array($arParams["PROPERTY_CODE"]))
	$arParams["PROPERTY_CODE"] = array();
foreach($arParams["PROPERTY_CODE"] as $k=>$v)
	if($v==="")
		unset($arParams["PROPERTY_CODE"][$k]);

if(!is_array($arParams["PRICE_CODE"]))
	$arParams["PRICE_CODE"] = array();
$arParams["USE_PRICE_COUNT"] = $arParams["USE_PRICE_COUNT"]=="Y";
$arParams["SHOW_PRICE_COUNT"] = intval($arParams["SHOW_PRICE_COUNT"]);
if($arParams["SHOW_PRICE_COUNT"]<=0)
	$arParams["SHOW_PRICE_COUNT"]=1;
$arParams["USE_PRODUCT_QUANTITY"] = $arParams["USE_PRODUCT_QUANTITY"]==="Y";

if(!is_array($arParams["PRODUCT_PROPERTIES"]))
	$arParams["PRODUCT_PROPERTIES"] = array();
foreach($arParams["PRODUCT_PROPERTIES"] as $k=>$v)
	if($v==="")
		unset($arParams["PRODUCT_PROPERTIES"][$k]);

if (!is_array($arParams["OFFERS_CART_PROPERTIES"]))
	$arParams["OFFERS_CART_PROPERTIES"] = array();
foreach($arParams["OFFERS_CART_PROPERTIES"] as $i => $pid)
	if ($pid === "")
		unset($arParams["OFFERS_CART_PROPERTIES"][$i]);

if (empty($arParams["OFFERS_SORT_FIELD"]))
	$arParams["OFFERS_SORT_FIELD"] = "sort";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["OFFERS_SORT_ORDER"]))
	$arParams["OFFERS_SORT_ORDER"] = "asc";
if (empty($arParams["OFFERS_SORT_FIELD2"]))
	$arParams["OFFERS_SORT_FIELD2"] = "id";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["OFFERS_SORT_ORDER2"]))
	$arParams["OFFERS_SORT_ORDER2"] = "desc";

$arParams["LINK_IBLOCK_TYPE"] = trim($arParams["LINK_IBLOCK_TYPE"]);
$arParams["LINK_IBLOCK_ID"] = intval($arParams["LINK_IBLOCK_ID"]);
$arParams["LINK_PROPERTY_SID"] = trim($arParams["LINK_PROPERTY_SID"]);
$arParams["LINK_ELEMENTS_URL"]=trim($arParams["LINK_ELEMENTS_URL"]);
if(strlen($arParams["LINK_ELEMENTS_URL"])<=0)
	$arParams["LINK_ELEMENTS_URL"] = "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#";

$arParams["SHOW_WORKFLOW"] = $_REQUEST["show_workflow"]=="Y";
if($arParams["SHOW_WORKFLOW"])
	$arParams["CACHE_TIME"] = 0;

$arParams['CACHE_GROUPS'] = trim($arParams['CACHE_GROUPS']);
if ('N' != $arParams['CACHE_GROUPS'])
	$arParams['CACHE_GROUPS'] = 'Y';

$arParams["PRICE_VAT_INCLUDE"] = $arParams["PRICE_VAT_INCLUDE"] !== "N";
$arParams["PRICE_VAT_SHOW_VALUE"] = $arParams["PRICE_VAT_SHOW_VALUE"] === "Y";

$arParams['CONVERT_CURRENCY'] = (isset($arParams['CONVERT_CURRENCY']) && 'Y' == $arParams['CONVERT_CURRENCY'] ? 'Y' : 'N');
$arParams['CURRENCY_ID'] = trim(strval($arParams['CURRENCY_ID']));
if ('' == $arParams['CURRENCY_ID'])
{
	$arParams['CONVERT_CURRENCY'] = 'N';
}
elseif ('N' == $arParams['CONVERT_CURRENCY'])
{
	$arParams['CURRENCY_ID'] = '';
}
if (empty($arParams['HIDE_NOT_AVAILABLE']))
	$arParams['HIDE_NOT_AVAILABLE'] = 'N';
elseif ('Y' != $arParams['HIDE_NOT_AVAILABLE'])
	$arParams['HIDE_NOT_AVAILABLE'] = 'N';

$arParams["OFFERS_LIMIT"] = intval($arParams["OFFERS_LIMIT"]);
if (0 > $arParams["OFFERS_LIMIT"])
	$arParams["OFFERS_LIMIT"] = 0;

$arParams['USE_ELEMENT_COUNTER'] = (isset($arParams['USE_ELEMENT_COUNTER']) && 'N' == $arParams['USE_ELEMENT_COUNTER'] ? 'N' : 'Y');

/*************************************************************************
			Processing of the Buy link
*************************************************************************/
$strError = "";

if (array_key_exists($arParams["ACTION_VARIABLE"], $_REQUEST) && array_key_exists($arParams["PRODUCT_ID_VARIABLE"], $_REQUEST))
{
	if(array_key_exists($arParams["ACTION_VARIABLE"]."BUY", $_REQUEST))
		$action = "BUY";
	elseif(array_key_exists($arParams["ACTION_VARIABLE"]."ADD2BASKET", $_REQUEST))
		$action = "ADD2BASKET";
	else
		$action = strtoupper($_REQUEST[$arParams["ACTION_VARIABLE"]]);

	$productID = intval($_REQUEST[$arParams["PRODUCT_ID_VARIABLE"]]);
	if (($action == "ADD2BASKET" || $action == "BUY" || $action == "SUBSCRIBE_PRODUCT") && $productID > 0)
	{
		if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
		{
			$QUANTITY = 0;
			$product_properties = array();
			$intProductIBlockID = intval(CIBlockElement::GetIBlockByID($productID));
			if (0 < $intProductIBlockID)
			{
				if ($intProductIBlockID == $arParams["IBLOCK_ID"])
				{
					if (!empty($arParams["PRODUCT_PROPERTIES"]))
					{
						if (
							array_key_exists($arParams["PRODUCT_PROPS_VARIABLE"], $_REQUEST)
							&& is_array($_REQUEST[$arParams["PRODUCT_PROPS_VARIABLE"]])
						)
						{
							$product_properties = CIBlockPriceTools::CheckProductProperties(
								$arParams["IBLOCK_ID"],
								$productID,
								$arParams["PRODUCT_PROPERTIES"],
								$_REQUEST[$arParams["PRODUCT_PROPS_VARIABLE"]]
							);
							if (!is_array($product_properties))
								$strError = GetMessage("CATALOG_ERROR2BASKET").".";
						}
						else
						{
							$strError = GetMessage("CATALOG_ERROR2BASKET").".";
						}
					}
				}
				else
				{
					if (!empty($arParams["OFFERS_CART_PROPERTIES"]))
					{
						$product_properties = CIBlockPriceTools::GetOfferProperties(
							$productID,
							$arParams["IBLOCK_ID"],
							$arParams["OFFERS_CART_PROPERTIES"]
						);
					}
				}
				if ($arParams["USE_PRODUCT_QUANTITY"])
				{
					if (isset($_REQUEST[$arParams["PRODUCT_QUANTITY_VARIABLE"]]))
					{
						$QUANTITY = doubleval($_REQUEST[$arParams["PRODUCT_QUANTITY_VARIABLE"]]);
					}
				}
				if (0 >= $QUANTITY)
				{
					$rsRatios = CCatalogMeasureRatio::getList(
						array(),
						array('PRODUCT_ID' => $productID),
						false,
						false,
						array('PRODUCT_ID', 'RATIO')
					);
					if ($arRatio = $rsRatios->Fetch())
					{
						$intRatio = intval($arRatio['RATIO']);
						$dblRatio = doubleval($arRatio['RATIO']);
						$QUANTITY = ($dblRatio > $intRatio ? $dblRatio : $intRatio);
					}
				}
				if (0 >= $QUANTITY)
					$QUANTITY = 1;
			}
			else
			{
				$strError = GetMessage('CATALOG_ELEMENT_NOT_FOUND').".";
			}

			$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
			$arNotify = unserialize($notifyOption);
			$arRewriteFields = array();
			if ($action == "SUBSCRIBE_PRODUCT" && $arNotify[SITE_ID]['use'] == 'Y')
			{
				$arRewriteFields["SUBSCRIBE"] = "Y";
				$arRewriteFields["CAN_BUY"] = "N";
			}

			
			
			
			
			
/*
			// добавляемое количество товара
			$quantity_add = $QUANTITY;
			
			// найдем количество такого товара в корзине
			$dbBasketItems = CSaleBasket::GetList(
				Array(),
				Array(
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"PRODUCT_ID" => $arFields["PRODUCT_ID"],
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL"
					),
				false,
				false,
				Array("QUANTITY")
				);
			if($arItems = $dbBasketItems->Fetch() ) 
				$quantity_basket = $arItems["QUANTITY"];
			else
				$quantity_basket = 0;

			// суммарно (добавляемое и то что в корзине)
			$quantity_add_total = $quantity_add + $quantity_basket;
			
			// выясним количество такого товара на складе	
			$ar_res = CCatalogProduct::GetByID($arFields["PRODUCT_ID"]);
			$quantity_total = $ar_res["QUANTITY"];
			
			// если товара на склдае не хватает для покупки, отмена добавления и возврат на страницу с кодом ошибки в URL
			if($quantity_add_total > $quantity_total) {
				global $APPLICATION;
				LocalRedirect($APPLICATION->GetCurPageParam("error=quantity_limit", array("action", "quantity", "ADD2BASKET", "id"))); 
				}

			// если установлено ограничение на количество товра для покупки (BUY_LIMIT)
			if( defined("BUY_LIMIT")) {
			
				// найдем перечень неоплаченных заказов юзера
				$ordersNotPayed=Array();
				$db_sales = CSaleOrder::GetList(array(), Array(  "USER_ID" => CSaleBasket::GetBasketUserID(), "PAYED" => "N"  ));
				while ($ar_sales = $db_sales->Fetch()) $ordersNotPayed[]=$ar_sales["ID"];
				
				// подсчитаем сколько в них товаров, таких же как и добавляемый сейчас в корзину
				$dbBasketItems = CSaleBasket::GetList( 
					Array(), 
					Array( "FUSER_ID" => CSaleBasket::GetBasketUserID(), "PRODUCT_ID" => $arFields["PRODUCT_ID"], "ORDER_ID" => $ordersNotPayed, "LID" => SITE_ID),
					false,
					false,
					array("QUANTITY")
					);
				$quantity_orders = 0;
				while($arItems = $dbBasketItems->Fetch() ) 
					$quantity_orders = $quantity_orders + $arItems["QUANTITY"];  
					
				// прибавим найденное количество товара из неоплаченных заказов к quantity_add_total и сравним с ограничением BUY_LIMIT
				$quantity_add_total = $quantity_add_total + $quantity_orders;
				
				// если превышает лимит, то отмена и возврат на страницу с кодом ошибки в URL
				if($quantity_add_total > BUY_LIMIT) {
					global $APPLICATION;
					LocalRedirect($APPLICATION->GetCurPageParam("error=buy_limit", array("action", "quantity", "ADD2BASKET", "id"))); 
					}
				}
		*/	
			
			
			
			
			
			
			
			
			
			
			if (isset($_REQUEST['ajax_basket']) && 'Y' == $_REQUEST['ajax_basket'])
			{
				if(!$strError && Add2BasketByProductID($productID, $QUANTITY, $arRewriteFields, $product_properties))
				{
					$arAddResult = array(
						'STATUS' => 'OK',
						'MESSAGE' => ''
					);
				}
				else
				{
					$arAddResult = array(
						'STATUS' => 'ERROR',
						'MESSAGE' => $strError
					);
				}
				$APPLICATION->RestartBuffer();
				echo CUtil::PhpToJSObject($arAddResult);
				die();
			}
			else
			{
				if(!$strError && Add2BasketByProductID($productID, $QUANTITY, $arRewriteFields, $product_properties))
				{
					if ($action == "BUY")
						LocalRedirect($arParams["BASKET_URL"]);
					else
						LocalRedirect($APPLICATION->GetCurPageParam("", array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"])));
				}
				else
				{
					if ($ex = $APPLICATION->GetException())
						$strError = $ex->GetString();
					else
						$strError = GetMessage("CATALOG_ERROR2BASKET").".";
				}
			}
		}
	}
}


$strError = "А вот тут ошибочка вышла";

if(strlen($strError)>0)
{
	ShowError($strError);
	return 0;
}

/*************************************************************************
			Work with cache
*************************************************************************/
if($this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups())))
{
	if (!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return 0;
	}

	$arResultModules = array(
		'iblock' => true,
		'catalog' => false,
		'currency' => false,
		'workflow' => false
	);

	$arConvertParams = array();
	if ('Y' == $arParams['CONVERT_CURRENCY'])
	{
		if (!CModule::IncludeModule('currency'))
		{
			$arParams['CONVERT_CURRENCY'] = 'N';
			$arParams['CURRENCY_ID'] = '';
		}
		else
		{
			$arResultModules['currency'] = true;
			$arCurrencyInfo = CCurrency::GetByID($arParams['CURRENCY_ID']);
			if (!(is_array($arCurrencyInfo) && !empty($arCurrencyInfo)))
			{
				$arParams['CONVERT_CURRENCY'] = 'N';
				$arParams['CURRENCY_ID'] = '';
			}
			else
			{
				$arParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
				$arConvertParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
			}
		}
	}

	//Handle case when ELEMENT_CODE used
	if($arParams["ELEMENT_ID"] <= 0)
		$arParams["ELEMENT_ID"] = CIBlockFindTools::GetElementID(
			$arParams["ELEMENT_ID"],
			$arParams["ELEMENT_CODE"],
			false,
			false,
			array(
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"IBLOCK_LID" => SITE_ID,
				"IBLOCK_ACTIVE" => "Y",
				"ACTIVE_DATE" => "Y",
				"ACTIVE" => "Y",
				"CHECK_PERMISSIONS" => "Y",
			)
		);

	if($arParams["ELEMENT_ID"] > 0)
	{
		$bIBlockCatalog = false;
		$arCatalog = false;
		$bCatalog = CModule::IncludeModule('catalog');
		if ($bCatalog)
		{
			$arResultModules['catalog'] = true;
			$rsCatalogs = CCatalog::GetList(
				array(),
				array('IBLOCK_ID' => $arParams["IBLOCK_ID"]),
				false,
				false,
				array('IBLOCK_ID', 'PRODUCT_IBLOCK_ID', 'SKU_PROPERTY_ID')
			);
			$arCatalog = $rsCatalogs->Fetch();
			if (!empty($arCatalog) && is_array($arCatalog))
				$bIBlockCatalog = true;
		}
		$arResult['CATALOG'] = $arCatalog;

		//This function returns array with prices description and access rights
		//in case catalog module n/a prices get values from element properties
		$arResultPrices = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $arParams["PRICE_CODE"]);

		$WF_SHOW_HISTORY = "N";
		if ($arParams["SHOW_WORKFLOW"] && CModule::IncludeModule("workflow"))
		{
			$arResultModules['workflow'] = true;
			$WF_ELEMENT_ID = CIBlockElement::WF_GetLast($arParams["ELEMENT_ID"]);

			$WF_STATUS_ID = CIBlockElement::WF_GetCurrentStatus($WF_ELEMENT_ID, $WF_STATUS_TITLE);
			$WF_STATUS_PERMISSION = CIBlockElement::WF_GetStatusPermission($WF_STATUS_ID);

			if ($WF_STATUS_ID == 1 || $WF_STATUS_PERMISSION < 1)
				$WF_ELEMENT_ID = $arParams["ELEMENT_ID"];
			else
				$WF_SHOW_HISTORY = "Y";

			$arParams["ELEMENT_ID"] = $WF_ELEMENT_ID;
		}
		//SELECT
		$arSelect = array(
			"ID",
			"IBLOCK_ID",
			"CODE",
			"XML_ID",
			"NAME",
			"ACTIVE",
			"DATE_ACTIVE_FROM",
			"DATE_ACTIVE_TO",
			"SORT",
			"PREVIEW_TEXT",
			"PREVIEW_TEXT_TYPE",
			"DETAIL_TEXT",
			"DETAIL_TEXT_TYPE",
			"DATE_CREATE",
			"CREATED_BY",
			"TIMESTAMP_X",
			"MODIFIED_BY",
			"TAGS",
			"IBLOCK_SECTION_ID",
			"DETAIL_PAGE_URL",
			"LIST_PAGE_URL",
			"DETAIL_PICTURE",
			"PREVIEW_PICTURE",
			"PROPERTY_*",
		);
		if ($bIBlockCatalog)
			$arSelect[] = 'CATALOG_QUANTITY';
		//WHERE
		$arFilter = array(
			"ID" => $arParams["ELEMENT_ID"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_LID" => SITE_ID,
			"IBLOCK_ACTIVE" => "Y",
			"ACTIVE_DATE" => "Y",
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
			"MIN_PERMISSION" => 'R',
			"SHOW_HISTORY" => $WF_SHOW_HISTORY,
		);
		//ORDER BY
		$arSort = array(
		);
		//PRICES
		$arPriceTypeID = array();
		if(!$arParams["USE_PRICE_COUNT"])
		{
			foreach($arResultPrices as &$value)
			{
				if (!$value['CAN_VIEW'] && !$value['CAN_BUY'])
					continue;
				$arSelect[] = $value["SELECT"];
				$arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = $arParams["SHOW_PRICE_COUNT"];
			}
			if (isset($value))
				unset($value);
		}
		else
		{
			foreach ($arResultPrices as &$value)
			{
				if (!$value['CAN_VIEW'] && !$value['CAN_BUY'])
					continue;
				$arPriceTypeID[] = $value["ID"];
			}
			if (isset($value))
				unset($value);
		}

		$arSection = false;
		if($arParams["SECTION_ID"] > 0 || strlen($arParams["SECTION_CODE"]) > 0)
		{
			$arSectionFilter = array(
				"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
				"ACTIVE" => "Y",
			);
			if($arParams["SECTION_ID"] > 0)
				$arSectionFilter["ID"]=$arParams["SECTION_ID"];
			else
			{
				$arSectionFilter["HAS_ELEMENT"] = $arParams["ELEMENT_ID"];
				$arSectionFilter["=CODE"]=$arParams["SECTION_CODE"];
			}

			$rsSection = CIBlockSection::GetList(array(), $arSectionFilter);
			$rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
			$arSection = $rsSection->GetNext();
		}

		$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, false, $arSelect);
		$rsElement->SetUrlTemplates($arParams["DETAIL_URL"]);
		$rsElement->SetSectionContext($arSection);
		if($obElement = $rsElement->GetNextElement())
		{
			$arResult = $obElement->GetFields();

			$arResult['ACTIVE_FROM'] = $arResult['DATE_ACTIVE_FROM'];
			$arResult['ACTIVE_TO'] = $arResult['DATE_ACTIVE_TO'];

			$arResult['CONVERT_CURRENCY'] = $arConvertParams;
			$arResult['MODULES'] = $arResultModules;

			$arResult["CAT_PRICES"] = $arResultPrices;

			$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arResult["IBLOCK_ID"], $arResult["ID"]);
			$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();

			$arResult["PREVIEW_PICTURE"] = (0 < $arResult["PREVIEW_PICTURE"] ? CFile::GetFileArray($arResult["PREVIEW_PICTURE"]) : false);
			if ($arResult["PREVIEW_PICTURE"])
			{
				$arResult["PREVIEW_PICTURE"]["ALT"] = $arResult["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];
				if ($arResult["PREVIEW_PICTURE"]["ALT"] == "")
					$arResult["PREVIEW_PICTURE"]["ALT"] = $arResult["NAME"];
				$arResult["PREVIEW_PICTURE"]["TITLE"] = $arResult["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];
				if ($arResult["PREVIEW_PICTURE"]["TITLE"] == "")
					$arResult["PREVIEW_PICTURE"]["TITLE"] = $arResult["NAME"];
			}
			$arResult["DETAIL_PICTURE"] = (0 < $arResult["DETAIL_PICTURE"] ? CFile::GetFileArray($arResult["DETAIL_PICTURE"]) : false);
			if ($arResult["DETAIL_PICTURE"])
			{
				$arResult["DETAIL_PICTURE"]["ALT"] = $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"];
				if ($arResult["DETAIL_PICTURE"]["ALT"] == "")
					$arResult["DETAIL_PICTURE"]["ALT"] = $arResult["NAME"];
				$arResult["DETAIL_PICTURE"]["TITLE"] = $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"];
				if ($arResult["DETAIL_PICTURE"]["TITLE"] == "")
					$arResult["DETAIL_PICTURE"]["TITLE"] = $arResult["NAME"];
			}

			$arResult["PROPERTIES"] = $obElement->GetProperties();

			$arResult["DISPLAY_PROPERTIES"] = array();
			foreach($arParams["PROPERTY_CODE"] as $pid)
			{
				if (!isset($arResult["PROPERTIES"][$pid]))
					continue;
				$prop = &$arResult["PROPERTIES"][$pid];
				$boolArr = is_array($prop["VALUE"]);
				if(
					($boolArr && !empty($prop["VALUE"]))
					|| (!$boolArr && strlen($prop["VALUE"])>0)
				)
				{
					$arResult["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arResult, $prop, "catalog_out");
				}
			}

			$arResult["PRODUCT_PROPERTIES"] = array();
			if (!empty($arParams["PRODUCT_PROPERTIES"]))
			{
				$arResult["PRODUCT_PROPERTIES"] = CIBlockPriceTools::GetProductProperties(
					$arParams["IBLOCK_ID"],
					$arResult["ID"],
					$arParams["PRODUCT_PROPERTIES"],
					$arResult["PROPERTIES"]
				);
			}

			$arResult["MORE_PHOTO"] = array();
			if(isset($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) && is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"]))
			{
				foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $FILE)
				{
					$FILE = CFile::GetFileArray($FILE);
					if(is_array($FILE))
						$arResult["MORE_PHOTO"][]=$FILE;
				}
			}

			$arResult["LINKED_ELEMENTS"] = array();
			if(strlen($arParams["LINK_PROPERTY_SID"])>0 && strlen($arParams["LINK_IBLOCK_TYPE"])>0 && $arParams["LINK_IBLOCK_ID"]>0)
			{
				$rsLinkElements = CIBlockElement::GetList(
					array("SORT" => "ASC"),
					array(
						"IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
						"IBLOCK_ACTIVE" => "Y",
						"ACTIVE_DATE" => "Y",
						"ACTIVE" => "Y",
						"CHECK_PERMISSIONS" => "Y",
						"IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
						"PROPERTY_".$arParams["LINK_PROPERTY_SID"] => $arResult["ID"],
					),
					false,
					false,
					Array("ID","IBLOCK_ID","NAME","DETAIL_PAGE_URL","IBLOCK_NAME")
				);
				while($ar = $rsLinkElements->GetNext())
					$arResult["LINKED_ELEMENTS"][]=$ar;
			}

			if(!$arSection && $arResult["IBLOCK_SECTION_ID"] > 0)
			{
				$arSectionFilter = array(
					"ID" => $arResult["IBLOCK_SECTION_ID"],
					"IBLOCK_ID" => $arResult["IBLOCK_ID"],
					"ACTIVE" => "Y",
				);
				$rsSection = CIBlockSection::GetList(Array(),$arSectionFilter);
				$rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
				$arSection = $rsSection->GetNext();
			}

			if($arSection)
			{
				$arSection["PATH"] = array();
				$rsPath = CIBlockSection::GetNavChain($arResult["IBLOCK_ID"], $arSection["ID"]);
				$rsPath->SetUrlTemplates("", $arParams["SECTION_URL"]);
				while($arPath=$rsPath->GetNext())
				{
					$arSection["PATH"][] = $arPath;
				}
				$arResult["SECTION"] = $arSection;
			}

			if (!isset($arResult["CATALOG_MEASURE_RATIO"]))
				$arResult["CATALOG_MEASURE_RATIO"] = 1;
			if (!isset($arResult['CATALOG_MEASURE']))
				$arResult['CATALOG_MEASURE'] = 0;
			$arResult['CATALOG_MEASURE'] = intval($arResult['CATALOG_MEASURE']);
			if (0 > $arResult['CATALOG_MEASURE'])
				$arResult['CATALOG_MEASURE'] = 0;
			if (!isset($arResult['CATALOG_MEASURE_NAME']))
				$arResult['CATALOG_MEASURE_NAME'] = '';
			if ($bCatalog && $bIBlockCatalog)
			{
				$rsRatios = CCatalogMeasureRatio::getList(
					array(),
					array('PRODUCT_ID' => $arResult['ID']),
					false,
					false,
					array('PRODUCT_ID', 'RATIO')
				);
				if ($arRatio = $rsRatios->Fetch())
				{
					$intRatio = intval($arRatio['RATIO']);
					$dblRatio = doubleval($arRatio['RATIO']);
					$mxRatio = ($dblRatio > $intRatio ? $dblRatio : $intRatio);
					if (CATALOG_VALUE_EPSILON > abs($mxRatio))
						$mxRatio = 1;
					elseif (0 > $mxRatio)
						$mxRatio = 1;
					$arResult["CATALOG_MEASURE_RATIO"] = $mxRatio;
				}
				if (0 < $arResult['CATALOG_MEASURE'])
				{
					$rsMeasures = CCatalogMeasure::getList(
						array(),
						array('ID' => $arResult['CATALOG_MEASURE']),
						false,
						false,
						array()
					);
					if ($arMeasure = $rsMeasures->GetNext())
					{
						$arResult['CATALOG_MEASURE_NAME'] = $arMeasure['SYMBOL_RUS'];
						$arResult['~CATALOG_MEASURE_NAME'] = $arMeasure['~SYMBOL_RUS'];
					}
				}
				if ('' == $arResult['CATALOG_MEASURE_NAME'])
				{
					$arDefaultMeasure = CIBlockPriceTools::GetDefaultMeasure();
					$arResult['CATALOG_MEASURE_NAME'] = $arDefaultMeasure['SYMBOL_RUS'];
					$arResult['~CATALOG_MEASURE_NAME'] = $arDefaultMeasure['~SYMBOL_RUS'];
				}
			}
			$arResult["PRICE_MATRIX"] = false;
			$arResult["PRICES"] = array();
			$arResult['MIN_PRICE'] = false;
			if($arParams["USE_PRICE_COUNT"])
			{
				if($bCatalog)
				{
					$arResult["PRICE_MATRIX"] = CatalogGetPriceTableEx($arResult["ID"], 0, $arPriceTypeID, 'Y', $arConvertParams);
					foreach($arResult["PRICE_MATRIX"]["COLS"] as $keyColumn=>$arColumn)
						$arResult["PRICE_MATRIX"]["COLS"][$keyColumn]["NAME_LANG"] = htmlspecialcharsbx($arColumn["NAME_LANG"]);
				}
			}
			else
			{
				$arResult["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["CAT_PRICES"], $arResult, $arParams['PRICE_VAT_INCLUDE'], $arConvertParams);
				if (!empty($arResult["PRICES"]))
				{
					foreach ($arResult['PRICES'] as &$arOnePrice)
					{
						if ('Y' == $arOnePrice['MIN_PRICE'])
						{
							$arResult['MIN_PRICE'] = $arOnePrice;
							break;
						}
					}
					unset($arOnePrice);
				}
			}

			$arResult["CAN_BUY"] = CIBlockPriceTools::CanBuy($arParams["IBLOCK_ID"], $arResult["CAT_PRICES"], $arResult);

			$arResult["~BUY_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=BUY&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arResult["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
			$arResult["BUY_URL"] = htmlspecialcharsbx($arResult["~BUY_URL"]);
			$arResult["~ADD_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=ADD2BASKET&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arResult["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
			$arResult["ADD_URL"] = htmlspecialcharsbx($arResult["~ADD_URL"]);
			$arResult["LINK_URL"] = str_replace(
						array("#ELEMENT_ID#","#SECTION_ID#"),
						array($arResult["ID"],$arResult["SECTION"]["ID"]),
						$arParams["LINK_ELEMENTS_URL"]
					);
			$arResult["~SUBSCRIBE_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=SUBSCRIBE_PRODUCT&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arResult["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
			$arResult["SUBSCRIBE_URL"] = htmlspecialcharsbx($arResult["~SUBSCRIBE_URL"]);

			if(!isset($arParams["OFFERS_FIELD_CODE"]))
				$arParams["OFFERS_FIELD_CODE"] = array();
			elseif (!is_array($arParams["OFFERS_FIELD_CODE"]))
				$arParams["OFFERS_FIELD_CODE"] = array($arParams["OFFERS_FIELD_CODE"]);
			foreach($arParams["OFFERS_FIELD_CODE"] as $key => $value)
				if($value === "")
					unset($arParams["OFFERS_FIELD_CODE"][$key]);

			if(!isset($arParams["OFFERS_PROPERTY_CODE"]))
				$arParams["OFFERS_PROPERTY_CODE"] = array();
			elseif (!is_array($arParams["OFFERS_PROPERTY_CODE"]))
				$arParams["OFFERS_PROPERTY_CODE"] = array($arParams["OFFERS_PROPERTY_CODE"]);
			if (!in_array('PREVIEW_PICTURE', $arParams["OFFERS_PROPERTY_CODE"]))
				$arParams["OFFERS_PROPERTY_CODE"][] = 'PREVIEW_PICTURE';
			if (!in_array('DETAIL_PICTURE', $arParams["OFFERS_PROPERTY_CODE"]))
				$arParams["OFFERS_PROPERTY_CODE"][] = 'DETAIL_PICTURE';
			foreach($arParams["OFFERS_PROPERTY_CODE"] as $key => $value)
				if($value === "")
					unset($arParams["OFFERS_PROPERTY_CODE"][$key]);

			$arResult["OFFERS"] = array();
			if(
				$bCatalog
				&& (
					!empty($arParams["OFFERS_FIELD_CODE"])
					|| !empty($arParams["OFFERS_PROPERTY_CODE"])
				)
			)
			{
				$arOffers = CIBlockPriceTools::GetOffersArray(
					array(
						'IBLOCK_ID' => $arParams["IBLOCK_ID"],
						'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
					)
					,array($arResult["ID"])
					,array(
						$arParams["OFFERS_SORT_FIELD"] => $arParams["OFFERS_SORT_ORDER"],
						$arParams["OFFERS_SORT_FIELD2"] => $arParams["OFFERS_SORT_ORDER2"],
					)
					,$arParams["OFFERS_FIELD_CODE"]
					,$arParams["OFFERS_PROPERTY_CODE"]
					,$arParams["OFFERS_LIMIT"]
					,$arResult["CAT_PRICES"]
					,$arParams['PRICE_VAT_INCLUDE']
					,$arConvertParams
				);
				foreach($arOffers as $arOffer)
				{
					$arOffer["~BUY_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=BUY&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["BUY_URL"] = htmlspecialcharsbx($arOffer["~BUY_URL"]);
					$arOffer["~ADD_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=ADD2BASKET&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["ADD_URL"] = htmlspecialcharsbx($arOffer["~ADD_URL"]);
					$arOffer["~COMPARE_URL"] = $APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["COMPARE_URL"] = htmlspecialcharsbx($arOffer["~COMPARE_URL"]);
					$arOffer["~SUBSCRIBE_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=SUBSCRIBE_PRODUCT&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["SUBSCRIBE_URL"] = htmlspecialcharsbx($arOffer["~SUBSCRIBE_URL"]);

					$arResult["OFFERS"][] = $arOffer;
				}
			}

			if ('Y' == $arParams['CONVERT_CURRENCY'])
			{
				$arCurrencyList = array();
				if ($arParams["USE_PRICE_COUNT"])
				{
					if (!empty($arResult["PRICE_MATRIX"]) && is_array($arResult["PRICE_MATRIX"]))
					{
						if (isset($arResult["PRICE_MATRIX"]['CURRENCY_LIST']) && is_array($arResult["PRICE_MATRIX"]['CURRENCY_LIST']))
							$arCurrencyList = $arResult["PRICE_MATRIX"]['CURRENCY_LIST'];
					}
				}
				else
				{
					if (!empty($arResult["PRICES"]))
					{
						foreach ($arResult["PRICES"] as &$arOnePrices)
						{
							if (isset($arOnePrices['ORIG_CURRENCY']))
								$arCurrencyList[] = $arOnePrices['ORIG_CURRENCY'];
						}
						if (isset($arOnePrices))
							unset($arOnePrices);
					}
				}
				if (!empty($arResult["OFFERS"]))
				{
					foreach ($arResult["OFFERS"] as &$arOneOffer)
					{
						if (!empty($arOneOffer['PRICES']))
						{
							foreach ($arOneOffer['PRICES'] as &$arOnePrices)
							{
								if (isset($arOnePrices['ORIG_CURRENCY']))
									$arCurrencyList[] = $arOnePrices['ORIG_CURRENCY'];
							}
							if (isset($arOnePrices))
								unset($arOnePrices);
						}
					}
					if (isset($arOneOffer))
						unset($arOneOffer);
				}
				if (!empty($arCurrencyList) && defined("BX_COMP_MANAGED_CACHE"))
				{
					$arCurrencyList[] = $arConvertParams['CURRENCY_ID'];
					$arCurrencyList = array_unique($arCurrencyList);
					$CACHE_MANAGER->StartTagCache($this->GetCachePath());
					foreach ($arCurrencyList as &$strOneCurrency)
					{
						$CACHE_MANAGER->RegisterTag("currency_id_".$strOneCurrency);
					}
					if (isset($strOneCurrency))
						unset($strOneCurrency);
					$CACHE_MANAGER->EndTagCache();
				}
			}

			$this->SetResultCacheKeys(array(
				"IBLOCK_ID",
				"ID",
				"IBLOCK_SECTION_ID",
				"NAME",
				"LIST_PAGE_URL",
				"PROPERTIES",
				"SECTION",
				"IPROPERTY_VALUES",
			));

			$this->IncludeComponentTemplate();

			if ($bCatalog && method_exists('CCatalogDiscount', 'ClearDiscountCache'))
			{
				CCatalogDiscount::ClearDiscountCache(array(
					'PRODUCT' => true,
					'SECTIONS' => true,
					'PROPERTIES' => true
				));
			}
		}
		else
		{
			$this->AbortResultCache();
			ShowError(GetMessage("CATALOG_ELEMENT_NOT_FOUND"));
			@define("ERROR_404", "Y");
			if($arParams["SET_STATUS_404"]==="Y")
				CHTTP::SetStatus("404 Not Found");
		}
	}
	else
	{
		$this->AbortResultCache();
		ShowError(GetMessage("CATALOG_ELEMENT_NOT_FOUND"));
		@define("ERROR_404", "Y");
		if($arParams["SET_STATUS_404"]==="Y")
			CHTTP::SetStatus("404 Not Found");
	}
}

if(isset($arResult["ID"]))
{
	if ('N' != $arParams['USE_ELEMENT_COUNTER'])
	{
		if (CModule::IncludeModule('iblock'))
		{
			CIBlockElement::CounterInc($arResult["ID"]);
		}
	}

	if (CModule::IncludeModule('sale'))
	{
		if (!isset($_SESSION["VIEWED_ENABLE"]) && isset($_SESSION["VIEWED_PRODUCT"]) && $_SESSION["VIEWED_PRODUCT"] != $arResult["ID"])
		{
			$_SESSION["VIEWED_ENABLE"] = "Y";
			$arFields = array(
				"PRODUCT_ID" => IntVal($_SESSION["VIEWED_PRODUCT"]),
				"MODULE" => "catalog",
				"LID" => SITE_ID,
			);
			CSaleViewedProduct::Add($arFields);
		}

		if (isset($_SESSION["VIEWED_ENABLE"]) && $_SESSION["VIEWED_ENABLE"] == "Y" && $_SESSION["VIEWED_PRODUCT"] != $arResult["ID"])
		{
			$arFields = array(
				"PRODUCT_ID" => $arResult["ID"],
				"MODULE" => "catalog",
				"LID" => SITE_ID,
				"IBLOCK_ID" => $arResult["IBLOCK_ID"]
			);
			CSaleViewedProduct::Add($arFields);
		}

		$_SESSION["VIEWED_PRODUCT"] = $arResult["ID"];
	}

	$arTitleOptions = null;
	if($USER->IsAuthorized())
	{
		if(
			$APPLICATION->GetShowIncludeAreas()
			|| $arParams["SET_TITLE"]
			|| isset($arResult[$arParams["BROWSER_TITLE"]])
		)
		{
			if (CModule::IncludeModule('iblock'))
			{
				$arReturnUrl = array(
					"add_element" => CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "DETAIL_PAGE_URL"),
					"delete_element" => (
						isset($arResult["SECTION"])?
						$arResult["SECTION"]["SECTION_PAGE_URL"]:
						$arResult["LIST_PAGE_URL"]
					),
				);
				$arButtons = CIBlock::GetPanelButtons($arResult["IBLOCK_ID"], $arResult["ID"], $arResult["IBLOCK_SECTION_ID"], Array("RETURN_URL" =>  $arReturnUrl, "CATALOG"=>true));

				if($APPLICATION->GetShowIncludeAreas())
					$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

				if($arParams["SET_TITLE"] || isset($arResult[$arParams["BROWSER_TITLE"]]))
				{
					$arTitleOptions = array(
						'ADMIN_EDIT_LINK' => $arButtons["submenu"]["edit_element"]["ACTION"],
						'PUBLIC_EDIT_LINK' => $arButtons["edit"]["edit_element"]["ACTION"],
						'COMPONENT_NAME' => $this->GetName(),
					);
				}
			}
		}
	}

	if($arParams["SET_TITLE"])
	{
		if ($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != "")
			$APPLICATION->SetTitle($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"], $arTitleOptions);
		else
			$APPLICATION->SetTitle($arResult["NAME"], $arTitleOptions);
	}

	$browserTitle = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["BROWSER_TITLE"], "VALUE")
		,$arResult, $arParams["BROWSER_TITLE"]
		,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_TITLE"
	);
	if (is_array($browserTitle))
		$APPLICATION->SetPageProperty("title", implode(" ", $browserTitle), $arTitleOptions);
	elseif ($browserTitle != "")
		$APPLICATION->SetPageProperty("title", $browserTitle, $arTitleOptions);

	$metaKeywords = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["META_KEYWORDS"], "VALUE")
		,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_KEYWORDS"
	);
	if (is_array($metaKeywords))
		$APPLICATION->SetPageProperty("keywords", implode(" ", $metaKeywords), $arTitleOptions);
	elseif ($metaKeywords != "")
		$APPLICATION->SetPageProperty("keywords", $metaKeywords, $arTitleOptions);

	$metaDescription = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult["PROPERTIES"], array($arParams["META_DESCRIPTION"], "VALUE")
		,$arResult["IPROPERTY_VALUES"], "ELEMENT_META_DESCRIPTION"
	);
	if (is_array($metaDescription))
		$APPLICATION->SetPageProperty("description", implode(" ", $metaDescription), $arTitleOptions);
	elseif ($metaDescription != "")
		$APPLICATION->SetPageProperty("description", $metaDescription, $arTitleOptions);

	if($arParams["ADD_SECTIONS_CHAIN"] && is_array($arResult["SECTION"]))
	{
		foreach($arResult["SECTION"]["PATH"] as $arPath)
		{
			$APPLICATION->AddChainItem($arPath["NAME"], $arPath["~SECTION_PAGE_URL"]);
		}
	}
	return $arResult["ID"];
}
else
{
	return 0;
}
?>