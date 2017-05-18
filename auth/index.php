<?
//define("NEED_AUTH", true); 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if ( ($USER->isAuthorized()) && isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Авторизация");
?>

<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "template2", Array(
	"REGISTER_URL" => "/reg/",	// Страница регистрации
	"FORGOT_PASSWORD_URL" => "/personal/?forgot_password=yes",	// Страница забытого пароля
	"PROFILE_URL" => "/personal/",	// Страница профиля
	"SHOW_ERRORS" => "Y",	// Показывать ошибки
	),
	false
);?>


<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>