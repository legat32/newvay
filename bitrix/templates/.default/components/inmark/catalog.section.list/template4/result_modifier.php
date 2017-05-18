<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arChains = Array();
foreach($APPLICATION->arAdditionalChain as $arChain) $arChains[] = $arChain["LINK"];
//prn($arChains);

$aMenu = array();
$menuIndex = 0;
$previousDepthLevel = 1;
//pra($arResult["SECTIONS"]);
foreach($arResult["SECTIONS"] as $arSection) 
{
	if($arSection["ELEMENT_CNT"] > 0)
	{
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
			"IS_PARENT" => $arSection["RIGHT_MARGIN"]-$arSection["LEFT_MARGIN"] > 1 ? 1 : 0
			);
	}
}
	
$arResult = $aMenu;
//pra($arResult);
?>