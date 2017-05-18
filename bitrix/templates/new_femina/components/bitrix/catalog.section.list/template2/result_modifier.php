<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/*
foreach($arResult["SECTIONS"] as $k => $arSection) 
{
	if($arSection["ELEMENT_CNT"] < 1) unset($arResult["SECTIONS"][$k]);
}
*/

// В этом файле общая структура меню со всеми пунктами и ссылками
require($_SERVER["DOCUMENT_ROOT"]."/include/catalog_menu.php");

$arResult["SECTIONS"] = Array();
$go = false;
foreach($arMenuItems as $k => $arMenuItem)
{
	if($arMenuItem["LINK"] == "/partneram/") $go = false;
	if($go) 
	{
		$arResult["SECTIONS"][$k] = $arMenuItem;	
		$arResult["SECTIONS"][$k]["DEPTH_LEVEL"]--;
		//prn($arMenuItem);
	}
	if($arMenuItem["LINK"] == "/catalog/") $go = true;
}

//prn($arResult["SECTIONS"]);

?>