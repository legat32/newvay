<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?

$DATE_START = "01.01.2015 00:00:00";
$DATE_FIN = "31.12.2015 23:59:59";


 


$t1 = explode(" ", $DATE_START);
$t2 = explode(" ", $DATE_FIN);
$FILENAME = str_replace(".", "", "report-".$t1[0]."-".$t2[0]).".csv";



$arUsers = Array();
$arFilter = Array(/*">DATE_INSERT" => $DATE_START*/);
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
	echo $ar_sales["ID"]." (".$ar_sales["USER_ID"].")".$ar_sales["DATE_INSERT"]." ".$ar_sales["PRICE"]."<br/>";
   //prn($ar_sales);
   //die();
   //$orders[$ar_sales["USER_ID"]][] = $ar_sales["ID"]."(".$ar_sales["PRICE"].")";
   //$summs[$ar_sales["USER_ID"]] += $ar_sales["PRICE"];
   //break;
}

die("er");






$arBaskets = Array();
$dbBasketItems = CSaleBasket::GetList(
	array(),
	array(
		"LID" => SITE_ID,
		"ORDER_ID" => "NULL",
		),
	false,
	false,
	array()
	);
while ($arItems = $dbBasketItems->Fetch())
{
	$arBaskets[$arItems["USER_ID"]]++;
}




 
$cUser = new CUser; 
$sort_by = "UF_OKRUG";
$sort_ord = "ASC";
$arParams["SELECT"] = array("UF_*");
$arFilter = array(
   "DATE_REGISTER_1" => $DATE_START,
   "DATE_REGISTER_2" => $DATE_FIN,
   "ACTIVE" => 'Y',
);
$dbUsers = $cUser->GetList($sort_by, $sort_ord, $arFilter, $arParams);


$num = 1;
$num_in_okrug = 1;
$okrug = "";
//echo "<table border=1 cellpadding=5>";
$users = Array();
while ($arUser = $dbUsers->Fetch()) 
{
   //prn($arUser);//echo $arUser["EMAIL"]." ".$arUser["DATE_REGISTER"]."<br>";
   $users[] = $arUser["ID"];
   if($arUser["UF_OKRUG"] != $okrug)
   {
		$okrug = $arUser["UF_OKRUG"];
		$num_in_okrug = 1;
   }
   //else $num_in_okrug++;
   //echo "<tr><td>&nbsp;".$num."&nbsp;</td><td>&nbsp;".$num_in_okrug."&nbsp;</td><td>&nbsp;".$arUser["DATE_REGISTER"]."&nbsp;</td><td>&nbsp;".$arUser["LOGIN"]."&nbsp;</td><td>&nbsp;".$arUser["NAME"]."&nbsp;</td><td>&nbsp;".$OKRUGS[$arUser["UF_OKRUG"]]."&nbsp;</td></tr>";
   $num++;
   //$num_in_okrug++;
}
//echo "</table>";


//prn($users);


$orders = Array();
$summs = Array();
$arFilter = Array(
   "USER_ID" => $users
   );
$db_sales = CSaleOrder::GetList(array("DATE_INSERT" => "ASC"), $arFilter);
while ($ar_sales = $db_sales->Fetch())
{
   //prn($ar_sales);
   //die();
   $orders[$ar_sales["USER_ID"]][] = $ar_sales["ID"]."(".$ar_sales["PRICE"].")";
   $summs[$ar_sales["USER_ID"]] += $ar_sales["PRICE"];
}
//prn($orders);






$cUser = new CUser; 
$sort_by = "UF_OKRUG";
$sort_ord = "ASC";
$arParams["SELECT"] = array("UF_*");
$arFilter = array(
   "DATE_REGISTER_1" => $DATE_START,
   "DATE_REGISTER_2" => $DATE_FIN,
   "ACTIVE" => 'Y',
);
$dbUsers = $cUser->GetList($sort_by, $sort_ord, $arFilter, $arParams);
$num = 1;
$num_in_okrug = 1;
$okrug = "";


