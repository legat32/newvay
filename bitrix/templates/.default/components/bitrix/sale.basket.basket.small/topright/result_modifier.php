<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["ITEMS_COUNT"]=count($arResult["ITEMS"]);
$sum=0;
foreach($arResult['ITEMS'] as $k=>$arItem) $sum=$sum+$arItem["QUANTITY"]*$arItem["PRICE"];
if($sum>0) $arResult["SUMMA"]=$sum;
?>
