<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?><?$APPLICATION->IncludeComponent("bitrix:sale.personal.order.list", "list1", array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"CACHE_GROUPS" => "Y",
	"PATH_TO_DETAIL" => "",
	"PATH_TO_COPY" => "",
	"PATH_TO_CANCEL" => "",
	"PATH_TO_BASKET" => "",
	"ORDERS_PER_PAGE" => "20",
	"ID" => $ID,
	"SET_TITLE" => "Y",
	"SAVE_IN_SESSION" => "Y",
	"NAV_TEMPLATE" => "modern",
	"HISTORIC_STATUSES" => array(
		0 => "F",
	)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>