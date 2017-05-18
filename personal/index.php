<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личные данные");
?>



<ul class="user_tab_nav">
	<li><a href="/personal/" class="active">Личные данные</a></li>
	<li><a href="/personal/orders/">Заказы</a></li>
	<!--<li><a href="/personal/orders.html?filter_history=Y">Заказы</a></li>-->
</ul>





<?
global $USER;
$arGroups = $USER->GetUserGroupArray();
$needle = Array(8, 9, 10, 11, 12);						// перечень скидочных групп пользователей
foreach($arGroups as $k => $v) {
	if(in_array($v, $needle)) {
		$rsGroup = CGroup::GetByID($v, "N");
		$arGroup = $rsGroup->Fetch();
		?>
		<p>Ваш текущий статус: <span class="dealer_status"><?=$arGroup["NAME"]?></span>
		<?if($arGroup["DESCRIPTION"]):?> <i>(<?=strtolower($arGroup["DESCRIPTION"])?>)</i><?endif?>
		</p>
		<?
		}
	}
?>



<?
//$arFields["EXT_DATA"] = "";
$arFilter = Array( "ID" => $USER->GetID());
$arParam["SELECT"] = Array("UF_PARTNER_TYPE");
$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
while($arUser = $rsUser->GetNext()) 
{
	$USER_PARTNER_TYPE = $arUser["UF_PARTNER_TYPE"];
}
?>




<?if($USER_PARTNER_TYPE == "19"):// for ooo?>

	<p>Тип предприятия: Общество с ограниченной ответственностью</p>
	<p><b>Регистрационные данные</b></p>
	<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	"cabinet", 
	array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_COMPANY_NAME",
			1 => "UF_COMPANY_ADDRESS",
			2 => "UF_INN",
			3 => "UF_KPP",
			4 => "UF_OGRN",
			5 => "UF_ASSORTIMENT",
			6 => "UF_CITY",
			7 => "UF_OKRUG",
			8 => "UF_MAILING",
			9 => "UF_DOC_USTAV",
			10 => "UF_DOC_GENDIR",
			11 => "UF_DOC_INN",
			12 => "UF_DOC_OGRN",
			13 => "UF_DOC_EGRN",
			14 => "UF_DOC_REKVIZITY",
		),
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => "Для ООО",
		"REQUIRED_USER_FIELDS" => array(
			0 => "UF_COMPANY_NAME",
			1 => "UF_COMPANY_ADDRESS",
			2 => "UF_INN",
			3 => "UF_KPP",
			4 => "UF_OGRN",
			5 => "UF_ASSORTIMENT",
			6 => "UF_CITY",
			7 => "UF_OKRUG",
		),
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "cabinet"
	),
	false
);?>
	
<?endif?>






<?if($USER_PARTNER_TYPE == "20"):// for ip?>
	
	<p>Тип предприятия: Индивидуальный предприниматель</p>
	<p><b>Регистрационные данные</b></p>
	<?$APPLICATION->IncludeComponent("bitrix:main.profile", "cabinet", array(
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"SET_TITLE" => "Y",
	"USER_PROPERTY" => array(
		0 => "UF_COMPANY_NAME",
		1 => "UF_COMPANY_ADDRESS",
		2 => "UF_INN",
		3 => "UF_OGRN",
		4 => "UF_ASSORTIMENT",
		5 => "UF_CITY",
		6 => "UF_OKRUG",
		7 => "UF_MAILING",
		8 => "UF_DOC_INN",
		9 => "UF_DOC_OGRN",
		10 => "UF_DOC_PASSPORT",
		11 => "UF_ASSORT",
		12 => "UF_COMMENT"
	),
	"SEND_INFO" => "N",
	"CHECK_RIGHTS" => "N",
	"USER_PROPERTY_NAME" => "Для ИП",
	"REQUIRED_USER_FIELDS" => array(
		0 => "UF_COMPANY_NAME",
		1 => "UF_COMPANY_ADDRESS",
		2 => "UF_INN",
		3 => "UF_OGRN",
		4 => "UF_ASSORTIMENT",
		5 => "UF_CITY",
		6 => "UF_OKRUG",
		7 => "UF_ASSORT",
	),
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
	
<?endif?>






<?if($USER_PARTNER_TYPE == "21"):// for fiz?>

	<p>Тип предприятия: Физическое лицо</p>
	<p><b>Регистрационные данные</b></p>
	<?$APPLICATION->IncludeComponent("bitrix:main.profile", "cabinet", array(
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"SET_TITLE" => "Y",
	"USER_PROPERTY" => array(
		0 => "UF_FIO",
		1 => "UF_ADDRESS",
		2 => "UF_PASSPORT",
		3 => "UF_FIZ_INN",
		4 => "UF_ASSORTIMENT",
		5 => "UF_CITY",
		6 => "UF_OKRUG",
		7 => "UF_MAILING",
		8 => "UF_DOC_INN",
		9 => "UF_DOC_OGRN",
		10 => "UF_DOC_PASSPORT",
		11 => "UF_COMMENT",
	),
	"SEND_INFO" => "N",
	"CHECK_RIGHTS" => "N",
	"USER_PROPERTY_NAME" => "Для ООО",
	"REQUIRED_USER_FIELDS" => array(
		0 => "UF_FIO",
		1 => "UF_ADDRESS",
		2 => "UF_PASSPORT",
		3 => "UF_FIZ_INN",
		4 => "UF_ASSORTIMENT",
		5 => "UF_CITY",
		6 => "UF_OKRUG",
	),
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
	
<?endif?>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
