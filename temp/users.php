<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
//CModule::IncludeModule("sale");
//CModule::IncludeModule("catalog");
//CModule::IncludeModule("iblock"); 

/*
global $USER;
$arFilter = Array( "ID" => 1);
$arParam["SELECT"] = Array("UF_*");
$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
if($arUser = $rsUser->GetNext()) {
	prn($arUser);
	}
die();
*/

// Коды округов федеральных (http://shop.newvay.ru/bitrix/admin/userfield_edit.php?ID=45&lang=ru)
$OKRUGS = Array(
	10 => "Центральный Федеральный Округ",
	11 => "Южный Федеральный Округ",
	12 => "Северо-Западный Федеральный округ",
	13 => "Дальневосточный Федеральный Округ",
	14 => "Сибирский Федеральный Округ",
	15 => "Уральский Федеральный Округ",
	16 => "Приволжский Федеральный округ",
	17 => "Северо-Кавказский",
	18 => "Крымский"
	);
// Типы партнерства (http://shop.newvay.ru/bitrix/admin/userfield_edit.php?ID=46&lang=ru)
$PARTNER_TYPES = Array(
	19 => "ООО",
	20 => "ИП",
	21 => "Физ.лицо"
	);
$OKRUGS = array_flip($OKRUGS);
$PARTNER_TYPES = array_flip($PARTNER_TYPES);



$f=file("contragents.csv");
//prn($f);


$arSelect = Array("karapuz_arh@mail.ru");


$arUsers = Array();
//$arEmpty = Array();
foreach($f as $i => $row) 
{
	if($i == 0) continue;
	$t = explode(";", $row);
	//prn($t);
	//echo $t[37];
	
	$inn = trim($t[14]);
	
	$name = trim(str_replace('""', '"', str_replace('""', '"', $t[19])));
	$kpp = trim($t[18]) == "0" ? "" : trim($t[18]);
	$partner_type = $PARTNER_TYPES[trim($t[31])];
	$region = $OKRUGS[trim($t[32])];
	$email = str_replace('"', '', trim($t[36]));
	
	if(strpos(" ".$email, "[")>0) {
		$start = strpos(" ".$email, "[");
		$fin = strpos(" ".$email, "]", $start);
		$email = substr($email, $start, $fin-$start-1);
		}
	if(strpos(" ".$email, ",")>0) {
		$t1 = explode(",", $email);
		$email = trim($t1[0]);
		}
		
	if(!in_array($email, $arSelect)) continue;
	
	
	$city = trim($t[37]);
	//echo $t[36]."<br/>";
	//echo $inn."=".$city."<br/>";
	//$passport = trim($t[12]);
	if(trim(strtoupper($t[1])) == "ЮРИДИЧЕСКИЙ АДРЕС") $jur_address = trim($t[2]);
	if(trim(strtoupper($t[1])) == "ТЕЛЕФОН") $phone = trim($t[2]);
	//if(trim(strtoupper($t[1])) == "ФАКТИЧЕСКИЙ АДРЕС") $jur_adr = trim($t[2]);
	if(trim(strtoupper($t[1])) == "ПАСПОРТ") {
		//echo trim($t[2])."<br/>";
		/*if(strLen(trim($passport)) < 1) */$passport = trim($t[2]);
		}
	//echo $passport."<hr/>";
	
	
	if($partner_type == 21)  // физ
	{
		$arUsers[$inn]["UF_PARTNER_TYPE"] = $partner_type;
		$arUsers[$inn]["NAME"] = str_replace("Физ.лицо", "", $name);
		$arUsers[$inn]["UF_FIO"] = str_replace("Физ.лицо", "", $name);
		$arUsers[$inn]["UF_KPP"] = $kpp;
		$arUsers[$inn]["UF_OKRUG"] = $region;
		$arUsers[$inn]["EMAIL"] = $email;
		$arUsers[$inn]["LOGIN"] = $email;
		$arUsers[$inn]["PERSONAL_CITY"] = $city;
		$arUsers[$inn]["UF_CITY"] = $city;
		$arUsers[$inn]["UF_PASSPORT"] = $passport;
		$arUsers[$inn]["UF_ADDRESS"] = $jur_address;
		$arUsers[$inn]["UF_ADDRESS"] = $jur_address;
		$arUsers[$inn]["UF_FIZ_INN"] = $inn;
		$arUsers[$inn]["PERSONAL_PHONE"] = $phone;
		$arUsers[$inn]["UF_MAILING"] = 5;
		$arUsers[$inn]["GROUP_ID"] = Array(5,13);
		$arUsers[$inn]["GROUP_ID"][] = 12;
		$pass = randString(8);
		$arUsers[$inn]["PASSWORD"] = $pass;
		$arUsers[$inn]["CONFIRM_PASSWORD"] = $pass;
	}
	if(($partner_type == 19)||($partner_type == 20)) // ооо,ип
	{
		$arUsers[$inn]["UF_PARTNER_TYPE"] = $partner_type;
		$arUsers[$inn]["NAME"] = $name;
		$arUsers[$inn]["UF_COMPANY_NAME"] = $name;
		$arUsers[$inn]["UF_KPP"] = $kpp;
		$arUsers[$inn]["UF_OKRUG"] = $region;
		$arUsers[$inn]["EMAIL"] = $email;
		$arUsers[$inn]["LOGIN"] = $email;
		$arUsers[$inn]["PERSONAL_CITY"] = $city;
		$arUsers[$inn]["UF_CITY"] = $city;
		$arUsers[$inn]["UF_COMPANY_ADDRESS"] = $jur_address;
		$arUsers[$inn]["UF_INN"] = $inn;
		$arUsers[$inn]["PERSONAL_PHONE"] = $phone;
		$arUsers[$inn]["UF_MAILING"] = 5;
		$arUsers[$inn]["GROUP_ID"] = Array(5,13);
		$arUsers[$inn]["GROUP_ID"][] = 8;
		$pass = randString(8);
		$arUsers[$inn]["PASSWORD"] = $pass;
		$arUsers[$inn]["CONFIRM_PASSWORD"] = $pass;
	}	
	
	if(($inn == "0")||($inn == "")) 
	{
		//echo $inn." | ".$name."<hr/>";
		$arEmpty[] = $name."|".$email;
		continue;
	}
	
	
	

	$arUsers[$inn]["TYPE"] = "Физлицо";
	if(strpos(" ".trim($t[0]), "ИП")>0) $arUsers[$inn]["TYPE"] = "ИП";
	if((strpos(" ".trim($t[0]), "ООО")>0)||(strpos(" ".trim($t[0]), "Общество с ограниченной ответственностью")>0)) $arUsers[$inn]["TYPE"] = "ООО";
	$arUsers[$inn]["CITY"] = trim($t[6]);
	if(trim($t[1]) == "Адрес") $arUsers[$inn]["ADDRESS"] = trim($t[2]);
	if(trim($t[1]) == "Телефон") $arUsers[$inn]["PHONE"] = trim($t[2]);
	if(trim($t[1]) == "E-Mail") $arUsers[$inn]["EMAIL"] = trim($t[2]);
	$arUsers[$inn]["OKRUG"] = "неизвестен";
	$arUsers[$inn]["KPP"] = trim($t[5])=="0" ? "" : trim($t[5]);
	
}


