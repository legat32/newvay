<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// получаем значения переменных из куки или ставим дефолтные
$sort = $APPLICATION->get_cookie('sort') ? $APPLICATION->get_cookie("sort") : "artikul_asc";
$count = $APPLICATION->get_cookie('count') ? $APPLICATION->get_cookie("count") : "15"; 

// устанавливаем куки и присваиваем значение соответствующим переменным, если таковые есть в REQUEST
if(isset($_REQUEST["sort"])) {
	$APPLICATION->set_cookie("sort", strVal($_REQUEST["sort"]), 60); 
	$sort = strVal($_REQUEST["sort"]);
	}
if(isset($_REQUEST["count"])) {
	$APPLICATION->set_cookie("count", strVal($_REQUEST["count"]), 60); 
	$count = strVal($_REQUEST["count"]);
	}

// разобьем переменную sort на две element_sort_field и element_sort_order, и заодно исправим (price -> catalog_PRICE_1)
$ar_sort=explode("_", $sort);
$element_sort_field = $ar_sort[0];
if($ar_sort[0] == "artikul") $element_sort_field = "PROPERTY_CML2_ARTICLE";
if($ar_sort[0] == "price") {
	if(defined("DEALER_USER")) $element_sort_field = "PROPERTY_DEALER_PRICE_MIN";
	else $element_sort_field = "PROPERTY_RETAIL_PRICE_MIN";
	}
$element_sort_order = $ar_sort[1]; 

// вывод переменных для проверки	
/*echo "sort=".$sort."<br/>";
echo "element_sort_field=".$element_sort_field."<br/>";
echo "element_sort_order=".$element_sort_order."<br/>";
echo "count=".$count."<br/><hr/>";
*/


// вывод панели переключалок (с выделением жирным активных значений)
?>

<!--noindex-->
<!--
<table class="selectors" width="100%" cellpadding="3" cellspacing="0" border="0" style="margin-top:10px;">
<tr>
	<td align="left">
		Сортировка: &nbsp;&nbsp;по цене <a class="price_desc<?if($sort=="price_desc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=price_desc", Array("view", "sort", "count"))?>" rel="nofollow" title="по убыванию"></a> <a class="price_asc<?if($sort=="price_asc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=price_asc", Array("view", "sort", "count"))?>" rel="nofollow" title="по убыванию"></a> 
		&nbsp;&nbsp;&nbsp;по артикулу: <a class="artikul_desc<?if($sort=="artikul_desc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=artikul_desc", Array("view", "sort", "count"))?>" rel="nofollow" title="по возрастанию"></a> <a class="artikul_asc<?if($sort=="artikul_asc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=artikul_asc", Array("view", "sort", "count"))?>" rel="nofollow" title="по возрастанию"></a>
	</td>
	<td align="right">
		Кол-во товаров на странице: 
		<a class="prod_show_number<?if($count=="15"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=15", Array("view", "sort", "count"))?>" rel="nofollow">15</a>
		<a class="prod_show_number<?if($count=="30"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=30", Array("view", "sort", "count"))?>" rel="nofollow">30</a>
		<a class="prod_show_number<?if($count=="45"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=45", Array("view", "sort", "count"))?>" rel="nofollow">45</a>
		<a class="prod_show_number<?if($count=="all"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=all", Array("view", "sort", "count"))?>" rel="nofollow">все</a>
		&nbsp;&nbsp;&nbsp;
		<span id="items_count"></span>
	</td>
</tr>
</table>
-->
<!--/noindex-->


<h1><?=$APPLICATION->ShowTitle(false)?></h1>







<?
/*
if($arParams["USE_COMPARE"]=="Y"):
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.compare.list",
		"eshop",
		Array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"NAME" => $arParams["COMPARE_NAME"],
			"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
			"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		),
		$component
	);
endif;
*/
?>







<?
/*
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
		"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);
*/?>









<?
//$current_view = COption::GetOptionString("eshop", "catalogView", "list", SITE_ID);
?>



<?
//$arrFilter = Array("!PROPERTY_RASPRODAZHA" => false);
//$$arrFilter = Array("IBLOCK_ID" => 11);


?>


<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"board",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $element_sort_field,
		"ELEMENT_SORT_ORDER" => $element_sort_order,//$arParams["ELEMENT_SORT_ORDER"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $count=="all" ? 100000 : $count,
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

		"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
		"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
		"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
		"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
		"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
		"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],

		"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
		"COMPARE_NAME" => $arParams["COMPARE_NAME"],
		"DISPLAY_IMG_WIDTH"	 =>	$arParams["DISPLAY_IMG_WIDTH"],
		"DISPLAY_IMG_HEIGHT" =>	$arParams["DISPLAY_IMG_HEIGHT"],

		"SHARPEN" => $arParams["SHARPEN"],
	),
	$component
);

//$APPLICATION->SetTitle($GLOBALS["title"]);


?>