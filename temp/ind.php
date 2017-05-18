<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");


$ORDER_ID = $_GET["ORDER_ID"];

$arOrder = CSaleOrder::GetByID($ORDER_ID);

$arFilter = Array( "ID" => $arOrder["USER_ID"]);
$arParam["SELECT"] = Array("UF_CITY", "UF_ASSORTIMENT", "UF_OKRUG");
$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
if($arUser = $rsUser->GetNext()) {
	$UF_OKRUG = $arUser["UF_OKRUG"];
	$UF_ASSORTIMENT = $arUser["UF_ASSORTIMENT"];
	}


$dbVals = CSaleOrderPropsValue::GetList( array("SORT" => "ASC"), array("ORDER_ID" => $ORDER_ID));
while($arVals = $dbVals->GetNext())
{
	prn($arVals);
	$delivery_types = Array(
		"avia" => "Авиатранспорт",
		"train" => "Железнодорожный транспорт",
		"avto" => "Автомобильный транспорт"
		);
	// смотреть тут http://shop.newvay.ru/bitrix/admin/userfield_admin.php?lang=ru
	if($arVals["VALUE"] == "Женский ассортимент") $UF_ASSORTIMENT = 7;
	if($arVals["VALUE"] == "Детский ассортимент") $UF_ASSORTIMENT = 6;
	if($arVals["CODE"] == "COMPANY") $arFields["BUYER"] = $arVals["VALUE"];
	if($arVals["CODE"] == "FIO") $arFields["BUYER"] = $arVals["VALUE"];
	if($arVals["CODE"] == "DELIVERY_COMPANY") $arFields["DELIVERY_COMPANY"] = $arVals["VALUE"];
	if($arVals["CODE"] == "DELIVERY_CITY") $arFields["DELIVERY_CITY"] = $arVals["VALUE"];
	if($arVals["CODE"] == "DELIVERY_TYPE") $arFields["DELIVERY_TYPE"] = $delivery_types[$arVals["VALUE"]];
	if($arVals["CODE"] == "DELIVERY_FIO") $arFields["DELIVERY_FIO"] = $arVals["VALUE"];
	if($arVals["CODE"] == "JUR_DELIVERY_COMPANY") $arFields["DELIVERY_COMPANY"] = $arVals["VALUE"];
	if($arVals["CODE"] == "JUR_DELIVERY_CITY") $arFields["DELIVERY_CITY"] = $arVals["VALUE"];
	if($arVals["CODE"] == "JUR_DELIVERY_TYPE") $arFields["DELIVERY_TYPE"] = $delivery_types[$arVals["VALUE"]];
	if($arVals["CODE"] == "JUR_DELIVERY_FIO") $arFields["DELIVERY_FIO"] = $arVals["VALUE"];
}


prn($arFields["BUYER"]);
prn($arFields["DELIVERY_COMPANY"]);
prn($arFields["DELIVERY_CITY"]);
prn($arFields["DELIVERY_TYPE"]);
prn($arFields["DELIVERY_FIO"]);

//prn($UF_OKRUG);
//prn($UF_ASSORTIMENT);

prn($ORDER_ID);
prn(get_manager_mail($UF_ASSORTIMENT, $UF_OKRUG));



?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>