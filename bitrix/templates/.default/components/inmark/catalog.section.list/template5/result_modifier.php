<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arChains = Array();
foreach($APPLICATION->arAdditionalChain as $arChain) $arChains[] = $arChain["LINK"];
//prn($arChains);

$aMenu = array();
$menuIndex = 0;
$previousDepthLevel = 1;
//pra($arResult["SECTIONS"]);

// смотрим тут http://www.newvay.ru/bitrix/admin/iblock_list_admin.php?PAGEN_1=1&SIZEN_1=20&IBLOCK_ID=6&type=1c_catalog&lang=ru&find_section_section=273&set_filter=Y&adm_filter_applied=0
$AKSESSUARY_ZHEN = 285;
$AKSESSUARY_MUZH = 290;
$AKSESSUARY_DET = 293;

$AKSESSUARY_ZHEN_BEFORE_ID = 308;
$AKSESSUARY_MUZH_BEFORE_ID = 246;
$AKSESSUARY_DET_BEFORE_ID = 285;

foreach($arResult["SECTIONS"] as $arSection) 
{
	if($arSection["ELEMENT_CNT"] > 0)
	{
		$aMenu[$arSection["ID"]] = Array(
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
		if($arSection["ID"] == $AKSESSUARY_ZHEN) 
		{
			$arAksZhen[$arSection["ID"]] = $aMenu[$arSection["ID"]];
			$arAksZhen[$arSection["ID"]]["PSEUDO_LINK"] = "Y";
			$arAksZhen[$arSection["ID"]]["DEPTH_LEVEL"] = 3;
			$arAksZhen[$arSection["ID"]]["IS_PARENT"] = "";
		}
		if($arSection["ID"] == $AKSESSUARY_MUZH)
		{
			$arAksMuzh[$arSection["ID"]] = $aMenu[$arSection["ID"]];
			$arAksMuzh[$arSection["ID"]]["PSEUDO_LINK"] = "Y";
			$arAksMuzh[$arSection["ID"]]["DEPTH_LEVEL"] = 2;
			$arAksMuzh[$arSection["ID"]]["IS_PARENT"] = "";
		}
		if($arSection["ID"] == $AKSESSUARY_DET)
		{
			$arAksDet[$arSection["ID"]] = $aMenu[$arSection["ID"]];
			$arAksDet[$arSection["ID"]]["PSEUDO_LINK"] = "Y";
			$arAksDet[$arSection["ID"]]["DEPTH_LEVEL"] = 2;
			$arAksDet[$arSection["ID"]]["IS_PARENT"] = "";
		}
	}
}
$arResult = $aMenu;

//pra($arAksZhen);
?>