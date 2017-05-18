<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?

$ARTIKUL = intVal($_GET["ARTIKUL"]);

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$arGoods = Array();
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK" => 6, "PROPERTY_CML2_ARTICLE" => $ARTIKUL), false, false, Array("ID", "NAME", "PROPERTY_CML2_ARTICLE", "DETAIL_PAGE_URL"));
while($arRes = $dbRes->GetNext())
{
	$arGoods[] = $arRes["ID"];
	$link = $arRes["DETAIL_PAGE_URL"];
	//prn($link);
	echo "<br/><b>".$arRes["NAME"]."</b><br/>";
}
echo "<br/>";
//prn($arGoods);



if(count($arGoods) > 0)
{
	unset($arRes);
	unset($dbRes);
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK" => 7, "PROPERTY_CML2_LINK" => $arGoods), false, false, Array("ID", "NAME", "XML_ID", "DETAIL_PAGE_URL"));
	echo "<table border='1'>";
	while($arRes = $dbRes->GetNext())
	{
		//prn($arRes);
		$t = explode("#", $arRes["XML_ID"]);
		echo "<tr>";
		echo "<td style='border:1px solid gray; padding:3px 10px;'>".$arRes["NAME"]."</td>";
		echo "<td style='border:1px solid gray; padding:3px 10px;'><a target='_blank' href='http://newvay.ru".$link."?offer=".$t[1]."'>http://newvay.ru".$link."?offer=".$t[1]."</a></td>";
		echo "</tr>";
	}
	echo "</table>";

}


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>