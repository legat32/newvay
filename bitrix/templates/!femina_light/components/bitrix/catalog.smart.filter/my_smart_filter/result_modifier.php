<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult["ITEMS"] as $key => $arItem) {
	if($arItem["CODE"]=="COLOR") {
		$arColors=Array();
		foreach($arItem["VALUES"] as $code => $val) {
			$arColors[$code]=1;
			}
		}
	}

$tmp=Array();
foreach($arColors as $key=>$value) $tmp[]=$key;

$arSelect = Array("NAME","XML_ID");
$arFilter = Array("IBLOCK_ID"=>8, "XML_ID" => $tmp);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
$arColors=Array();
while($arFields = $res->GetNext()) 
	$arColors[$arFields["XML_ID"]]=$arFields["NAME"];

foreach($arResult["ITEMS"] as $key => $arItem) {
	foreach($arItem["VALUES"] as $code => $value) 
		$arResult["ITEMS"][$key]["VALUES"][$code]["DISPLAY_VALUE"]=$arColors[$code];
	}

echo "<pre>";
//print_r($arResult);
echo "</pre>";
?>