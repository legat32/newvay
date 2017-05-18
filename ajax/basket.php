<? include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?header('Access-Control-Allow-Origin: *');?>
<?
/*
if($USER->isAdmin()):
	echo "<center>";
	echo "<p>В связи с техническим работами на сайте, добавление в корзину и оформление заказов временно отключено<br>Данные функции будут доступны с 00:00 понедельника 27.02.2017 г.<br>Приносим извинения за временные неудобства</p>";
	echo "</center>";
	die();
endif
*/
?>


<?
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
CModule::IncludeModule("iblock");
?>



<?if($_GET["cmd"]=="buy"):?>
		
		<?/*?>
		<center>
		<p>В связи с техническим работами на сайте, добавление в корзину и оформление заказов временно отключено<br>Данные функции будут доступны с 00:00 понедельника 27.02.2017 г.<br>Приносим извинения за временные неудобства</p>
		</center>
		<?*/?>
		
		
		
		<style>
		.btn_cont_added:hover, .btn_order_added:hover {color:#FFFFFF; background-color:#A8305E; text-decoration: none; cursor:pointer;}
		</style>
		
		<script type="text/javascript" src="/bitrix/js/main/jquery/jquery-1.8.3.min.js"></script>
		
		<?
		$ID = intVal($_GET["id"]);
		$QUANTITY = intVal($_GET["quantity"]);
		//echo $ID;
		//pra($ID);
		$dbProduct = CIBlockElement::GetList(Array(), Array("ID"=>$ID), false, false, Array("ID", "IBLOCK_ID", "NAME", "XML_ID", "PROPERTY_CML2_LINK.DETAIL_PICTURE", "PROPERTY_COLOR", "PROPERTY_SIZE"));
		$arProduct = $dbProduct->GetNext();
		
		//prn($ID);
		//prn($QUANTITY);
		//prn($arProduct);
		
		$res = Add2BasketByProductID($ID, $QUANTITY, Array(
							Array("NAME" => "Цвет", "CODE" => "COLOR", "VALUE" => $arProduct["PROPERTY_COLOR_VALUE"]),
							Array("NAME" => "Размер", "CODE" => "SIZE", "VALUE" => $arProduct["PROPERTY_SIZE_VALUE"])
							));
		if($res>0) {
			$arRes = CSaleBasket::GetByID($res);
			//$dbProduct = CIBlockElement::GetList(Array(), Array("ID"=>$arRes["PRODUCT_ID"]), false, false, Array("ID", "NAME", "XML_ID", "PROPERTY_CML2_LINK.DETAIL_PICTURE"));
			//$arProduct = $dbProduct->GetNext();
			$img = CFile::ResizeImageGet($arProduct["PROPERTY_CML2_LINK_DETAIL_PICTURE"], array('width'=>100, 'height'=>150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			?>
			<p class="pr_added" style="display:block; font: bold 20px/20px 'PT Sans', sans-serif; color:#7D7FB4; font-style: italic; margin-bottom:10px;">Товар добавлен в корзину</p>
			<img class="img_added" width="<?=$img["width"]?>" height="<?=$img["height"]?>" src="<?=$img["src"]?>" style="display:block; float:left; font: 14px/14px bold 'PT Sans', sans-serif; color:#007EC5; font-style: italic; margin-right:20px;">
			<p class="name_added" style="display:block; font: 16px/16px bold 'PT Sans', sans-serif; color:#333333; font-style: italic;"><?=$arProduct["NAME"]?></p>
			<p class="price_added" style="display:block; font: 22px/22px bold 'PT Sans', sans-serif; color:#FF6600; font-style: italic; margin:10px 0;"><?=$arRes["PRICE"]?> руб.</p>
			<p class="quantity_added" style="margin:10px 0;">в количестве <?=intVal($_GET["quantity"])?> шт.</p>
			<a class="btn_cont_added" style="display:block; float:left; text-decoration: none; width:145px; height:15px; text-align:center; margin:3px; padding:5px; font: 12px/14px bold Arial, sans-serif; color: #FFF; background-color:#7C2B4A" href="" onclick="parent.$.fancybox.close(); return false;">Продолжить покупки</a>
			<a target="_top" class="btn_order_added" href="/basket/" style="display:block; float:left; text-decoration: none; width:145px; height:15px; text-align:center; margin:3px; padding:5px; font: 12px/14px bold Arial, sans-serif; color: #FFF; background-color:#7C2B4A">Оформить заказ</a>
			<?
			}
			else 
			{
			echo "Не добавлено";
			}
		?>
		
	
<?endif?>


<?if($_GET["cmd"]=="refresh"):?>
	<span class="korz">
	<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.small", "topright", array(
		"PATH_TO_BASKET" => "/basket/",
		"PATH_TO_ORDER" => "/order/",
		"SHOW_DELAY" => "Y",
		"SHOW_NOTAVAIL" => "Y",
		"SHOW_SUBSCRIBE" => "Y"
		),
		false
	);?>
	</span>
<?endif?>

<? //include($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>