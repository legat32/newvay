<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

prn(mktime(0,0,0,8,1,2015));
die();

$q = "SELECT ID,TIMESTAMP_X FROM b_catalog_product WHERE UNIX_TIMESTAMP(TIMESTAMP_X) < 1427835600 ORDER BY TIMESTAMP_X ASC LIMIT 0,5000";
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
	if($num == 4999) prn($m["TIMESTAMP_X"]);
}
//prn($m);
//prn($arr);
//die();


foreach($arr as $id)
{
	$res = CCatalogProduct::Delete($id);
	if($res) echo $id." - YES<br/>"; else echo $id." - NO================<br/>";
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

<script>document.location.href='http://www.newvay.ru/temp/ind7.php'</script>

<?//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>