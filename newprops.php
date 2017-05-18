<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
CModule::IncludeModule("iblock");


$arSelect = Array("ID", "NAME", "CODE", "PROPERTY_CML2_ARTICLE", "PROPERTY_DLINA_RUKAVA_SM", "PROPERTY_BAMBOO", "PROPERTY_DLINA_IZDELIYA_SM", "PROPERTY_NOVIZNA", "PROPERTY_NOVINKA", "PROPERTY_RASPRODAZHA", "PROPERTY_SEZON", "PROPERTY_SEZONNOE_PREDLOZHENIE", "PROPERTY_UTSENKA");
$arFilter = Array("IBLOCK_ID" => 6, "ACTIVE" => "Y");
$dbRes = CIBlockElement::GetList(Array("PROPERTY_CML2_ARTICLE" => "asc"), $arFilter, false, false, $arSelect);
echo "<table border=1 cellpadding=4>";
echo "<tr>";
echo "<td>#</td>";
echo "<td>Артикул</td>";
echo "<td>Длина изделия</td>";
echo "<td>Длина рукава</td>";
echo "<td>Новизна</td>";
echo "<td>Новинка</td>";
echo "<td>Распродажа</td>";
echo "<td>Сезон</td>";
echo "<td>Сезонное предложение</td>";
echo "<td>Уценка</td>";
echo "<td>Бамбук</td>";
echo "</tr>";
$num = 0;
while($arRes = $dbRes->GetNext()) 
{
	//prn($arRes);
	echo "<tr>";
	echo "<td style='padding:5px; width:50px;'>".$num.".</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_CML2_ARTICLE_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_DLINA_IZDELIYA_SM_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_DLINA_RUKAVA_SM_VALUE"]."</td>";
	echo "<td style='padding:5px; width:150px;'>".$arRes["PROPERTY_NOVIZNA_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_NOVINKA_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_RASPRODAZHA_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_SEZON_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_SEZONNOE_PREDLOZHENIE_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_UTSENKA_VALUE"]."</td>";
	echo "<td style='padding:5px; width:100px;'>".$arRes["PROPERTY_BAMBOO_VALUE"]."</td>";
	echo "</tr>";
	$num++;
}
echo "</table>";
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>