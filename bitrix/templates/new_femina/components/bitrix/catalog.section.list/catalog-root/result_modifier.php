<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["SECTIONS"] as $k => $arSection) 
{
	if($arSection["ELEMENT_CNT"] < 1) unset($arResult["SECTIONS"][$k]);
}



$count = 0;
$dbRes = CIBlockElement::GetList(Array(), Array("ACTIVE" => "Y", "PROPERTY_AKCIYA_ON_SITE" => "Y"/*, "PROPERTY_AKTSIYA" => "Y"*/),  false, false, Array("ID"));
while($arRes = $dbRes->Fetch()) $count++;


$arResult["SECTIONS"][] = Array(
	"ID" => 999999999,
	"NAME" => "Товары по акции",
	"DEPTH_LEVEL" => 1,
	"SECTION_PAGE_URL" => "/sale/",
	"DETAIL_PICTURE" => 191448,
	"ELEMENT_CNT" => $count
	);
$arResult["SECTIONS"][] = Array(
	"IBLOCK_SECTION_ID" => 999999999,
	"NAME" => "Товары по акции",
	"DEPTH_LEVEL" => 2,
	"SECTION_PAGE_URL" => "/sale/",
	"DETAIL_PICTURE" => 191448,
	"ELEMENT_CNT" => $count
	);


?>