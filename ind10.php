<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
function prn($str){
	echo '<pre style="border:1px solid black; background-color: #eee; color:black; z-index:10000000;">';
	print_r($str);
	echo '</pre>';
	}

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

?>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>