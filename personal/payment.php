<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата заказа");
?>

<?if($USER->isAuthorized()):?>


	<?
	if(CModule::IncludeModule("sale")) {
		$to_pay = false; 
		
		$ORDER_ID = intVal($_REQUEST["ORDER_ID"]);
		$arOrder = CSaleOrder::GetByID($ORDER_ID);
		if( (is_array($arOrder)) && ($arOrder["STATUS_ID"]!="N") ) $to_pay = true;
		//echo $to_pay;
		//prn($arOrder);
		}
	?>


	<? if($to_pay):?>
	
		<?$APPLICATION->IncludeComponent(
			"bitrix:sale.order.payment",
			"",
			Array(
			),
		false
		);?> 
		
	<?else:?>
		
		<div class="not_pay" style="position: absolute; text-align:center; left:50%; top:50%; margin-left: -150px; margin-top: -100px; padding:20px; width:300px; height:200px; border:4px red solid;" >
			<p style="font-weight:bold;">Оплатить заказ можно только после подтверждения менеджером.</p><br/>
			<p>Телефоны: (495) 888-99-00</p>
			<p>Время работы: 9-18 по будням</p><br/>
			<p>При разговоре с менеджером будьте готовы назвать Вашу компанию, город и номер заказа.</p>
		</div>
		
	<?endif?>

<?endif?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>