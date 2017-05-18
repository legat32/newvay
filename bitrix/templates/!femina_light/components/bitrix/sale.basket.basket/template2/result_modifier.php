<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//pra($arResult);

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


?>