<?
$GLOBALS["arrFilterMainPage"] = Array("IBLOCK_ID" => 6, "ACTIVE" => "Y"/*, "PROPERTY_MAINPAGE" => "Y"*/ , ">PROPERTY_V_SLAYD_SHOU_PORYADOK_SLEDOVANIYA" => 0);
?>

<?/*if($USER->isAdmin()):*/?>
<?/*?>
<div style="padding:10px; background: url(/upload/bgmess.jpg); margin: 20px 0 0 0; border-top: 5px solid rgb(71, 71, 71);   outline: 5px solid rgb(237, 137, 49) !important;">
	<p style="color:red; font-size:16px;  letter-spacing: 0; font-family: Arial; margin:0; padding:0;"><b>Уважаемые клиенты, с 1 по 4 мая, а также с 9 по 11 мая наш офис не работает:</b><br/>
	<ul>
		<li><span style="color:red; font-size:16px;  letter-spacing: 0; font-family: Arial; margin:0; padding:0;"><b>- разместить заказ на сайте можно 24 часа в сутки каждый день</b></span></li>
		<li><span style="color:red; font-size:16px;  letter-spacing: 0; font-family: Arial; margin:0; padding:0;"><b>- заказы, оформленные 1-4 мая, будут обработаны 5 мая, оформленные 9-11 мая - будут обработаны 12 мая</b></span></li>
	</ul>
	</p>
	<p style="color:red; font-size:16px;  letter-spacing: 0; font-family: Arial; margin:0; padding:0;"><b>В майские праздники вы можете посетить наш розничный магазин расположенный по адресу:<br/>- г. Москва, Измайловское шоссе, 71А. ТК «АСТ», график работы: 1-12 мая с 10:00 до 22:00 [<a href="/magazin/">ссылка</a>]</b></p>
</div>
<?*/?>
<?/*endif*/?> 
 




<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slides", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "16",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "LINK",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "slides",
		"AJAX_OPTION_ADDITIONAL" => "undefined",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>





<?
$APPLICATION->IncludeComponent("bitrix:catalog.section", "main_page_simple", array(
	"IBLOCK_TYPE" => "1c_catalog",
	"IBLOCK_ID" => "6",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "PROPERTY_V_SLAYD_SHOU_PORYADOK_SLEDOVANIYA",
	"ELEMENT_SORT_ORDER" => "asc",
	"ELEMENT_SORT_FIELD2" => "id",
	"ELEMENT_SORT_ORDER2" => "desc",
	"FILTER_NAME" => "arrFilterMainPage",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"HIDE_NOT_AVAILABLE" => "N",
	"PAGE_ELEMENT_COUNT" => "100",
	"LINE_ELEMENT_COUNT" => "100",
	"PROPERTY_CODE" => array(
		0 => "RASPRODAZHA",
		1 => "V_SLAYD_SHOU_PORYADOK_SLEDOVANIYA",
		2 => "COLLECTION",
		3 => "DEALER_PRICE_MIN",
		4 => "RETAIL_PRICE_MIN",
		5 => "",
	),
	"OFFERS_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"OFFERS_PROPERTY_CODE" => array(
		0 => "CML2_ARTICLE",
		1 => "",
	),
	"OFFERS_SORT_FIELD" => "sort",
	"OFFERS_SORT_ORDER" => "asc",
	"OFFERS_SORT_FIELD2" => "id",
	"OFFERS_SORT_ORDER2" => "desc",
	"OFFERS_LIMIT" => "1",
	"SECTION_URL" => "/#SECTION_CODE_PATH#/",
	"DETAIL_URL" => "/#SECTION_CODE_PATH#/#ELEMENT_CODE#.html",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "N",
	"SET_META_KEYWORDS" => "Y",
	"META_KEYWORDS" => "-",
	"SET_META_DESCRIPTION" => "Y",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "для Физ.лиц",
		1 => "Оптовые",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"CONVERT_CURRENCY" => "N",
	"OFFERS_CART_PROPERTIES" => array(
	),
	"PAGER_TEMPLATE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>