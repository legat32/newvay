<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?
//prn($_GET);
//prn($_POST);
//prn($_FILES);
//prn($_SERVER);

$fcode = "datafile";

if(file_exists($_FILES[$fcode]["tmp_name"])) 
{
	// читаем что пришло в массив
	$arOffers = Array();
	if($_FILES[$fcode]["tmp_name"])
	{
		$csv = file($_FILES[$fcode]["tmp_name"]);
		$f = fopen($_SERVER["DOCUMENT_ROOT"]."/tools/importlog.txt", "a+");
		fwrite($f, date("d.m.Y H:i:s", time())." - ".$_SERVER["REMOTE_ADDR"]."\n");	
		foreach($csv as $row) 
		{
			$t = explode(";", $row);
			$arOffers[trim($t[0])] = trim($t[1]);
			fwrite($f, trim($row)."\n");	
		}
		fwrite($f, "\n");	
		fclose($f);
	}
	//prn($arOffers);
	
	
	
	Cmodule::IncludeModule('catalog');
	if(count($arOffers)>0)
	{
		$dbRes = CIBlockElement::GetList(Array(), Array("XML_ID" => array_keys($arOffers)), false, false, Array("ID", "NAME", "XML_ID", "CATALOG_QUANTITY"));
		echo "<h2>Актуальное наличие</h2>";
		echo "<table border='1' cellpadding='5' cellspacing='0'>";
		while($arRes = $dbRes->GetNext())
		{
			//$res = CCatalogProduct::Update($arRes["ID"], array('QUANTITY' => $arOffers[$arRes["XML_ID"]]));
			//prn($arRes["XML_ID"]." = ".$arOffers[$arRes["XML_ID"]]." - ".($res ? "OK" : "ERROR"));
			echo "<tr><td>".$arRes["XML_ID"]."</td><td>".$arRes["CATALOG_QUANTITY"]."</td><td><span style='font-size:80%; color:gray;'>".$arRes["NAME"]."</span></td></tr>";
		}
		echo "</table>";
	}
	else 
		echo "ERROR. Empty file";

	
	
	
}
//phpinfo();
?>