<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
global $APPLICATION;
$sections=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "N",
	"ID" => $_REQUEST["CODE"],
	"IBLOCK_TYPE" => "all",
	"IBLOCK_ID" => "",
	"SECTION_URL" => "/#SECTION_CODE_PATH#/",
	"DEPTH_LEVEL" => "1",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);

//$aMenuLinks = array_merge($aMenuLinks, $sections);
$aMenuLinks = $sections;
?>