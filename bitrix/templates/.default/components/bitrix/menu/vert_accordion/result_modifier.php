<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();










$arResult["SECTIONS"] = array();
$arResult["ELEMENT_LINKS"] = array();


$arFilter = array(
	"IBLOCK_ID"=>6,
	"GLOBAL_ACTIVE"=>"Y",
	"IBLOCK_ACTIVE"=>"Y",
	"<="."DEPTH_LEVEL" => 2,
	);
$arOrder = array(
	"left_margin"=>"asc",
	);

$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
	"ID",
	"DEPTH_LEVEL",
	"NAME",
	"SECTION_PAGE_URL",
	));
if($arParams["IS_SEF"] !== "Y")
	$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
else
	$rsSections->SetUrlTemplates("", $arParams["SEF_BASE_URL"].$arParams["SECTION_PAGE_URL"]);
while($arSection = $rsSections->GetNext()) {
	$arResult["SECTIONS"][] = array(
		"ID" => $arSection["ID"],
		"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
		"NAME" => $arSection["~NAME"],
		"SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"],
		);
	$arResult["ELEMENT_LINKS"][$arSection["ID"]] = array();
}



$aMenuLinksNew = array();
$aMenu = array();
$menuIndex = 0;
$previousDepthLevel = 1;
foreach($arResult["SECTIONS"] as $arSection)
{
	if ($menuIndex > 0)
		$aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];
	
	
	
	$aMenu[] = Array(
		"TEXT" => $arSection["NAME"],
        "LINK" => $arSection["SECTION_PAGE_URL"],
		"SELECTED" => "",
		"PERMISSION" => "X",
		"ADDITIONAL_LINKS" => Array(),
		"ITEM_TYPE" => "D",
		"ITEM_INDEX" => $menuIndex,
        "PARAMS" => Array(),
		"DEPTH_LEVEL" => 1,
		"IS_PARENT" => 0
		);
	
	
	

	$arResult["ELEMENT_LINKS"][$arSection["ID"]][] = urldecode($arSection["~SECTION_PAGE_URL"]);
	$aMenuLinksNew[$menuIndex++] = array(
		htmlspecialcharsbx($arSection["~NAME"]),
		$arSection["~SECTION_PAGE_URL"],
		$arResult["ELEMENT_LINKS"][$arSection["ID"]],
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
		),
	);
}

$arResult=$aMenu;
/*
echo "<pre>";
print_r($aMenu);
echo "</pre>";
die();
*/
?>














?>
