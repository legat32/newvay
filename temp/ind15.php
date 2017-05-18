<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("iblock");	 
CModule::IncludeModule("catalog");
//die("99");

define("PRODUCTS_IBLOCK_ID", 6);
//define(UF_COLLECTION_COLOR);




if (CModule::IncludeModule("iblock")) 
{
	$ar_result=CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>PRODUCTS_IBLOCK_ID, "CODE"=> Array("VAY-KIDS", "VAY", "VESNUSHKI"), false, Array("UF_COLLECTION_COLOR")));
	$collections=Array();
	while($res=$ar_result->GetNext()) {
		prn($res);
		$coll_code = str_replace("-", "", str_replace("_", "", $res["CODE"]));
		$collections[$res["ID"]]=$coll_code;
		define(strtoupper($coll_code)."_SECTION_ID", $res["ID"]);
		define(strtoupper($coll_code)."_NAME", $res["NAME"]);
		define(strtoupper($coll_code)."_COLOR", $res["UF_COLLECTION_COLOR"]);
	}
}

prn($collections);








$PRODUCT_ID = 4267825;
$SECTION_ID = 250;

$collectionID = 0;
$nav = CIBlockSection::GetNavChain(PRODUCTS_IBLOCK_ID, $SECTION_ID);
while($arPath = $nav->GetNext() ) {
	if(
		(strtoupper($arPath["CODE"]) == "VAY") || 
		(strtoupper($arPath["CODE"]) == "VESNUSHKI") ||
		(strtoupper($arPath["CODE"]) == "VAY-KIDS")
		)
	$collectionID = $arPath["ID"];
	if($collectionID > 0) break;
	}
	
//$arFields["COLLECTION"] = $collection;
prn($collectionID);
//$collection = strtoupper($collections[$ROOT_SECTION_ID]);
?>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>