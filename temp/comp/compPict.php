<?include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

function getFileArray($id)
{
	$img = CFile::GetFileArray($id);
	$res = Array(
		"ID" => $id,
		"SRC" => $_SERVER["DOCUMENT_ROOT"].$img["SRC"],
		"URL" => "http://".$_SERVER["SERVER_NAME"].$img["SRC"],
		"SIZE" => $img["FILE_SIZE"],
		"TIME" => filemtime($_SERVER["DOCUMENT_ROOT"].$img["SRC"]),
		"DESCRIPTION" => $img["DESCRIPTION"],
		"MD5" => md5_file($_SERVER["DOCUMENT_ROOT"].$img["SRC"])
		);
	return $res;
}


function compImg($arImg1, $arImg2)
{
	$arOneImg1 = Array();
	$arOneImg2 = Array();
	if(is_array($arImg1))
		$arOneImg1 = Array(
			"SIZE" => $arImg1["SIZE"],
			"DESCRIPTION" => $arImg1["DESCRIPTION"],
			"MD5" => $arImg1["MD5"]
			);
	if(is_array($arImg2))
		$arOneImg2 = Array(
			"SIZE" => $arImg2["SIZE"],
			"DESCRIPTION" => $arImg2["DESCRIPTION"],
			"MD5" => $arImg2["MD5"]
			);
	//prn($arOneImg1);
	//prn($arOneImg2);
	if($arOneImg1 == $arOneImg2) return "SYNCRO"; 
	else
	{
		if($arImg1["TIME"] > $arImg2["TIME"]) return "1 >> 2";
		else return "1 << 2";
	}
	
	
	
}


$f = file($_SERVER["DOCUMENT_ROOT"]."/temp/comp/dataSogrevay.txt");
$arSogrevay = unserialize($f[0]);

$f = file($_SERVER["DOCUMENT_ROOT"]."/temp/comp/dataNewvay.txt");
$arNewvay = unserialize($f[0]);

prn("read ok");

?>
<table border="1" cellpadding="5">
<tr>
<td>NEWVAY</td>
<td>SOGREVAY</td>
</tr>
<tr>
<?
$num = 0;
$arComp = Array();
$COMPARE_PREVIEW = false;

foreach($arNewvay as $k => $v)
{
	//echo "<tr><td valign='top'>";
	//prn($k);
	//prn($v);
	//echo "</td>";
	
	//echo "<td valign='top'>";
	//prn($k);
	//prn($arSogrevay[$k]);
	//echo "</td></tr>";
	
	
	

		

	if($COMPARE_PREVIEW) $arComp[$k]["PREVIEW_PICTURE"] = compImg($arNewvay[$k]["PREVIEW_PICTURE"], $arSogrevay[$k]["PREVIEW_PICTURE"]);
	$arComp[$k]["DETAIL_PICTURE"] = compImg($arNewvay[$k]["DETAIL_PICTURE"], $arSogrevay[$k]["DETAIL_PICTURE"]);
		
	$arMoreNewvay = Array();
	$arMoreSogrevay = Array();
	foreach($arNewvay[$k]["MORE_PHOTO"] as $km => $arItem)
	{
		$arMoreNewvay[$km] = Array(
			"SIZE" => $arItem["SIZE"],
			"DESCRIPTION" => $arItem["DESCRIPTION"],
			"MD5" => $arItem["MD5"]
		);
	}
	foreach($arSogrevay[$k]["MORE_PHOTO"] as $km => $arItem)
	{
		$arMoreSogrevay[$km] = Array(
			"SIZE" => $arItem["SIZE"],
			"DESCRIPTION" => $arItem["DESCRIPTION"],
			"MD5" => $arItem["MD5"]
		);
	}

	if($arMoreNewvay == $arMoreSogrevay) $arComp[$k]["MORE_PHOTO"] = "SYNCRO";
	else $arComp[$k]["MORE_PHOTO"] = "UPDATE";
	
	$num++;
	//if($num > 100) break;
}
?>
</tr>
</table>

<?
//prn($arComp);
echo "XML_ID;";
if($COMPARE_PREVIEW) echo "PREVIEW;DETAIL;MORE;<br/>";
else echo "DETAIL;MORE;<br/>";
foreach($arComp as $key => $val)
{
	echo $key.";";
	foreach($val as $k=>$v) echo $v.";";
	echo "<br/>";
}
?>
