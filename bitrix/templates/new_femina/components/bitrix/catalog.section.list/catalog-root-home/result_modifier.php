<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["SECTIONS"] as $k => $arSection) 
{
	if($arSection["ELEMENT_CNT"] < 1) unset($arResult["SECTIONS"][$k]);
}


$newSect = Array();
foreach($arResult["SECTIONS"] as $arSect)
{
	if($arSect["CODE"] == "aksessuary") break;
	//pra($arSect["CODE"]); 
	$newSect[] = $arSect;
}
$arResult["SECTIONS"] = $newSect;


?>