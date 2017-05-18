<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?

function prn($str){
	echo '<pre style="border:1px solid black; background-color: #eee; color:black; z-index:10000000;">';
	print_r($str);
	echo '</pre>';
	}


	

CModule::IncludeModule("sale");

$ORDER_ID = 2620;

$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), Array("ID" => $ORDER_ID));
while ($ar_sales = $db_sales->GetNext())
{
   prn($ar_sales);
}
echo "<hr/>";

$dbOrderProps = CSaleOrderPropsValue::GetList(
   array("SORT" => "ASC"),
   array(
      "ORDER_ID" => $ORDER_ID
   )
);
while($arOrderProps = $dbOrderProps->GetNext())
{
   prn($arOrderProps);          
}

die();

$db_propVals = CSaleOrderUserPropsValue::GetList(array("ID" => "ASC"), Array("USER_PROPS_ID"=>$ID));
while ($arPropVals = $db_propVals->Fetch())
{
echo $arPropVals["USER_VALUE_NAME"]."=".$arPropVals["VALUE"]."<br>";
}

die();

mysql_connect("localhost", "newvay", "faMderUbizoLiKa!?8693");
mysql_select_db("newvay");

//$q = "DELETE FROM b_catalog_price WHERE ID < 4000000";
//mysql_query("START TRANSACTION");
//mysql_query("DELETE FROM b_catalog_price WHERE ID=3000000");
//mysql_query("COMMIT");

//$q = "DELETE FROM b_catalog_price WHERE ID = 3000000"; 
//$r = mysql_query($q);
//die("666");
 
$q = "SELECT ID, TIMESTAMP_X FROM b_catalog_price ORDER BY ID asc LIMIT 0, 30";
//$q = "SELECT ID, TIMESTAMP_X FROM b_catalog_price LIMIT 0, 100";
$r = mysql_query($q);
while($ar = mysql_fetch_array($r))
{
	prn($ar);
}

?>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>