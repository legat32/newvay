<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$bIndexPage = ($_SERVER["SCRIPT_NAME"] == "/index.php" ? true : false);
define("PATH_TO_404", "/404.php");
CUtil::InitJSCore();
CJSCore::Init(array("jquery"));
ini_set('display_errors', 1);
//error_reporting(E_ALL);
if(($APPLICATION->GetCurPage(false) === '/')||($APPLICATION->GetCurPage(false) === '/home.html')) $frontpage = true;
else $frontpage = false;
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
	<?echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";?>
	
	<?
	$APPLICATION->ShowCSS();
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
	$APPLICATION->SetAdditionalCSS("/assets/fancybox2/source/jquery.fancybox.css?v=2.1.5");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slick.css");	
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/font-awesome.min.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/fonts/fonts.css");
	$APPLICATION->AddHeadScript("/assets/js/sly.min.js");
	$APPLICATION->AddHeadScript("/assets/fancybox2/source/jquery.fancybox.js?v=2.1.5");
	//$APPLICATION->AddHeadScript("/assets/accordion/jquery.dcjqaccordion.2.7.min.js");
	//$APPLICATION->AddHeadScript("/assets/accordion/jquery.cookie.js");
	$APPLICATION->AddHeadScript("/assets/js/main.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/new_js/slick.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/new_js/jquery.mousewheel.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/new_js/plugins.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/new_js/index.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.scrollbar.js");
	?>    
	
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-90233671-1', 'auto');
	ga('send', 'pageview');
	</script>
	
</head>
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

<?//pra($APPLICATION->GetCurPage(false));?>

<?/* Если мы находимся на главной */?> 
<?if($frontpage):?> 
	<body class="front">
<?endif;?> 

<?/* Если мы НЕ находимся на главной */?> 
<?if(!$frontpage):?>
	<body class="not-front">
<?endif;?> 





<header>
<a href="/" class="logo-mobile"><img src="/bitrix/templates/new_femina/images/logo.png"></a>
<div class="menu-trigger-wrap">
	<div id="nav-icon4" class="">
  		<span></span>
  		<span></span>
  		<span></span>
	</div>
	</div>
    <div class="mobile-wrap">
    
        <div class="header-wrap">
            <a href="/" class="logo"><img src="/bitrix/templates/new_femina/images/logo.png"></a>
            <?/*?><div class="question"><a rel="nofollow" class="head_ask fancybox-ask" href="/ask.html?blank=Y">ЗАДАТЬ ВОПРОС</a></div><?*/?>
			<p class="slog">Российский производитель трикотажа и швейной продукции<br>Оптовый интернет-магазин</p>
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => "/include/cabinet.php",
                        "EDIT_TEMPLATE" => ""
                    ),
                false
            );?>
            <div class="tel-wrap">
                <address class="tel"><a href="tel:+74959557888">(495) 955 78 88</a> <a href="tel:+74956737345">(495) 673 73 45</a></address>
                <div class="cart">
                <?/*?>
				<span class="title">КОРЗИНА</span>
                    <a rel="nofollow" id="div_cart" href="/basket/" title="Перейти в корзину">
                        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.small", 
	"topright", 
	array(
		"PATH_TO_BASKET" => "/basket/",
		"PATH_TO_ORDER" => "/order/",
		"SHOW_DELAY" => "Y",
		"SHOW_NOTAVAIL" => "Y",
		"SHOW_SUBSCRIBE" => "Y",
		"COMPONENT_TEMPLATE" => "topright"
	),
	false
);?>
                    </a>
					
					<?*/?>
					
					
					<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "new", Array(
							"PATH_TO_BASKET" => SITE_DIR."basket/",	// Страница корзины
							"PATH_TO_PERSONAL" => SITE_DIR."personal/",	// Страница персонального раздела
							"PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
							"PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
							"POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
							"SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
							"SHOW_EMPTY_VALUES" => "Y",	// Выводить нулевые значения в пустой корзине
							"SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
							"SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
							"SHOW_PRODUCTS" => "N",	// Показывать список товаров
							"SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
						),
						false
					);?>
					
					
                </div>
            </div>
        </div>
        <nav>
            <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"hor_multilevel3", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "hor_multilevel2"
	),
	false
);?>
        </nav>
    </div>
    	<div class="search">
	<div class="form-wrap">
        
          			<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"template1", 
	array(
		"NUM_CATEGORIES" => "1",
		"TOP_COUNT" => "5",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "Y",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
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
		"CONTAINER_ID" => "title-search",
		"COMPONENT_TEMPLATE" => "template1"
	),
	false
);?>
			</div>
			</div>
    </div>
</header>
<main>
    <div id="content">
	<?if(!$frontpage):?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb", 
			"template2", 
			array(
				"START_FROM" => "0",
				"PATH" => "",
				"SITE_ID" => "s1",
				"COMPONENT_TEMPLATE" => "template2"
			),
			false
			);
		?>
		<h1><?$APPLICATION->ShowTitle(true)?></h1>
	<?endif?>