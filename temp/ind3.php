<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");


$arSelect = Array("ID", "NAME", "CODE", "UF_*", "DESCRIPTION", "DEPTH_LEVEL", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID" => 6, "ACTIVE" => "Y");
$dbRes = CIBlockSection::GetList(Array("LEFT_MARGIN" => "asc"), $arFilter, false, $arSelect);

while($arRes = $dbRes->GetNext())
{
	echo "<hr/>";
	echo "<h2>".$arRes["NAME"]."</h2>";
	echo "ID = ".$arRes["ID"]."<br/>";
	echo "PARENT = ".$arRes["IBLOCK_SECTION_ID"]."<br/>";
	echo "CODE = ".$arRes["CODE"]."<br/>";
	echo "DEPTH_LEVEL = ".$arRes["DEPTH_LEVEL"]."<br/>";
	echo "TITLE = ".$arRes["UF_BROWSER_TITLE"]."<br/>";
	echo "HEADER = ".$arRes["UF_PAGE_HEADER"]."<br/>";
	echo "DESCRIPTION = ".$arRes["UF_META_DESCRIPTION"]."<br/>";
	echo "KEYWORDS = ".$arRes["UF_META_KEYWORDS"]."<br/>";
	echo "COLLECTION_COLOR = ".$arRes["UF_COLLECTION_COLOR"]."<br/>";
	echo "<textarea rows=10 cols=90>".$arRes["DESCRIPTION"]."</textarea>";
	//prn($arRes);
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>