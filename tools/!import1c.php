<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?
//prn($_GET);
//prn($_POST);
prn($_FILES);
//prn($_SERVER);

$fcode = "datafile";

if(file_exists($_FILES[$fcode]["tmp_name"])) 
{
	if($_FILES[$fcode]["tmp_name"])
	{
		$csv = file($_FILES[$fcode]["tmp_name"]);
		$f = fopen($_SERVER["DOCUMENT_ROOT"]."/tools/importlog.txt", "a+");
		fwrite($f, date("d.m.Y H:i:s", time())." - ".$_SERVER["REMOTE_ADDR"]."\n");	
		foreach($csv as $row) 
		{
			echo trim($row)."<br/>";
			fwrite($f, trim($row)."\n");	
		}
		fwrite($f, "\n");	
		fclose($f);
	}
}
//phpinfo();
?>