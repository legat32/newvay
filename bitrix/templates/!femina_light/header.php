<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$bIndexPage = ($_SERVER["SCRIPT_NAME"] == "/index.php" ? true : false);
define("PATH_TO_404", "/404.php");
CUtil::InitJSCore();
CJSCore::Init(array("jquery"));
ini_set('display_errors', 1);
//error_reporting(E_ALL);
?>
<?
/*<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
*/
?>
<!DOCTYPE html>
<html>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<?$APPLICATION->ShowMeta("description")?> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
	<?echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";?>
	<?/*?><link media="screen" href="/assets/vidjetsliza.css" type="text/css" rel="stylesheet" /><?*/?>
	
	<?
	$APPLICATION->ShowCSS();
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
	/*
	if($USER->isAdmin())
	{
		$APPLICATION->ShowHeadStrings();
		$APPLICATION->ShowHeadScripts();
	}
	*/
	
	$APPLICATION->SetAdditionalCSS("/assets/fancybox2/source/jquery.fancybox.css?v=2.1.5");
	$APPLICATION->SetAdditionalCSS("/bitrix/css/main/font-awesome.css");
	$APPLICATION->SetAdditionalCSS("http://fonts.googleapis.com/css?family=PT+Sans:400,700&amp;subset=cyrillic,latin");
	
	//$APPLICATION->AddHeadScript("/assets/js/jquery.cookie.js");
	$APPLICATION->AddHeadScript("/assets/js/plugins.js");
	$APPLICATION->AddHeadScript("/assets/js/sly.min.js");
	$APPLICATION->AddHeadScript("/assets/fancybox2/source/jquery.fancybox.js?v=2.1.5");
	$APPLICATION->AddHeadScript("/assets/accordion/jquery.dcjqaccordion.2.7.min.js");
	$APPLICATION->AddHeadScript("/assets/accordion/jquery.cookie.js");
	$APPLICATION->AddHeadScript("/assets/js/main.js");
	?>
	
	<?/*/>
	<script type="text/javascript">
	var __cs = __cs || [];
	__cs.push(["setCsAccount", "agg4z1eWgUZPmgevzR9C28ZILrNggsOr"]);
	__cs.push(["setCsHost", "//server.comagic.ru/comagic"]);
	</script>
	<script type="text/javascript" async src="//app.comagic.ru/static/cs.min.js"></script>
	<?*/?>
	
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-90233671-1', 'auto');
	ga('send', 'pageview');
	</script>
	
</head>
<body>
<div id="panel">
	<?$APPLICATION->ShowPanel();?>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/top_banner.php",
		"EDIT_TEMPLATE" => ""
	),
false
);?>


<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"top-row", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "17",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "BACKGROUND_COLOR",
			1 => "COLOR",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "top-row"
	),
	false
);?>

<div id="top">
	<div id="header">
		<div id="header_l">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"PATH" => "/include/phones_ask.php",
					"EDIT_TEMPLATE" => ""
				),
			false
			);?>
		</div>
		<div id="logo"><a id="logo_lnk" href="/"></a></div>
		<div id="header_r">
			<!--noindex-->
			<div id="div_reg">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => "/include/old_cabinet.php",
						"EDIT_TEMPLATE" => ""
					),
				false
				);?>
			</div>
			<a rel="nofollow" id="div_cart" href="/basket/" title="Перейти в корзину">
				<?$APPLICATION->SetTitle(""); ?><?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "topright", array(
					"PATH_TO_BASKET" => "/basket/",
					"PATH_TO_ORDER" => "/order/",
					"SHOW_DELAY" => "Y",
					"SHOW_NOTAVAIL" => "Y",
					"SHOW_SUBSCRIBE" => "Y"
					),
					false
				);?>
			</a>
			<!--/noindex-->
		</div>
		<div class="clear"></div>
		<div id="topmenu"> 
			<?$APPLICATION->IncludeComponent("bitrix:menu", "hor_multilevel2", array(
	"ROOT_MENU_TYPE" => "top",
	"MENU_CACHE_TYPE" => "A",
	"MENU_CACHE_TIME" => "36000",
	"MENU_CACHE_USE_GROUPS" => "Y",
	"MENU_CACHE_GET_VARS" => array(
	),
	"MAX_LEVEL" => "2",
	"CHILD_MENU_TYPE" => "left",
	"USE_EXT" => "Y",
	"DELAY" => "N",
	"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
		</div> 
		<div id="search_line">
			<!--noindex-->
			<?$APPLICATION->IncludeComponent("bitrix:search.title", "template1", array(
				"NUM_CATEGORIES" => "1",
				"TOP_COUNT" => "5",
				"ORDER" => "date",
				"USE_LANGUAGE_GUESS" => "Y",
				"CHECK_DATES" => "N",
				"SHOW_OTHERS" => "N",
				//"PAGE" => "#SITE_DIR#search/index.php",
				"PAGE" => "#SITE_DIR#search/",
				"CATEGORY_0_TITLE" => "",
				"CATEGORY_0" => array(
					0 => "iblock_1c_catalog",
				),
				"CATEGORY_0_iblock_1c_catalog" => array(
					0 => "6",
				),
				"SHOW_INPUT" => "Y",
				"INPUT_ID" => "title-search-input",
				"CONTAINER_ID" => "title-search"
				),
				false
			);?>
			<!--/noindex-->
		</div>
	</div><!-- #header-->
</div>

	<div id="wrapper">
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
	
	<div id="middle">	
		<div id="container">
			<div id="content">			
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "template2", Array(
				"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
				"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
				"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				),
				false
			);?>