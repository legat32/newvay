<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($GLOBALS["ERROR_LIMIT"] as $mess) 
{
	$arResult["WARNING_MESSAGE"][] = $mess;
}




// получаем дополнительные данные для отображения в корзине DETAIL_PAGE_URL и подбираем картинку соответствующую

$arOffers = Array();
foreach($arResult["ITEMS"] as $kType => $arType)
{
	if(count($arResult["ITEMS"][$kType])>0)
	{
		foreach($arResult["ITEMS"][$kType] as $kItem => $arItem) 
		{
			$arOffers[$arItem["PRODUCT_ID"]] = 1;	
			$arResult["ITEMS"][$kType][$kItem]["PREVIEW_PICTURE"] = getPreview($arItem["PRODUCT_ID"], 110, 110);    // довыберем заодно картинку-превью
			foreach($arResult["ITEMS"][$kType][$kItem]["PROPS"] as $arProp) 
			{
				if(($arProp["CODE"] == "COLOR")||($arProp["CODE"] == "COLOR_LIST")) $arResult["ITEMS"][$kType][$kItem]["NEW_PROPS"]["COLOR"] = $arProp["VALUE"];
				if(($arProp["CODE"] == "SIZE")||($arProp["CODE"] == "SIZE_LIST")) $arResult["ITEMS"][$kType][$kItem]["NEW_PROPS"]["SIZE"] = $arProp["VALUE"];
			}
		}
	}
}

if(count($arOffers)>0)
{

	$arrID = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ID" => array_keys($arOffers)), false, false, Array("ID", "PROPERTY_CML2_LINK"));
	while($arRes = $dbRes->GetNext()) 
	{
		$arOffers[$arRes["ID"]] = $arRes["PROPERTY_CML2_LINK_VALUE"];
		$arrID[] = $arRes["PROPERTY_CML2_LINK_VALUE"];	
	}

	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ID" => $arrID), false, false, Array("ID", "NAME", "DETAIL_PAGE_URL"));
	while($arRes = $dbRes->GetNext())
	{
		foreach($arOffers as $kOffer => $arOffer)
		{
			if($arOffer == $arRes["ID"]) $arOffers[$kOffer] = $arRes;
		}
	}
	$arResult["EXTRA"] = $arOffers;

}










// Сортируем в порядке возрастания Артикула (надо выбрать артикул ибо его нет в исходных данных корзины)

$arOffersID = Array();
foreach($arResult["ITEMS"] as $type => $arType)
	foreach($arType as $itemID => $arItem)
		$arOffersID[] = $arItem["PRODUCT_ID"];

$arArticles = Array();
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ID" => $arOffersID), false, false, Array("ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.PROPERTY_CML2_ARTICLE"));
while($arRes = $dbRes->GetNext())
{
	$arArticles[$arRes["ID"]] = $arRes["PROPERTY_CML2_LINK_PROPERTY_CML2_ARTICLE_VALUE"];
}
asort($arArticles, SORT_NUMERIC);
$arIndexes = Array(); 
$ind = 0;
foreach($arArticles as $k => $v) $arIndexes[$k] = $ind++;

foreach($arResult["ITEMS"] as $kType => $arType)
{
	$newArr = Array();
	foreach($arType as $arItem)
	{
		$newArr[$arIndexes[$arItem["PRODUCT_ID"]]] = $arItem;
	}
	ksort($newArr);
	$arResult["ITEMS"][$kType] = array_values($newArr);
}







/*
prn("<hr>");
// довыберем необходимые данные
foreach($arResult["ITEMS"] as $kType => $arType)
{
	foreach($arType as $kItem => $arItem)
	{
		prn($arItem["ID"]." - ".$arItem["NAME"]);
	}
	prn("===================");
}
*/


?>