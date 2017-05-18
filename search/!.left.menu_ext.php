<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
global $APPLICATION;
$sections=$APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
	"IS_SEF" => "N",
	"ID" => $_REQUEST["CODE"],
	"IBLOCK_TYPE" => "furniture_products_s1",
	"IBLOCK_ID" => "6",
	"SECTION_URL" => "/sale/index.php?SECTION_ID=#SECTION_ID#",
	"DEPTH_LEVEL" => "2",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "3600"
	),
	false
);

$aMenuLinks = array_merge($aMenuLinks, $sections);
?>