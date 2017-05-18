<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/*
$arIds = Array();
foreach($arResult["SEARCH"] as $arItem) {
	$arIds[]=$arItem["ITEM_ID"];
	}
if(!empty($arIds)) $GLOBALS["arrFilterSearch"] = Array("IBLOCK_ID" => 6, "ID" => $arIds);
*/
$GLOBALS["arrFilterSearch"] = Array(
	"IBLOCK_ID" => 6, 
	"ACTIVE" => "Y", 
	Array(
		"LOGIC" => "OR",
		"NAME" => "%".strVal($_GET["q"])."%",
		"PROPERTY_CML2_ARTICLE" => "%".strVal($_GET["q"])."%"
		)
	);
//"IBLOCK_ID" => 6, "PROPERTY_CML2_ARTICLE" => "%".strVal($_GET["q"])."%", "NAME" => "%".strVal($_GET["q"])."%");

/*
if($USER->isAdmin()) 
{
	prn($GLOBALS["arrFilterSearch"]);
	$dbRes = CIBlockElement::GetList(
		false, 
		Array(
			"IBLOCK_ID" => 6, 
			"ACTIVE" => "Y", 
			Array(
				"LOGIC" => "OR",
				"NAME" => "%".strVal($_GET["q"])."%",
				"PROPERTY_CML2_ARTICLE" => "%".strVal($_GET["q"])."%"
				)
			),
			false, 
			false, 
			Array("ID", "XML_ID", "NAME") 
		);
	while($arRes = $dbRes->GetNext() )  prn($arRes);
}
*/


?>