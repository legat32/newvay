<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

$q = "SELECT ID FROM b_catalog_price WHERE CATALOG_GROUP_ID = 5 LIMIT 0,20000";
$r = mysql_query($q);
if(mysql_num_rows($r)<1) die("STOP");

$arr = Array();
$num = 0;
while($m = mysql_fetch_array($r))
{
	$arr[] = $m["ID"];
	$num++;
	/*
	$f=fopen($_SERVER["DOCUMENT_ROOT"]."/ids.txt", "a+");
	fwrite($f, $m["ID"]."\n");
	fclose($f);
	*/
	//if($num == 4999) prn($m["TIMESTAMP_X"]);
}
//prn($m);
//prn($arr);
//die();


foreach($arr as $id)
{
	$q = "DELETE FROM b_catalog_price WHERE ID = ".$id;
	if($r = mysql_query($q)) echo $id." - YES<br/>"; else echo $id." - NO================<br/>";
}
/*
die();

$time = mktime(0,0,0,4,1,2015);
echo $time."<br/>";
echo date("d.m.Y H:i:s", $time);

//echo mktime(23,49,53,9,29,2014);
//93.171.209.131
die();
$res = CCatalogProduct::Delete(8637302);
if($res) echo "YES"; else echo "NO";
*/
?>

<script>document.location.href='http://www.newvay.ru/ind8.php'</script>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>