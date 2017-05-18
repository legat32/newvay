<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?

//pra($arResult);

if(is_array($arResult["ITEMS"][120]["VALUES"]["false"])) $arResult["ITEMS"][120]["VALUES"]["false"]["VALUE"] = "только основной каталог";
if(is_array($arResult["ITEMS"][120]["VALUES"]["true"])) $arResult["ITEMS"][120]["VALUES"]["true"]["VALUE"] = "только распродажа";

if(is_array($arResult["ITEMS"][124]["VALUES"]["false"])) $arResult["ITEMS"][124]["VALUES"]["false"]["VALUE"] = "только основной каталог";
if(is_array($arResult["ITEMS"][124]["VALUES"]["true"])) $arResult["ITEMS"][124]["VALUES"]["true"]["VALUE"] = "только сезонные предложения";

$arResult["ITEMS"][62]["NAME"] = str_replace(" MIN", ", руб.", $arResult["ITEMS"][62]["NAME"]);
$arResult["ITEMS"][62]["VALUES"]["MIN"]["VALUE"] = round($arResult["ITEMS"][62]["VALUES"]["MIN"]["VALUE"]);
$arResult["ITEMS"][62]["VALUES"]["MAX"]["VALUE"] = round($arResult["ITEMS"][62]["VALUES"]["MAX"]["VALUE"]);
$arResult["ITEMS"][64]["NAME"] = str_replace(" MIN", ", руб.", $arResult["ITEMS"][64]["NAME"]);
$arResult["ITEMS"][64]["VALUES"]["MIN"]["VALUE"] = round($arResult["ITEMS"][64]["VALUES"]["MIN"]["VALUE"]);
$arResult["ITEMS"][64]["VALUES"]["MAX"]["VALUE"] = round($arResult["ITEMS"][64]["VALUES"]["MAX"]["VALUE"]);
$arResult["ITEMS"][76]["NAME"] = str_replace(" MIN", ", руб.", $arResult["ITEMS"][76]["NAME"]);
$arResult["ITEMS"][76]["VALUES"]["MIN"]["VALUE"] = round($arResult["ITEMS"][76]["VALUES"]["MIN"]["VALUE"]);
$arResult["ITEMS"][76]["VALUES"]["MAX"]["VALUE"] = round($arResult["ITEMS"][76]["VALUES"]["MAX"]["VALUE"]);

$arResult["ITEMS"][128]["NAME"] = "Длина изделия";
$newValues = Array();
if(isset($arResult["ITEMS"][128]["VALUES"]["Короткое"])) $newValues["Короткое"] = $arResult["ITEMS"][128]["VALUES"]["Короткое"];
if(isset($arResult["ITEMS"][128]["VALUES"]["Среднее"])) $newValues["Среднее"] = $arResult["ITEMS"][128]["VALUES"]["Среднее"];
if(isset($arResult["ITEMS"][128]["VALUES"]["Длинное"])) $newValues["Длинное"] = $arResult["ITEMS"][128]["VALUES"]["Длинное"];
if(isset($arResult["ITEMS"][128]["VALUES"]["Не указано"])) $newValues["Не указано"] = $arResult["ITEMS"][128]["VALUES"]["Не указано"];
$arResult["ITEMS"][128]["VALUES"] = $newValues;

// Удаляем лишние параметры в фильтре (типы цен)
// 62 - Розничная цена MIN
// 64 - Оптовая цена MIN
// 76 - Для совместных покупок цена MIN

if(!defined("DEALER_USER")) unset($arResult["ITEMS"][64]);
if(!defined("JOINT_USER")) unset($arResult["ITEMS"][76]);
if(defined("DEALER_USER") || defined("JOINT_USER")) unset($arResult["ITEMS"][62]);

$arColors = Array(
	"БЕЛЫЙ" => "#FFFFFF",
	"СЕРЫЙ" => "#808080", 
	"БЕЖЕВЫЙ" => "#faeedd", 
	"КОРИЧНЕВЫЙ" => "#a25f2a", 
	"ЖЕЛТЫЙ" => "#ffba00", 
	"ОРАНЖЕВЫЙ" => "#ff7518", 
	"КРАСНЫЙ" => "#ff2400", 
	"РОЗОВЫЙ" => "#e75480", 
	"ФУКСИЯ" => "#fc0fc0", 
	"ФИОЛЕТОВЫЙ" => "#4b0082",
	"СИРЕНЬ" => "#c9a0dc,",	
	"СИНИЙ" => "#1560bd", 
	"ГОЛУБОЙ" => "#42aaff", 
	"БИРЮЗОВЫЙ" => "#00cccc", 
	"ЗЕЛЕНЫЙ" => "#00a86b", 
	"ЧЕРНЫЙ" => "#000000", 
	"МНОГОЦВЕТНЫЙ" => "raduga",
	"НЕ УКАЗАН" => "no"
);
foreach($arResult["ITEMS"][127]["VALUES"] as &$val) {
	//echo $val["UPPER"]."<br/>";
	$val["COLOR_CODE"] = $arColors[$val["UPPER"]];
	}
//pra($arResult);
	
?>