/*
$arNewUsers = Array();
foreach($arUsers as $inn => $arUser) {
	if(trim($arUser["EMAIL"]) == "") continue;//echo $inn."<br/>";
	if(
		($inn == "772600840880")||
		($inn == "271101039743")||
		($inn == "330108764658")||
		($inn == "861700235433")||
		($inn == "100700005159")||
		($inn == "645317871103")
		) {
			$arNewUsers[$inn] = $arUser;
			$arNewUsers[$inn]["EMAIL"] = str_replace(" ", "", $arNewUsers[$inn]["EMAIL"]);
			$arNewUsers[$inn]["LOGIN"] = str_replace(" ", "", $arNewUsers[$inn]["LOGIN"]);
			$arNewUsers[$inn]["EMAIL"] = str_replace("(ШурупСветлана)", "", $arNewUsers[$inn]["EMAIL"]);
			$arNewUsers[$inn]["LOGIN"] = str_replace("(ШурупСветлана)", "", $arNewUsers[$inn]["LOGIN"]);
			}
	}
$arUsers = $arNewUsers;
*/
//prn($arUsers);


/*
$num = 0;
foreach($arUsers as $arUser) 
{
	$user = new CUser;
	$arFields = $arUser;

	$ID = $user->Add($arFields);
	if (intval($ID) > 0)
		echo $arUser["EMAIL"].";".$arUser["PASSWORD"]."<br/>";
	else
		echo $user->LAST_ERROR;
	
	$num++;
	//if($num>5) break;
}
*/



	
prn($arUsers);
//prn($arEmpty);



die();



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