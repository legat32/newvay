<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$theme = COption::GetOptionString("main", "wizard_eshop_adapt_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}



$arResult["ITEMS"][64]["NAME"] = str_replace(" MIN", "", $arResult["ITEMS"][64]["NAME"]);
$arResult["ITEMS"][76]["NAME"] = str_replace(" MIN", "", $arResult["ITEMS"][76]["NAME"]);

// Удалим цены которые ненужно видеть соответствующим пользователям
if(PRICE_TYPE != DEALER_PRICE) unset($arResult["ITEMS"][64]);
if(PRICE_TYPE != JOINT_PRICE) unset($arResult["ITEMS"][76]);
//if(!defined("JOINT_PRICE")) unset($arResult["ITEMS"][76]);


//pra(DEALER_PRICE);
//pra(JOINT_PRICE);
//pra(PRICE_TYPE);
//unset($arResult["ITEMS"][64]);

//$arResult["ITEMS"][134]["NAME"] = "Акция";
//$arResult["ITEMS"][134]["VALUES"]["Y"]["VALUE"] = "Да";
$arResult["ITEMS"][134]["NAME"] = "Акция";
$arResult["ITEMS"][134]["VALUES"]["Y"]["VALUE"] = "Да";
//pra($arResult["ITEMS"]);
