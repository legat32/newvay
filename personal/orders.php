<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?> 


<ul class="tab_nav">
	<li><a href="/personal/">Личные данные</a></li>
	<li><a class="active">Заказы</a></li>
</ul>


<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "template2", array(
	"PROP_2" => array(
	),
	"PROP_1" => array(
	),
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"ORDERS_PER_PAGE" => "20",
	"PATH_TO_PAYMENT" => "payment.php",
	"PATH_TO_BASKET" => "/basket/",
	"SET_TITLE" => "Y",
	"SAVE_IN_SESSION" => "Y",
	"NAV_TEMPLATE" => "",
	"CUSTOM_SELECT_PROPS" => array(
	),
	"HISTORIC_STATUSES" => array(
	)
	),
	false
);?>


<?/*$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "template2", array(
	"PROP_1" => array(
	),
	"PROP_2" => array(
	),
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/",
	"ORDERS_PER_PAGE" => "20",
	"PATH_TO_PAYMENT" => "/personal/payment.php",
	"PATH_TO_BASKET" => "/order.php",
	"SET_TITLE" => "Y",
	"SAVE_IN_SESSION" => "Y",
	"NAV_TEMPLATE" => ""
	),
	false
);*/?>
<br/><br/>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>