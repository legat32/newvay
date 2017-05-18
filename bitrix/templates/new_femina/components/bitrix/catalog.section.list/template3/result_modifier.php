<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


$aMenu = array();
$menuIndex = 0;
$previousDepthLevel = 1;

foreach($arResult["SECTIONS"] as $arSection)
{
	
	/*if ($menuIndex > 0)
		$aMenu[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];
	*/
	
	
	$aMenu[] = Array(
		"TEXT" => $arSection["NAME"],
        "LINK" => $arSection["SECTION_PAGE_URL"],
		"SELECTED" => "",
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
//pra($aMenu);
//die();

?>