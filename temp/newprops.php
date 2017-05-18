<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");


$arSelect = Array("ID", "NAME", "CODE", "PROPERTY_ARTIKUL", "PROPERTY_NOVIZNA", "PROPERTY_SEZON");
$arFilter = Array("IBLOCK_ID" => 6, "ACTIVE" => "Y");
$dbRes = CIBlockElement::GetList(Array("NAME" => "asc"), $arFilter, false, false, $arSelect);
echo "<table border=1>";
while($arRes = $dbRes->GetNext()) 
{
	//prn($arRes);
	echo "<tr>";
	echo "<td>".$arRes["PROPERTY_ARTIKUL_VALUE"]."</td>";
	echo "<td>".$arRes["PROPERTY_SEZON_VALUE"]."</td>";
	echo "<td>".$arRes["PROPERTY_NOVIZNA_VALUE"]."</td>";
	echo "</tr>";
}
echo "</table>";
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>