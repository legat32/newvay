<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
//CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
//CModule::IncludeModule("iblock"); 
//$f=file("agents.csv");
//prn($f);



$ID = 142654;
$QUANTITY = 5;
$res = Add2BasketByProductID($ID, $QUANTITY, Array(
	Array("NAME" => "Цвет", "CODE" => "COLOR", "VALUE" => "13-181 терракот"),
	Array("NAME" => "Размер", "CODE" => "SIZE", "VALUE" => "52")
	));
if($res) echo $res;
else "NO";


/*
$dbUser = CUser::GetByID(1); 
$arUser = $dbUser->GetNext();
prn($arUser);
die();
*/

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
*/
/*
$user = new CUser;
$arFields = Array(
  //"NAME"              => "Сергей", 
  //"LAST_NAME"         => "Иванов",
  "UF_COMPANY_NAME"	=> "ИП Сидоров Петр Иванович",
  "EMAIL"             => "korshakl@mail.ru",
  "LOGIN"             => "korshakl@mail.ru",
  //"LID"               => "ru",
  //"ACTIVE"            => "Y",
  "GROUP_ID"          => array(5,8),
  "PASSWORD"          => "123456",
  "CONFIRM_PASSWORD"  => "123456",
  "UF_CITY"    => "Омск",
  "UF_OKRUG"    => 14,
  "UF_PARTNER_TYPE"		=> 20,
  "UF_INN" => "444444444444",
  "PERSONAL_PHONE" => "112"
);

$ID = $user->Add($arFields);
if (intval($ID) > 0)
    echo "Пользователь успешно добавлен.";
else
    echo $user->LAST_ERROR;

*/
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>