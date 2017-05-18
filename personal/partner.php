<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сотрудничество");
?> 


<ul class="tab_nav">
	<li><a href="/personal/">Личные данные</a></li>
	<li><a href="/personal/orders.html?filter_history=Y">Заказы</a></li>
	<li><a href="/personal/support.html">Обращения</a></li>
	<li><a class="active">Сотрудничество</a></li>
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
		<?if($arGroup["DESCRIPTION"]):?><br/><i><?=$arGroup["DESCRIPTION"]?></i><?endif?>
		</p>
		<?
		}
	}
?>



<table><tr><td><h1 style="margin:0 15px 0 0;">Оптовые покупки</h1></td><td align="left"></td></tr></table>
<?$APPLICATION->IncludeComponent("bitrix:main.profile", "profile_for_dealers", array(
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
		4 => "UF_KOR_SCHET",
		5 => "UF_R_SCHET",
		6 => "UF_COMPANY_PHONE",
		7 => "UF_FAX",
		8 => "UF_COMPANY_DOC",
		9 => "UF_OGRN",
	),
	"SEND_INFO" => "N",
	"CHECK_RIGHTS" => "N",
	"USER_PROPERTY_NAME" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>



<table><tr><td><h1 style="margin:0 15px 0 0;">Данные физических лиц</h1></td><td align="left"></td></tr></table>
<?$APPLICATION->IncludeComponent("bitrix:main.profile", "profile_for_joint", array(
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"SET_TITLE" => "Y",
	"USER_PROPERTY" => array(
		0 => "UF_PASSPORT",
		1 => "UF_FIZ_INN",
		2 => "UF_DOC",
	),
	"SEND_INFO" => "N",
	"CHECK_RIGHTS" => "N",
	"USER_PROPERTY_NAME" => "",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>