<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
//CModule::IncludeModule("sale");
//CModule::IncludeModule("catalog");
//CModule::IncludeModule("iblock"); 
$f=file("ready_colors.csv");
//prn($f);

$arOttenki = Array();
$arOttenkiList = Array();
foreach($f as $i => $row) 
{
	$t = explode(";", $row);
	if(trim($t[2]) == "") continue;
	
	$tt = explode(",", $t[2]);
	foreach($tt as $ttt) 
	{
		$arOttenki[trim($t[1])][] = trim($ttt);
		$arOttenkiList[trim($ttt)] = 1;
	}
	
	//echo $t[1]."<br/>";
	
}


foreach($arOttenki as $kod => $colors)
{
	foreach($colors as $color) 
	{
		echo $kod.";".$kod.";".$color."<br/>";
	}
};


//prn($arOttenki);


/*
$arUsers = Array();
foreach($f as $i => $row) 
{
	if($i == 0) continue;
	$t = explode(";", $row);
	$inn = trim($t[4]);
	$arUsers[$inn]["NAME"] = trim($t[0]);
	$arUsers[$inn]["TYPE"] = "Физлицо";
	if(strpos(" ".trim($t[0]), "ИП")>0) $arUsers[$inn]["TYPE"] = "ИП";
	if((strpos(" ".trim($t[0]), "ООО")>0)||(strpos(" ".trim($t[0]), "Общество с ограниченной ответственностью")>0)) $arUsers[$inn]["TYPE"] = "ООО";
	$arUsers[$inn]["CITY"] = trim($t[6]);
	if(trim($t[1]) == "Адрес") $arUsers[$inn]["ADDRESS"] = trim($t[2]);
	if(trim($t[1]) == "Телефон") $arUsers[$inn]["PHONE"] = trim($t[2]);
	if(trim($t[1]) == "E-Mail") $arUsers[$inn]["EMAIL"] = trim($t[2]);
	$arUsers[$inn]["OKRUG"] = "неизвестен";
	$arUsers[$inn]["KPP"] = trim($t[5])=="0" ? "" : trim($t[5]);
	//echo $row."<br/>";
}
//prn($arUsers);
//prn($f);

$user = new CUser;
$arFields = Array(
  //"NAME"              => "Сергей", 
  //"LAST_NAME"         => "Иванов",
  "EMAIL"             => "turtell@ya.ru",
  "LOGIN"             => "turtell@ya.ru",
  //"LID"               => "ru",
  //"ACTIVE"            => "Y",
  "GROUP_ID"          => array(5,8,13),
  "PASSWORD"          => "123456",
  "CONFIRM_PASSWORD"  => "123456",
  "UF_CITY"    => "Ибердус",
  "UF_OKRUG"    => 10,
  "UF_PARTNER_TYPE"		=> 20,
  "UF_INN" => "1222123123231"
);

$ID = $user->Add($arFields);
if (intval($ID) > 0)
    echo "Пользователь успешно добавлен.";
else
    echo $user->LAST_ERROR;
*/

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>