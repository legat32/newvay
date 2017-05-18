<?$APPLICATION->IncludeComponent("bitrix:menu", "template1", Array(
	"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
	"MENU_CACHE_TYPE" => "N",	// Тип кеширования
	"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
	"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
	"MAX_LEVEL" => "3",	// Уровень вложенности меню
	"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
	"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	"DELAY" => "N",	// Откладывать выполнение шаблона меню
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
	),
	false
);?>

<div class="sideblock" id="usl_pokupki">
	<div class="sideblock_title_grey">Условия покупки</div>
	<ul>
		<li><a href="/shop/pokupka.html">Как сделать покупку</a></li>
		<li><a href="/shop/dostavka.html">Условия доставки</a></li>
		<li><a href="/shop/oplata.html">Условия оплаты</a></li>
		<li><a href="/shop/vozvrat.html">Возврат товара</a></li>
	</ul>
</div>

<div class="sideblock" id="articles">
	<div class="sideblock_title_grey">Статьи</div>


<?
if(($_SERVER["SCRIPT_NAME"]=="/shop/index.php")&&(intVal($_REQUEST["SECTION_ID"])>0))
	$GLOBALS["arrFilterArticles"] = Array("IBLOCK_ID" => 9, "PROPERTY_LINK" => intVal($_REQUEST["SECTION_ID"]));
else 
	$GLOBALS["arrFilterArticles"] = Array("IBLOCK_ID" => 9, "PROPERTY_LINK" => false);
?>

	
<?
$APPLICATION->IncludeComponent("bitrix:news.list", "sideleft", array(
	"IBLOCK_TYPE" => "articles",
	"IBLOCK_ID" => "9",
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "",
	"SORT_ORDER2" => "",
	"FILTER_NAME" => "arrFilterArticles",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "PROPERTY_LINK",
		2 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"INCLUDE_SUBSECTIONS" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>  

</div>


<div class="sideblock" id="random_image">
	<div class="sideblock_title_grey">Случайное фото</div>
	<?$APPLICATION->IncludeComponent("inmark:photo.random", "leftside", array(
	"IBLOCK_TYPE" => "1c_catalog",
	"IBLOCKS" => array(
		0 => "6",
	),
	"DETAIL_URL" => "/shop/index.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "5",
	"CACHE_GROUPS" => "Y",
	"PARENT_SECTION" => ""
	),
	false
);?>
</div>