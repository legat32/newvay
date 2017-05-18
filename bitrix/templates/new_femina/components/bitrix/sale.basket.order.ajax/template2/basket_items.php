<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//prn($arResult)?>

<div class="cart-items" id="id-cart-list">
	<!--
	<div class="inline-filter cart-filter">
		<label><?=GetMessage("SALE_PRD_IN_BASKET")?></label>&nbsp;
		<b><?=GetMessage("SALE_PRD_IN_BASKET_ACT")?></b>&nbsp;
		<a href="javascript:void(0);" onclick="ShowBasketItems(2);"><?=GetMessage("SALE_PRD_IN_BASKET_SHELVE")?> (<?=count($arResult["ITEMS"]["DelDelCanBuy"])?>)</a>
		<a href="javascript:void(0);" onclick="ShowBasketItems(4);"><?=GetMessage("SALE_NOACTIVE")?> (<?=count($arResult["ITEMS"]["nAnCanBuy"])?>)</a>
		<a href="javascript:void(0);" onclick="ShowBasketItems(3);"><?=GetMessage("SALE_BASKET_NOTIFY")?> (<?=count($arResult["ITEMS"]["AnSubscribe"])?>)</a>
	</div>
	-->
	
	<?if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0):?>
		<table border="0" class="cart-items" cellspacing="0">
		<thead>
			<tr bgcolor="#EEEEEE">
				<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-name"><?= GetMessage("SALE_NAME")?></td>
				<?endif;?>
				<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-weight"><?= GetMessage("SALE_WEIGHT")?></td>
				<?endif;?>
				<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-quantity"><?= GetMessage("SALE_QUANTITY")?></td>
				<?endif;?>
				<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-discount"><?= GetMessage("SALE_DISCOUNT")?></td>
				<?endif;?>	
				<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-type"><?= GetMessage("SALE_PRICE_TYPE")?></td>
				<?endif;?>
				<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-price"><?= GetMessage("SALE_PRICE")?></td>
				<?endif;?>
					
				<td class="cart-item-actions">
					<?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
						<?=GetMessage("SALE_ACTION")?>
					<?endif;?>
				</td>
			</tr>
		</thead>
		<tbody>
		<?
		$i=0;
		foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
		{
			?>
			<tr>
				<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-name"><?
					if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
						?><a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>"><?
					endif;
					?><b><?=$arBasketItems["NAME"] ?></b><?
					if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):
						?></a><?
					endif;?>
					<?if (in_array("PROPS", $arParams["COLUMNS_LIST"]))
					{
						foreach($arBasketItems["PROPS"] as $val)
						{
							echo "<br />".$val["NAME"].": ".$val["VALUE"];
						}
					}?>
					</td>
				<?endif;?>

				<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-weight"><?=$arBasketItems["WEIGHT_FORMATED"]?></td>
				<?endif;?>
				<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-quantity"><input maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3"></td>
				<?endif;?>
				<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-discount"><?=$arBasketItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></td>
				<?endif;?>
				<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-type"><?=$arBasketItems["NOTES"]?></td>
				<?endif;?>
				<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
				<?endif;?>
				<td align="center" valign="middle" class="cart-item-actions">
					<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
						<a href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["delete"])?>" title="<?=GetMessage("SALE_DELETE_PRD")?>"></a><br>
					<?endif;?>
					<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
						<a href="<?=str_replace("#ID#", $arBasketItems["ID"], $arUrlTempl["shelve"])?>"><?=GetMessage("SALE_OTLOG")?></a>
					<?endif;?>
				</td>
			</tr>
			<?
			$i++;
		}
		?>
		</tbody>
		<tfoot>
			<?if($arResult["SKIDKA_BASKET"]>0):?>
			<tr>
				<td style="border-bottom:none;" colspan="2" align="right">Сумма заказа</td>
				<td style="border-bottom:none;"  align="right"><?=currencyFormat($arResult["TOTAL_ORDER_PRICE"], "RUB")?></td>
				<td style="border-bottom:none;"></td>
			</tr>
			<tr>
				<td colspan="2" align="right">Скидка</td>
				<td align="right"><?=$arResult["SKIDKA_BASKET"]?>%</td>
				<td></td>
			</tr>
			<?endif?>
			<tr>
				<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
					<td colspan="2" class="cart-item-itog" valign="bottom" style="border-bottom:none;" >
						<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
							<p><?echo GetMessage("SALE_ALL_WEIGHT")?>:</p>
						<?endif;?>
						<?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
						{
							?><p><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
							if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
								echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:</p><?
						}?>
						<?if ($arParams['PRICE_TAX_SHOW_VALUE'] == 'Y'):?>
							<p><?echo GetMessage('SALE_TAX_INCLUDED')?></p>
						<?endif;?>	
						<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
							<p><?echo GetMessage('SALE_VAT_INCLUDED')?></p>
						<?endif;?>
						<p><b><?= GetMessage("SALE_ITOGO")?>:</b></p>
					</td>
				<?endif;?>
					

				<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
					<td class="cart-item-price" valign="bottom" style="border-bottom:none;" >
						<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
							<p><?=$arResult["ORDER_WEIGHT_FORMATED"]?></p>
						<?endif;?>
						<?if (doubleval($arResult["DISCOUNT_PRICE"]) > 0):?>
							<p><?=$arResult["DISCOUNT_PRICE_FORMATED"]?></p>
						<?endif;?>
						<?if ($arParams['PRICE_TAX_SHOW_VALUE'] == 'Y'):?>
							<p><?=$arResult["TAX_VALUE_FORMATED"]?></p>
						<?endif;?>	
						<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
							<p><?=$arResult["VAT_SUM_FORMATED"]?></p>
						<?endif;?>
						<p><b><?=$arResult["PRICE_FORMATED"]?></b></p>
					</td>
				<?endif;?>
				<?if (in_array("DELETE", $arParams["COLUMNS_LIST"]) || in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
					<td style="border-bottom:none;"  class="cart-item-actions">&nbsp;</td>
				<?endif;?>
			</tr>
		</tfoot>
		</table>

		<div class="cart-ordering">
			<?if ($arParams["HIDE_COUPON"] != "Y"):?>
				<div class="cart-code">
					<input value="<?=$arResult["COUPON"]?>" name="COUPON" >
					<div><small><?=GetMessage("SALE_COUPON_VAL")?></small></div>
				</div>
			<?endif;?>
			<div class="cart-buttons">
				<input class="btn" type="submit" value="<?=GetMessage("SALE_UPDATE")?>" name="BasketRefresh" onClick="submitForm();">
				<input class="btn" type="button" value="<?=GetMessage("SALE_TAKE_ORDER")?>" name="BasketOrder" onClick="ShowOrder();">
			</div>
		</div>
	<?else:
		echo ShowNote(GetMessage("SALE_NO_ACTIVE_PRD"));
	endif;?>	
</div>


<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => "/include/skidki_k_korzine.php",
		"EDIT_TEMPLATE" => ""
	),
	false
	);
?>
