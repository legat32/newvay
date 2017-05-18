<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?><ul class="user_tab_nav">
	<li><a href="/personal/">Личные данные</a></li>
	<li><a href="/personal/orders/" class="active">Заказы</a></li>
	 <!--<li><a href="/personal/orders.html?filter_history=Y">Заказы</a></li>-->
</ul>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order", 
	"", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CUSTOM_SELECT_PROPS" => array(
		),
		"HISTORIC_STATUSES" => array(
			0 => "F",
		),
		"NAV_TEMPLATE" => "",
		"ORDERS_PER_PAGE" => "20",
		"PATH_TO_BASKET" => "/basket/",
		"PATH_TO_PAYMENT" => "payment.php",
		"PROP_1" => array(
		),
		"PROP_2" => array(
		),
		"SAVE_IN_SESSION" => "Y",
		"SEF_FOLDER" => "/personal/orders/",
		"SEF_MODE" => "Y",
		"SET_TITLE" => "Y",
		"STATUS_COLOR_F" => "gray",
		"STATUS_COLOR_M" => "gray",
		"STATUS_COLOR_N" => "green",
		"STATUS_COLOR_P" => "yellow",
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",
		"COMPONENT_TEMPLATE" => ".default",
		"SEF_URL_TEMPLATES" => array(
			"list" => "index.php",
			"detail" => "#ID#/",
			"cancel" => "#ID#/cancel/",
		)
	),
	false
);?>
<br/><br/><br/><br/>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>