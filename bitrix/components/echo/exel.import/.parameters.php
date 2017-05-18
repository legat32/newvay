<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arProperty = array();
$arProperty_N = array();
$rsProp = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$arCurrentValues["IBLOCK_ID"]));
while ($arr=$rsProp->Fetch())
{
	if($arr["PROPERTY_TYPE"] != "F")
		$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
}
$arProperty_LNS = $arProperty;


$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"NAME" => GetMessage("EEI_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"NAME" => GetMessage("EEI_IBLOCK_ID"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"PROPERTY_CODE" => array(
			"NAME" => GetMessage("EEI_PROPERTY_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $arProperty_LNS,
		),
		"CREATE_E_PROP" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEI_CREATE_E_PROP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CREATE_G_PROP" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEI_CREATE_G_PROP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CREATE_L_PROP" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEI_CREATE_L_PROP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CREATE_U_PROP" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEI_CREATE_U_PROP"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"TMP_PATH" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("EEI_TMP_PATH"),
			"TYPE" => "STRING",
			"DEFAULT" => "/upload/exel_import/",
		),
	),
);
?>