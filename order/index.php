<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
$APPLICATION->SetPageProperty("title","Оформление заказа");
?>



<?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "visual6", Array(
	"PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета
	"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета только в полном объеме
	"COUNT_DELIVERY_TAX" => "N",	// Рассчитывать налог для доставки
	"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",	// Рассчитывать скидку для каждой позиции (на все количество товара)
	"ALLOW_AUTO_REGISTER" => "Y",	// Оформлять заказ с автоматической регистрацией пользователя
	"SEND_NEW_USER_NOTIFY" => "Y",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
	"DELIVERY_NO_AJAX" => "N",	// Рассчитывать стоимость доставки сразу
	"DELIVERY_NO_SESSION" => "N",	// Проверять сессию при оформлении заказа
	"TEMPLATE_LOCATION" => "popup",	// Шаблон местоположения
	"DELIVERY_TO_PAYSYSTEM" => "d2p",	// Последовательность оформления
	"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
	"PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
	"PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
	"PATH_TO_BASKET" => "/basket/",	// Страница корзины
	"PATH_TO_PERSONAL" => "/personal/",	// Страница персонального раздела
	"PATH_TO_PAYMENT" => "/personal/payment.php",	// Страница подключения платежной системы
	"PATH_TO_AUTH" => "/auth/",	// Страница авторизации
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"PRODUCT_COLUMNS" => "",	// Дополнительные колонки таблицы товаров заказа
	"DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице, если корзина пуста
	"DISPLAY_IMG_WIDTH" => "90",	// Ширина картинки товара
	"DISPLAY_IMG_HEIGHT" => "90",	// Высота картинки товара
	),
	false
);?>




	<?/*?>
	<p style="font-weight:bold; font-size:16px; padding:40px 10px; text-align:center; line-height:20px;">В связи с техническим работами на сайте, регистрация, добавление в корзину и оформление заказов временно отключено<br>Данные функции будут доступны с 00:00 понедельника 27.02.2017 г.<br>Приносим извинения за временные неудобства</p>
	<?/*?>
	
		<?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "visual6", Array(
			"PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета
			"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета только в полном объеме
			"COUNT_DELIVERY_TAX" => "N",	// Рассчитывать налог для доставки
			"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",	// Рассчитывать скидку для каждой позиции (на все количество товара)
			"ALLOW_AUTO_REGISTER" => "Y",	// Оформлять заказ с автоматической регистрацией пользователя
			"SEND_NEW_USER_NOTIFY" => "Y",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
			"DELIVERY_NO_AJAX" => "N",	// Рассчитывать стоимость доставки сразу
			"DELIVERY_NO_SESSION" => "N",	// Проверять сессию при оформлении заказа
			"TEMPLATE_LOCATION" => "popup",	// Шаблон местоположения
			"DELIVERY_TO_PAYSYSTEM" => "d2p",	// Последовательность оформления
			"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
			"PROP_1" => "",	// Не показывать свойства для типа плательщика "Физическое лицо" (s1)
			"PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
			"PATH_TO_BASKET" => "/basket/",	// Страница корзины
			"PATH_TO_PERSONAL" => "/personal/",	// Страница персонального раздела
			"PATH_TO_PAYMENT" => "/personal/payment.php",	// Страница подключения платежной системы
			"PATH_TO_AUTH" => "/auth/",	// Страница авторизации
			"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
			"PRODUCT_COLUMNS" => "",	// Дополнительные колонки таблицы товаров заказа
			"DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице, если корзина пуста
			"DISPLAY_IMG_WIDTH" => "90",	// Ширина картинки товара
			"DISPLAY_IMG_HEIGHT" => "90",	// Высота картинки товара
			),
			false
		);?>
	<?*/?>
	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>