<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// В этом файле общая структура меню со всеми пунктами и ссылками
require($_SERVER["DOCUMENT_ROOT"]."/include/catalog_menu.php");
$arResult = $arMenuItems;

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

$arResult[count($arResult)-1]["SELECTED"] = 0;  // принудительно уберем SELECTED с "Купить в розницу!"


?>
