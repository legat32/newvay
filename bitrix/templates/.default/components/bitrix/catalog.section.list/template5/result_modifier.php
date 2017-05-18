<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arChains = Array();
foreach($APPLICATION->arAdditionalChain as $arChain) $arChains[] = $arChain["LINK"];
//prn($arChains);

$aMenu = array();
$menuIndex = 0;
$previousDepthLevel = 1;
foreach($arResult["SECTIONS"] as $arSection) {
	$aMenu[] = Array(
		"TEXT" => $arSection["NAME"],
        "LINK" => $arSection["SECTION_PAGE_URL"],
		"SELECTED" => in_array($arSection["SECTION_PAGE_URL"], $arChains) ? 1 : 0,
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => $menuIndex,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
		"IS_PARENT" => $arSection["DEPTH_LEVEL"] == 1 ? 1 : 0
		);
	}
	
$arResult = $aMenu;
//pra($arResult);
?>