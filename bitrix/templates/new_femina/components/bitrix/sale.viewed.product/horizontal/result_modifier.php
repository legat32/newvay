<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//$arIds = Array();
//foreach($arResult as $arItem) $arIds[]=$arItem["PRODUCT_ID"];
//$GLOBALS["arrFilterViewed"] = Array("IBLOCK_ID"=>6, "ID"=>$arIds);
?>


<?
// —формируем дополнительные параметры
	/*foreach($arResult as $key=>$arElement) {
		echo $arElement["DETAIL_PICTURE"]."<hr/>";
		$arResult[$key]["COLLECTION_NAME"]=constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_NAME");
		$arResult[$key]["COLLECTION_COLOR"]=constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_COLOR");
		$arResult[$key]["TITLE"]=$arResult["ITEMS"]["COLLECTION_NAME"]." ".$arElement["NAME"];
		if(strLen($arElement["DETAIL_PICTURE"])>0) {
			$arResult[$key]["PREVIEW_IMG"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 100, "height" => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			}
		}
		*/
?>