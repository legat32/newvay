<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

pra($arResult);

$arOut = Array();
foreach($arResult["ITEMS"] as $arItem) 
{

	$dbSect = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	if($arSect = $dbSect->GetNext()) 
	{
		//prn($arSect);
		$arOut[$arItem["IBLOCK_SECTION_ID"]]["SECTION_NAME"] = $arSect["NAME"];
		$arOut[$arItem["IBLOCK_SECTION_ID"]]["SECTION_URL"] =  $arSect["SECTION_PAGE_URL"];
		$arOut[$arItem["IBLOCK_SECTION_ID"]]["ITEMS"][] = $arItem;
	}
	else 
	{
		$arOut[0]["SECTION_NAME"] = "Статьи, обзоры";
		$arOut[0]["SECTION_URL"] = "";
		$arOut[0]["ITEMS"][] = $arItem;
	}
	
}
//prn($arOut);
$arResult["stati"] = $arOut;

/*
$arResult["TD_WIDTH"] = round(100/$arParams["LINE_ELEMENT_COUNT"])."%";
$arResult["nRowsPerItem"] = 1; //Image, Name and Properties
$arResult["bDisplayPrices"] = false;
foreach($arResult["ITEMS"] as $arItem)
{
	if(count($arItem["PRICES"])>0 || is_array($arItem["PRICE_MATRIX"]))
		$arResult["bDisplayPrices"] = true;
	if($arResult["bDisplayPrices"])
		break;
}
if($arResult["bDisplayPrices"])
	$arResult["nRowsPerItem"]++; // Plus one row for prices
$arResult["bDisplayButtons"] = $arParams["DISPLAY_COMPARE"] || count($arResult["PRICES"])>0;
foreach($arResult["ITEMS"] as $arItem)
{
	if($arItem["CAN_BUY"])
		$arResult["bDisplayButtons"] = true;
	if($arResult["bDisplayButtons"])
		break;
}
if($arResult["bDisplayButtons"])
	$arResult["nRowsPerItem"]++; // Plus one row for buttons

//array_chunk
$arResult["ROWS"] = array();
while(count($arResult["ITEMS"])>0)
{
	$arRow = array_splice($arResult["ITEMS"], 0, $arParams["LINE_ELEMENT_COUNT"]);
	while(count($arRow) < $arParams["LINE_ELEMENT_COUNT"])
		$arRow[]=false;
	$arResult["ROWS"][]=$arRow;
}

*/
?>
