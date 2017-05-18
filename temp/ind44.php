<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$fileOffers = $_SERVER["DOCUMENT_ROOT"]."/temp/offers.xml";

// ====== формируем $arGoodsXML и $arOffersXML - парсим XML и берем только то, что нам нужно
$xml = simplexml_load_file($fileOffers); 
$arPriceTypes = Array();

// парсим типы цен
foreach($xml->ПакетПредложений->ТипыЦен->ТипЦены as $arPriceType)
{
	$arPriceTypes[trim($arPriceType->Ид)] = trim($arPriceType->Наименование);
}

// парсим торговые предложения
foreach($xml->ПакетПредложений->Предложения->Предложение as $k=>$arItem)
{
	if(intVal(trim($arItem->Количество)) > 0) 
	{
		$arPrices = Array();
		foreach($arItem->Цены->Цена as $arPrice)
		{
			$arPrices[trim($arPrice->ИдТипаЦены)] = trim($arPrice->ЦенаЗаЕдиницу);
		}
		$offerID = trim($arItem->Ид);
		$t = explode("#", $offerID);
		$goodID = $t[0];
		$arOffersXML[$offerID] = Array(
			"NAME" => trim($arItem->Наименование),
			"COUNT" => round(trim($arItem->Количество) == "" ? "0" : trim($arItem->Количество)),
			"PRICE" => $arPrices,
			"ACTIVE" => "Y"
			);
		$arGoodsXML[$goodID] = "Y";
	}
}
	
//prn($arOffersXML);
$i = 1;
foreach($arOffersXML as $k => $arItem) 
{
	echo $i.". ".$arItem["NAME"]." - ".$arItem["COUNT"]." (".$k.")<br/>";
	$i++;
}
?>