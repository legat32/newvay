<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина покупок");
$APPLICATION->SetPageProperty("title","Корзина покупок");
?><?
$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "template2", array(
	"COLUMNS_LIST" => array(
		0 => "NAME",
		1 => "DISCOUNT",
		2 => "QUANTITY",
		3 => "DELETE",
		4 => "TYPE",
		5 => "PRICE",
		6 => "SUM",
	),
	"PATH_TO_ORDER" => "/order/",
	"HIDE_COUPON" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "Y",
	"USE_PREPAYMENT" => "N",
	"QUANTITY_FLOAT" => "N",
	"SET_TITLE" => "Y"
	),
	false
);?>

<?/*?>
<p>Для того, чтобы получить скидки или купить товар по оптовым ценам ознакомьтесь с условиями сотрудничества в <a href="/partneram/">разделе для партнеров</a>.</p>
<?*/?>

 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>