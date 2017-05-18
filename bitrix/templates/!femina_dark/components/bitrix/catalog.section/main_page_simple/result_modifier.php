<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult['ITEMS'] as $k=>$arElement) {
	if(PRICE_TYPE == RETAIL_PRICE)	$price = $arElement["PROPERTIES"]["RETAIL_PRICE_MIN"]["VALUE"];
	if(PRICE_TYPE == JOINT_PRICE) 	$price = $arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"];
	if(PRICE_TYPE == DEALER_PRICE) 	$price = $arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"];
	$new[] = Array(
		"ID" => $arElement["ID"],
		"NAME" => $arElement["NAME"],
		"ARTIKUL" => $arElement["PROPERTIES"]["CML2_ARTICLE"]["VALUE"],
		"COLLECTION" => $arElement["PROPERTIES"]["COLLECTION"]["VALUE"],
		"PRICE" => formatCurrency( $price, "RUB"),
		"BUY_URL" => $arElement["BUY_URL"],
		"DETAIL_PAGE_URL" => $arElement["DETAIL_PAGE_URL"],
		"PREVIEW_IMG" => CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array('width'=>200, 'height'=>300), BX_RESIZE_IMAGE_EXACT, true, array(), false, 80)
		);
	}
	
	
// сортируем по порядку корневых разделов
/*
$arOrder = Array();
$ar_result=CIBlockSection::GetList(Array("sort"=>"asc"), Array("IBLOCK_ID"=>6, "DEPTH_LEVEL"=>1), false, Array("CODE"));
while($res=$ar_result->GetNext()) 
	$arOrder[]=$res["CODE"];
$new1=Array();
foreach($arOrder as $code) 
	$new1[strtoupper($code)]=$new[strtoupper($code)];
	
*/	
$arResult["SLIDES"] = $new;


$arSections = Array();
$dbSection = CIBlockSection::GetList(array("SORT" => "asc"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "DEPTH_LEVEL" => 1, "ACTIVE" => "Y"), false, array("CODE", "NAME", "SECTION_PAGE_URL"));
while($arSection = $dbSection->GetNext())
{
	$arSections[strtoupper($arSection["CODE"])] = Array(
		"NAME" => $arSection["NAME"],
		"SECTION_PAGE_URL" => $arSection["SECTION_PAGE_URL"]
		);
}
$arResult["SECTIONS"] = $arSections;

//pra($arResult["SECTIONS"]);  

$this->__component->SetResultCacheKeys(array("IDS"));
$this->__component->SetResultCacheKeys(array("DELETE_COMPARE_URLS"));
$this->__component->SetResultCacheKeys(array("SECTION_USER_FIELDS"));
$this->__component->SetResultCacheKeys(array("OFFERS_IDS"));


?>
