<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arNewItems = Array();
foreach($arResult["ITEMS"] as $arItem) {
	$arNewItems[$arItem["IBLOCK_SECTION_ID"]]["ITEMS"][] = $arItem;
	}
	
foreach($arNewItems as $sect_id => $arItems) {
	$dbRes = CIBlockSection::GetByID($sect_id);
	if($arRes = $dbRes->GetNext()) {
		$arNewItems[$sect_id]["NAME"] = $arRes["NAME"];
		$arNewItems[$sect_id]["DESCRIPTION"] = $arRes["DESCRIPTION"];
		}
	foreach($arItems["ITEMS"] as $item_id => $arItem) {
		$arNewItems[$sect_id]["ITEMS"][$item_id]["PREVIEW_IMG"] = CFile::ResizeImageGet( 
			$arItem["DETAIL_PICTURE"],
			array("width" => 50, "height" => 50),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, 
			false
			);
		$arNewItems[$sect_id]["ITEMS"][$item_id]["DETAIL_IMG"] = CFile::ResizeImageGet( 
			$arItem["DETAIL_PICTURE"],
			array("width" => 150, "height" => 150),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, 
			false
			);
		}
	}
	
$arResult["ITEMS"] = $arNewItems;
?>

