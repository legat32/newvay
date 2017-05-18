<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// получаем значения переменных из куки или ставим дефолтные
$sort = $APPLICATION->get_cookie('sort') ? $APPLICATION->get_cookie("sort") : "artikul_desc";
$count = $APPLICATION->get_cookie('count') ? $APPLICATION->get_cookie("count") : "32"; 

// устанавливаем куки и присваиваем значение соответствующим переменным, если таковые есть в REQUEST
if(isset($_REQUEST["sort"])) {
	$APPLICATION->set_cookie("sort", strVal($_REQUEST["sort"]), 60); 
	$sort = strVal($_REQUEST["sort"]);
	}
if(isset($_REQUEST["count"])) {
	$APPLICATION->set_cookie("count", strVal($_REQUEST["count"]), 32); 
	$count = strVal($_REQUEST["count"]);
	}

// разобьем переменную sort на две element_sort_field и element_sort_order, и заодно исправим (price -> catalog_PRICE_1)
$ar_sort=explode("_", $sort);
$element_sort_field = $ar_sort[0];
if($ar_sort[0] == "artikul") $element_sort_field = "PROPERTY_CML2_ARTICLE";
if($ar_sort[0] == "price") {
	/*if(defined("DEALER_USER")) */$element_sort_field = "PROPERTY_DEALER_PRICE_MIN";
	/*else $element_sort_field = "PROPERTY_RETAIL_PRICE_MIN";*/
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
 <?

//prn($arResult);

if (CModule::IncludeModule("iblock") && COption::GetOptionString("eshop", "catalogSmartFilter", "Y", SITE_ID)=="Y")
{
	$arFilter = array(
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	);
	//if(strlen($arResult["VARIABLES"]["SECTION_CODE"])>0)
	//{
	//	$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
	//}
	//elseif($arResult["VARIABLES"]["SECTION_ID"]>0)
	//{
	$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	//}
		
	$obCache = new CPHPCache;
	if($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	else
	{
		$arCurSection = array();
		$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
		$dbRes = new CIBlockResult($dbRes);

		if(defined("BX_COMP_MANAGED_CACHE"))
		{
			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache("/iblock/catalog");

			if ($arCurSection = $dbRes->GetNext())
			{
				$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
			}
			$CACHE_MANAGER->EndTagCache();
		}
		else
		{
			if(!$arCurSection = $dbRes->GetNext())
				$arCurSection = array();
		}

		$obCache->EndDataCache($arCurSection);
	}
	?>
<!--noindex-->

<div  class="section-info">
		<div class="items_count at-top">ТОВАРОВ: <span><?=CIBlockSection::GetSectionElementsCount($arResult[VARIABLES][SECTION_ID], Array("CNT_ACTIVE"=>"Y"));?></span></div>
		<div class="subsections">
	<?
		$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"structure",
		Array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arCurSection["ID"],
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "3",
		"SECTION_FIELDS" => array(0=>"",1=>"",),
		"SECTION_USER_FIELDS" => array(0=>"UF_COLLECTION_COLOR",1=>"",),
		"SECTION_URL" => "/#SECTION_CODE_PATH#/",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "1800",
		"CACHE_GROUPS" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y"
	)
);?>
		</div>

</div>
<div class="sort-wrap">
<div class="catalog-sort">
	<span class="title">СОРТИРОВАТЬ:</span>
	<div class="sort-price">
	<span class="sort-label">по цене</span>
	<span class="sort-value">
		<a class="price_desc<?if($sort=="price_desc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=price_desc", Array("view", "sort", "count"))?>" rel="nofollow" title="по убыванию">
		</a>
		 <a class="price_asc<?if($sort=="price_asc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=price_asc", Array("view", "sort", "count"))?>" rel="nofollow" title="по возрастанию">
		</a> 
	</span>
	</div>
	<div class="sort-article">
	<span class="sort-label">по артикулу</span>
	<span class="sort-value">
		<a class="artikul_desc<?if($sort=="artikul_desc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=artikul_desc", Array("view", "sort", "count"))?>" rel="nofollow" title="по убыванию"></a> 
		<a class="artikul_asc<?if($sort=="artikul_asc"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("sort=artikul_asc", Array("view", "sort", "count"))?>" rel="nofollow" title="по возрастанию"></a>
	</span>
		
	</div>
</div>
<div class="catalog-show">
<span class="title">ПОКАЗЫВАТЬ:</span>
<span class="show-value">
	<a class="prod_show_number<?if($count=="32"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=32", Array("view", "sort", "count"))?>" rel="nofollow">32</a>
	<a class="prod_show_number<?if($count=="60"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=60", Array("view", "sort", "count"))?>" rel="nofollow">60</a>
</span>
</div>
</div>


<!--/noindex-->

			<?
			$APPLICATION->IncludeComponent(
			"bitrix:catalog.smart.filter", 
			//"femina_horizontal", 
			//"visual_horizontal",
			"visual_horizontal_new",
			array(
				"IBLOCK_TYPE" => "1c_catalog",
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arCurSection["ID"],
				"FILTER_NAME" => "arrFilter",
				"HIDE_NOT_AVAILABLE" => "N",
				"CACHE_TYPE" => "Y",
				"CACHE_TIME" => "600",
				"CACHE_GROUPS" => "Y",
				"SAVE_IN_SESSION" => "N",
				"INSTANT_RELOAD" => "N",
				"PRICE_CODE" => array(
				),
				"XML_EXPORT" => "N",
				"SECTION_TITLE" => "-",
				"SECTION_DESCRIPTION" => "-"
				),
				false
			);
			?>
<?
} 

?>


<?
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
?>
<?
/*
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arCurSection["ID"],
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
//pra($element_sort_field);
//pra($element_sort_order);
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	//"board",
	"blocks",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => "SORT",
		"ELEMENT_SORT_ORDER" => "DESC",//$arParams["ELEMENT_SORT_ORDER"],
		"ELEMENT_SORT_FIELD2" => $element_sort_field,
		"ELEMENT_SORT_ORDER2" => $element_sort_order,
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
		"PAGE_ELEMENT_COUNT" => $count == 32 ? 32 : 60,
		//"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
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