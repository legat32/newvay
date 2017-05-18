<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация для ООО");
?> 
 
<ul class="tab_nav">
	<li><a class="active" href="/reg/ooo.html">Для организации (оптовые цены)</a></li>
	<li><a href="/reg/ip.html">Для ИП (оптовые цены)</a></li>
	<li><a href="/reg/fiz.html">Для Физ.лиц. (оптовые цены для физ.лиц)</a></li>
</ul>

 <?/*?>
<p style="font-weight:bold; font-size:16px; padding:40px 10px; text-align:center; line-height:20px;">В связи с техническим работами на сайте, регистрация, добавление в корзину и оформление заказов временно отключено<br>Данные функции будут доступны с 00:00 понедельника 27.02.2017 г.<br>Приносим извинения за временные неудобства</p>
<?*/?>

 

 
 <?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"jur",
	Array(
		"SHOW_FIELDS" => array(0=>"NAME",1=>"SECOND_NAME",2=>"LAST_NAME",3=>"PERSONAL_PHONE",4=>"PERSONAL_NOTES",),
		"REQUIRED_FIELDS" => array(0=>"NAME",1=>"PERSONAL_PHONE",),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array(0=>"UF_COMPANY_NAME",1=>"UF_COMPANY_ADDRESS",2=>"UF_INN",3=>"UF_KPP",4=>"UF_OGRN",5=>"UF_ASSORTIMENT",6=>"UF_CITY",7=>"UF_OKRUG",8=>"UF_MAILING",),
		"USER_PROPERTY_NAME" => " ",
		"REQUIRED_USER_FIELDS" => array(0=>"UF_COMPANY_NAME",1=>"UF_COMPANY_ADDRESS",2=>"UF_INN",3=>"UF_KPP",4=>"UF_OGRN",5=>"UF_ASSORTIMENT",6=>"UF_CITY",7=>"UF_OKRUG",)
	)
);?> 




<?/*
$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"jur",
	Array(
		"USER_PROPERTY_NAME" => " ",
		"SHOW_FIELDS" => array("NAME", "SECOND_NAME", "LAST_NAME"),
		"REQUIRED_FIELDS" => array("NAME", "LAST_NAME", "PERSONAL_CITY"),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => array("UF_COMPANY_NAME", "UF_COMPANY_ADDRESS", "UF_INN", "UF_OGRN", "UF_COMPANY_PHONE", "UF_COMPANY_DOC")
	)
);
*/
?> <hr/> 

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>