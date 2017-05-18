<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$totalSum = 0;
foreach($arResult["ITEMS"]["AnDelCanBuy"] as $k => $v) {
	$totalSum = $totalSum + $v["QUANTITY"] * $v["PRICE"];
	}
	
$skidka = round( 100 - 100 * ($arResult["ORDER_PRICE"]/$totalSum) );
	
$arResult["TOTAL_ORDER_PRICE"] = $totalSum;
$arResult["SKIDKA_BASKET"] = $skidka;

?>