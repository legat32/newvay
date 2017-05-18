<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
LocalRedirect("/reg/ooo.html");
?>

<?$APPLICATION->IncludeComponent("bitrix:main.register", "template2", array(
	"SHOW_FIELDS" => array(
		0 => "NAME",
		1 => "SECOND_NAME",
		2 => "LAST_NAME",
		3 => "PERSONAL_CITY",
	),
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "LAST_NAME",
		2 => "PERSONAL_CITY",
	),
	"AUTH" => "Y",
	"USE_BACKURL" => "Y",
	"SUCCESS_PAGE" => "",
	"SET_TITLE" => "Y",
	"USER_PROPERTY" => array(
		0 => "UF_MAILING",
	),
	"USER_PROPERTY_NAME" => " "
	),
	false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>