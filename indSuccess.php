<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?> 

<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");



// Удаляем торговые предложения, в которых наличие равно нулю

$dbRes = CIBlockElement::GetList(
	Array(),
	Array("IBLOCK_ID" => 7, "<CATALOG_QUANTITY" => 1), // инфоблок предложений
	false,
	false,
	Array("ID", "NAME", "CATALOG_GROUP_1")
	);
$arDel = Array();
while($arRes = $dbRes->GetNext()) 
{	
	$arDel[$arRes["ID"]] = $arRes["NAME"];
}
$countEmptyOffers = count($arDel);

//$str = date("d.m.Y H:i:s")."\n";
if(count($arDel) <1 ) $str.="Not exists empty offers";
foreach($arDel as $k=>$v) 
{
	$str = $v." - ";
	if(CIBlockElement::Delete($k))
		$str .= "deleted";
	else 
		$str .= "DELETION ERROR!";	
	$str .= "\n";
	echo($str."<br/>");
}





// Удаляем товары, не содержащие торговых предложений
		
$dbRes = CIBlockElement::GetList(
	Array(),
	Array("IBLOCK_ID" => 7), // инфоблок предложений
	false,
	false,
	Array("ID", "PROPERTY_CML2_LINK")
	);
$arOffers = Array();
while($arRes = $dbRes->GetNext()) 
{	
	$arOffers[$arRes["PROPERTY_CML2_LINK_VALUE"]][] = $arRes["ID"];
}

$dbRes = CIBlockElement::GetList(
	Array(),
	Array("IBLOCK_ID" => 6, "ACTIVE" => "Y"), // инфоблок товаров
	false,
	false,
	Array("ID", "NAME")
	);
$arDel = Array();	
while($arRes = $dbRes->GetNext()) 
{	
	if(!isset($arOffers[$arRes["ID"]])) $arDel[$arRes["ID"]] = $arRes["NAME"];
}
$countEmptyProducts = count($arDel);

prn($arDel);





?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>