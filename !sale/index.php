<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Товары по акции");
//LocalRedirect("/");
?><br>
 <?/*?>
<p align="left" style="padding-bottom:10px;"><i><b>
<img title="Сезонная акция!" src="/upload/june2016.jpg" width="760"><br/>
* Цены на товары, участвующие в акции, указаны уже с учетом скидки -20%</b></i></p>
<?*/?> <?
$GLOBALS["AFILTER"] = Array("PROPERTY_AKCIYA_ON_SITE" => "Y");


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
?>







<div class="<?=($isSidebar ? "col-md-9 col-sm-8" : "col-xs-12")?>">
	<div class="row">
	
		<div class="col-xs-12">
		
			<div  class="section-info">
				<div class="items_count">ТОВАРОВ: <span><?=CIBlockSection::GetSectionElementsCount($arResult[VARIABLES][SECTION_ID], Array("CNT_ACTIVE"=>"Y"));?></span>
				</div>
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
	
			
		</div>
	</div>
</div>












<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"board55",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "-",
		"BASKET_URL" => "/personal/basket.php",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "board55",
		"CONVERT_CURRENCY" => "N",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "AFILTER",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "6",
		"IBLOCK_TYPE" => "1c_catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "NOVIZNA",
		"LINE_ELEMENT_COUNT" => "4",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => array(0=>"CML2_ARTICLE",1=>"SIZE_LIST",2=>"COLOR_LIST",),
		"OFFERS_FIELD_CODE" => array(0=>"NAME",1=>"DETAIL_PICTURE",2=>"",),
		"OFFERS_LIMIT" => "0",
		"OFFERS_PROPERTY_CODE" => array(0=>"MORE_PHOTO",1=>"SIZE_LIST",2=>"COLOR_LIST",3=>"",),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(0=>"COLOR_LIST",1=>"SIZE_LIST",),
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "modern",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "20",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(0=>"для Физ.лиц",1=>"Оптовые",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPERTIES" => array(),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_SUBSCRIPTION" => "N",
		"PROPERTY_CODE" => array(0=>"AKCIYA_ON_SITE",1=>"CML2_ARTICLE",2=>"NOVIZNA",3=>"MORE_PHOTO",4=>"",),
		"SECTION_CODE" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
		"SEF_MODE" => "N",
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "Y",
		"SHOW_CLOSE_POPUP" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"TEMPLATE_THEME" => "blue",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y"
	)
);?> <br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>