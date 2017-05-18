<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arResult = Array(
	
	Array(
		"TEXT" => "Главная",
        "LINK" => "/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 0,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => ""
		),

	Array(
		"TEXT" => "О компании",
        "LINK" => "/o-kompanii/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 1
		),

			Array(
				"TEXT" => "О производстве",
				"LINK" => "/o-kompanii/o-proizvodstve.html",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 2,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),
				
			Array(
				"TEXT" => "Новости",
				"LINK" => "/o-kompanii/novosti/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 3,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),

			Array(
				"TEXT" => "Вакансии",
				"LINK" => "/o-kompanii/vakansii.html",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),				
				
	Array(
		"TEXT" => "Каталог",
        "LINK" => "/catalog/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 1
		),
		
			Array(
				"TEXT" => "Жен. трикотаж",
				"LINK" => "/vay/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),
			Array(
				"TEXT" => "Муж.трикотаж",
				"LINK" => "/muzhskoy-trikotazh/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),		
			Array(
				"TEXT" => "Детский трикотаж",
				"LINK" => "/detskiy-trikotazh/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),		
			Array(
				"TEXT" => "Аксессуары",
				"LINK" => "/aksessuary/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),		
			Array(
				"TEXT" => "Подарки",
				"LINK" => "/podarki/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),
	/*Array(
		"TEXT" => "Распродажа",
        "LINK" => "/sale/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 1
		),
		
			Array(
				"TEXT" => "VAY",
				"LINK" => "/sale/vay/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),				
			Array(
				"TEXT" => "JW",
				"LINK" => "/sale/jw/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),					
			Array(
				"TEXT" => "VAY KIDS",
				"LINK" => "/sale/vay_kids/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),				
			Array(
				"TEXT" => "Веснушки",
				"LINK" => "/sale/vesnushki/",
				"SELECTED" => "",
				"PERMISSION" => "X",
				"ADDITIONAL_LINKS" => Array(),
				"ITEM_TYPE" => "D",
				"ITEM_INDEX" => 4,
				"PARAMS" => Array(),
				"DEPTH_LEVEL" => 2,
				"IS_PARENT" => ""
				),					
				
	Array(
		"TEXT" => "Вопросы и ответы",
        //"LINK" => $USER->isAuthorized() ? "/personal/partner.html" : "/sotrudnichestvo.html",
		"LINK" => "/faq/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		),
*/
	Array(
		"TEXT" => "Сотрудничество",
        //"LINK" => $USER->isAuthorized() ? "/personal/partner.html" : "/sotrudnichestvo.html",
		"LINK" => "/partneram/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		),

	Array(
		"TEXT" => "Статьи",
        "LINK" => "/stati/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		),

	Array(
		"TEXT" => "Контакты",
        "LINK" => "/kontakty.html",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		),
		
	Array(
		"TEXT" => "Купить в розницу!",
        "LINK" => "/",
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => 1,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		)
		
	);

$arIndex = Array();
foreach($arResult as $arItem) $arIndex[] = $arItem["TEXT"];
$arIndex = array_flip($arIndex);
	
if($USER->isAuthorized()) 
	$arItem[$arIndex["Сотрудничество"]]["LINK"] = "/personal/support.html?ID=0&edit=1"; 
	
$script_name = $_SERVER["SCRIPT_NAME"];
if($_SERVER["SCRIPT_NAME"] == "/bitrix/urlrewrite.php") {
	$script_name = $_SERVER["REAL_FILE_PATH"];
	}

$script_name = str_replace("/shop/", "/catalog/", $script_name);
foreach($arResult as &$arItem) {
	if(strpos(" ".$script_name, $arItem["LINK"]) > 0) $arItem["SELECTED"] = 1;
	if(($script_name == "/kontakty.php")&&($arItem["LINK"] == "/kontakty.html")) $arItem["SELECTED"] = 1; 
	}
if($script_name == "/index.php") $arResult[0]["SELECTED"] = 1; 
else $arResult[0]["SELECTED"] = 0;
	
/*	
unset($name);	
switch( $script_name ) {
	case "/shop/index.php": $name = "Каталог";
	case "/catalog/index.php": $name = "Каталог";
	case "/sale/index.php": $name = "Распродажа";
	case "/stati/index.php": $name = "Статьи";
	case "/kontakty.php": $name = "Контакты";
	}
if(isset($name)) $arResult[$arIndex[$name]]["SELECTED"] = 1;
*/	
//pra($script_name);
//pra($arIndex);
?>
