<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?> 

<?
mail("web-j8f1w@mail-tester.com", "Test letter", "Hello. GO for other. hi");
/*
CModule::IncludeModule("iblock");


$dbRes = CIBlockElement::GetList(
	Array(),
	Array("IBLOCK_ID" => 7), // инфоблок предложений
	false,
	false,
	Array("ID")
	);
$arList = Array();
while($arRes = $dbRes->GetNext()) $arList[] = $arRes["ID"];
prn($arList);	


CIBlockElement::SetPropertyValuesEx(4292284, 7, Array("ACTIVE" => "Y"));
*/
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>