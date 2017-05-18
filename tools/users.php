<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?

$DATE_START = "01.08.2015 00:00:00";
$DATE_FIN = "31.08.2015 23:59:59";

if( (strLen(strVal($_GET["DATE_START"])) > 0) && (strLen(strVal($_GET["DATE_FIN"])) > 0) )
{
	$st = explode("-", $_GET["DATE_START"]);
	$DATE_START = $st[0].".".$st[1].".".$st[2]." ".$st[3].":".$st[4].":".$st[5];
	$fn = explode("-", $_GET["DATE_FIN"]);
	$DATE_FIN = $fn[0].".".$fn[1].".".$fn[2]." ".$fn[3].":".$fn[4].":".$fn[5];
}
else 
	die("Не задана дата в URL (формат '/stat.php?DATE_START=01-08-2015-00-00-00&DATE_FIN=31-08-2015-23-59-59')");

/*
$cUser = new CUser; 
$sort_by = "UF_OKRUG";
$sort_ord = "ASC";
$arParams["SELECT"] = array("UF_*");
$arFilter = array(
   //"DATE_REGISTER_1" => $DATE_START,
   //"DATE_REGISTER_2" => $DATE_FIN,
   "ACTIVE" => 'Y',
   "ID" => 1
);
$dbUsers = $cUser->GetList($sort_by, $sort_ord, $arFilter, $arParams);


while ($arUser = $dbUsers->Fetch()) 
{
	prn($arUser);
}

//die("324");
*/



$t1 = explode(" ", $DATE_START);
$t2 = explode(" ", $DATE_FIN);
$FILENAME = str_replace(".", "", "report-".$t1[0]."-".$t2[0]).".csv";





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







$PARTNER_TYPES = Array(
	21 => "Физлицо",
	20 => "ИП",
	19 => "ООО"
	);

 
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
   //prn($arUser);
   //die();
   //echo $arUser["EMAIL"]." ".$arUser["DATE_REGISTER"]."<br>";
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
//die();

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
fwrite($f, iconv("utf-8", "windows-1251", "№;№ в регионе;Дата рег;Посл авт;Ассортимент;Корзина;Email;Имя;Тлф;Тип сотр;Назв;Округ;Заметки;Кол-во заказов;Сумма по всем;Заказы")."\n");

//echo $_SERVER["DOCUMENT_ROOT"]."/temp/stat/".$FILENAME;

echo "Дата начала - ".$DATE_START."<br/>Дата окончания - ".$DATE_FIN."<br/>";
echo "<div style=\"width:100%; height:auto; max-height:600px; background-color: gainsboro; overflow:auto;\">";
echo "<style>";
echo ".datatable td {padding:3px 4px;}";
echo "</style>";
echo "<table class='datatable' border=1 cellpadding=5>";
echo "<tr style='background-color: #A1D4A7;'>";
echo "<td><a title='Общая нумерация' href='#'>№</a></td>";
echo "<td><a title='Нумерация в пределах округа' href='#'>№р</a></td>";
echo "<td><a title='Дата регистрации' href='#'>Дата рег</a></td>";
echo "<td><a title='Последняя авторизация' href='#'>Посл авт</a></td>";
echo "<td><a title='Ассортимент, указанный при регистрации' href='#'>Ассорт</a></td>";
echo "<td><a title='Имеется ли в данный момент корзина у пользователя на сайте' href='#'>Корзина?</a></td>";
echo "<td><a title='E-Mail' href='#'>E-Mail</a></td>";
echo "<td><a title='Имя' href='#'>Имя</a></td>";
echo "<td><a title='Тлф' href='#'>Тлф</a></td>";
echo "<td><a title='Тип сотрудничества' href='#'>Тип сотр</a></td>";
echo "<td><a title='Название' href='#'>Название</a></td>";
echo "<td><a title='Округ' href='#'>Округ</a></td>";
echo "<td><a title='Заметки из админки' href='#'>Заметки</a></td>";
echo "<td><a title='Количество заказов' href='#'>Кол-во<br/>заказов</a></td>";
echo "<td><a title='Общая сумма по заказам' href='#'>Сумма</a></td>";
echo "<td><a title='Номера и суммы с разбиением по заказам' href='#'>Подробнее о заказах</a></td>";
echo "</tr>";
//$users = Array();
while ($arUser = $dbUsers->Fetch()) 
{
   if($arUser["UF_OKRUG"] != $okrug)
   {
		$okrug = $arUser["UF_OKRUG"];
		$num_in_okrug = 1;
   }
   else $num_in_okrug++;
   //if($arUser["ID"] == 1902) prd($arUser);
   $ass = "";
   if(in_array(27, $arUser["UF_ASSORTIMENT"])) $ass .= "/детский";
   if(in_array(28, $arUser["UF_ASSORTIMENT"])) $ass .= "/женский";
   $ass = substr($ass, 1);
   
   $str = "";
   $str .= "<tr>";
   $str .= "<td>".$num."</td>";
   $str .= "<td>".$num_in_okrug."</td>";
   $str .= "<td>".$arUser["DATE_REGISTER"]."</td>";
   $str .= "<td>".$arUser["LAST_LOGIN"]."</td>";
   $str .= "<td>".$ass."</td>";
   $str .= "<td>".($arBaskets[$arUser["ID"]]>0 ? "есть" : "")."</td>";
   $str .= "<td>".$arUser["LOGIN"]."</td>";
   $str .= "<td>".trim(str_replace("  ", " ", $arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]))."</td>";
   $str .= "<td>".$arUser["PERSONAL_PHONE"]."</td>";
   $str .= "<td>".$PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]]."</td>";
   
   if(($arUser["UF_PARTNER_TYPE"] == 19) || ($arUser["UF_PARTNER_TYPE"] == 20))
   {
	   $str .= "<td>".$arUser["UF_COMPANY_NAME"]."</td>";
   }
   elseif(($arUser["UF_PARTNER_TYPE"] == 21))
   {
	   $str .= "<td>".$arUser["UF_FIO"]."</td>";
   }
   else
	   $str .= "<td></td>";
   
   
   $str .= "<td>".$OKRUGS[$arUser["UF_OKRUG"]]."</td>";
   $str .= "<td>".trim(str_replace("\r", "", str_replace("\n", "", str_replace(";", "", $arUser["PERSONAL_NOTES"]))))."</td>";
   $str .= "<td>".count($orders[$arUser["ID"]])."</td>";
   $str .= "<td>".str_replace(".", ",", $summs[$arUser[ID]])."</td>";
   $str .= "<td>".implode(",", $orders[$arUser["ID"]])."</td>";
   $str .= "</tr>";
   //echo $str;
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

//fclose($f);






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