$f = fopen($_SERVER["DOCUMENT_ROOT"]."/temp/stat/".$FILENAME, "w");
fwrite($f, iconv("utf-8", "windows-1251", "№;№ в регионе;Дата рег;Ассортимент;Корзина;Email;Имя;Регион;Кол-во заказов;Сумма по всем;Заказы")."\n");

//echo $_SERVER["DOCUMENT_ROOT"]."/temp/stat/".$FILENAME;

echo "<div style=\"width:100%; height:auto; overflow:scroll;\">";
echo "<table border=1 cellpadding=5>";
//$users = Array();
while ($arUser = $dbUsers->Fetch()) 
{
   if($arUser["UF_OKRUG"] != $okrug)
   {
		$okrug = $arUser["UF_OKRUG"];
		$num_in_okrug = 1;
   }
   else $num_in_okrug++;
   
   $ass = "";
   if(in_array(27, $arUser["UF_ASSORTIMENT"])) $ass .= "/детский";
   if(in_array(28, $arUser["UF_ASSORTIMENT"])) $ass .= "/женский";
   $ass = substr($ass, 1);
   
   $str = "";
   $str .= "<tr>";
   $str .= "<td>".$num."</td>";
   $str .= "<td>".$num_in_okrug."</td>";
   $str .= "<td>".$arUser["DATE_REGISTER"]."</td>";
   $str .= "<td>".$ass."</td>";
   $str .= "<td>".($arBaskets[$arUser["ID"]]>0 ? "есть" : "")."</td>";
   $str .= "<td>".$arUser["LOGIN"]."</td>";
   $str .= "<td>".$arUser["NAME"]."</td>";
   $str .= "<td>".$OKRUGS[$arUser["UF_OKRUG"]]."</td>";
   $str .= "<td>".count($orders[$arUser["ID"]])."</td>";
   $str .= "<td>".str_replace(".", ",", $summs[$arUser[ID]])."</td>";
   $str .= "<td>".implode(",", $orders[$arUser["ID"]])."</td>";
   $str .= "</tr>";
   echo $str;
   $num++;
   
   $str_csv = str_replace("<tr>", "", $str);
   $str_csv = str_replace("</tr>", "", $str_csv);
   $str_csv = str_replace("</td><td>", ";", $str_csv);
   $str_csv = str_replace("<td>", "", $str_csv);
   $str_csv = str_replace("</td>", "", $str_csv);
   
   //echo $str_csv;
   
   fwrite($f, iconv("utf-8", "windows-1251", $str_csv)."\n");
   
}
echo "</table></div>";

fclose($f);


die('end');


$arParams["SELECT"] = array("UF_*");
$rsUsers = CUser::GetList(($by="LAST_NAME"), ($order="asc"), $filter, $arParams); // выбираем пользователей 
echo "<table border=1 cellpadding=5>";
while($arUser = $rsUsers->GetNext()) 
{
	//prn($arUser);
	if(strLen($arUser["UF_OKRUG"]) < 1) 
	echo "<tr><td>".$arUser["ID"]."</td><td>".$arUser["LOGIN"]."</td><td>".$arUser["NAME"]."</td><td>".$arUser["ACTIVE1"]."</td></tr>";
} 
echo "</table>";




//CModule::IncludeModule("sale");
//CModule::IncludeModule("catalog");
//CModule::IncludeModule("iblock"); 
//$f=file("agents.csv");
//prn($f);

/*
function _getfilename($id) 
{
	global $APPLICATION;
	$rsFile = CFile::GetByID($id);
	if($arFile = $rsFile->Fetch()) 
	{
		$url = 'http://'.$_SERVER["HTTP_HOST"].'/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
		return '<a href="'.$url.'" target="_blank">'.$url.'</a>';
	}
	else 
		return 'нет файла';
}	

echo _getfilename(42807); 
/*
$rsFile = CFile::GetByID(42807);
$arFile = $rsFile->Fetch();
echo '<a href="http://'.$_SERVER["HTTP_HOST"].'/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"].'" target="_blank">ИНН (копия)</a>';
*/

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>