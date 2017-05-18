<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация для физ.лица");
?> 

<ul class="tab_nav">
	<li><a href="/reg/ooo.html">Для организации (оптовые цены)</a></li>
	<li><a href="/reg/ip.html">Для ИП (оптовые цены)</a></li>
	<li><a class="active" href="/reg/fiz.html">Для Физ.лиц. (оптовые цены для физ.лиц)</a></li>
</ul>

<?/*?>
<p style="font-weight:bold; font-size:16px; padding:40px 10px; text-align:center; line-height:20px;">В связи с техническим работами на сайте, регистрация, добавление в корзину и оформление заказов временно отключено<br>Данные функции будут доступны с 00:00 понедельника 27.02.2017 г.<br>Приносим извинения за временные неудобства</p>
<?*/?>


<?$APPLICATION->IncludeComponent("bitrix:main.register", "jur", array(
	"SHOW_FIELDS" => array(
		0 => "NAME",
		1 => "SECOND_NAME",
		2 => "LAST_NAME",
		3 => "PERSONAL_PHONE",
		4 => "PERSONAL_NOTES",
	),
	"REQUIRED_FIELDS" => array(
		0 => "NAME",
		1 => "PERSONAL_PHONE",
	),
	"AUTH" => "Y",
	"USE_BACKURL" => "Y",
	"SUCCESS_PAGE" => "",
	"SET_TITLE" => "N",
	"USER_PROPERTY" => array(
		0 => "UF_FIO",
		1 => "UF_ADDRESS",
		2 => "UF_PASSPORT",
		3 => "UF_FIZ_INN",
		4 => "UF_ASSORTIMENT",
		5 => "UF_CITY",
		6 => "UF_OKRUG",
		7 => "UF_MAILING",
	),
	"USER_PROPERTY_NAME" => " ",
	"REQUIRED_USER_FIELDS" => array(
		0 => "UF_FIO",
		1 => "UF_ADDRESS",
		2 => "UF_PASSPORT",
		3 => "UF_INN",
		4 => "UF_ASSORTIMENT",
		5 => "UF_CITY",
		6 => "UF_OKRUG",
	)
	),
	false
);?>


<hr/>
<p>Условия сотрудничества Вы можете <a href="/partneram/">посмотреть тут</a></p>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>