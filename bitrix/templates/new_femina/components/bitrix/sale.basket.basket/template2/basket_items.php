<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
echo ShowError($arResult["ERROR_MESSAGE"]);
?>

<?
// довыберем необходимые данные
/*
if(count($arResult["ITEMS"]["AnDelCanBuy"]) > 0)
{
	$arrOffers = Array();
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $kItem => $arItem) $arrOffers[$arItem["PRODUCT_ID"]] = 1;
	//prn($arrOffers);

	$arrID = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ID" => array_keys($arrOffers)), false, false, Array("ID", "PROPERTY_CML2_LINK"));
	while($arRes = $dbRes->GetNext()) 
	{
		$arrOffers[$arRes["ID"]] = $arRes["PROPERTY_CML2_LINK_VALUE"];
		$arrID[] = $arRes["PROPERTY_CML2_LINK_VALUE"];	
	}
	//prn($arrOffers);
	
	$arInfo = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ID" => $arrID), false, false, Array("ID", "NAME", "DETAIL_PAGE_URL"));
	while($arRes = $dbRes->GetNext())
	{
		$arInfo[$arRes["ID"]] = $arRes;
		foreach($arrOffers as $kOffer => $arOffer)
		{
			if($arOffer == $arRes["ID"]) $arrOffers[$kOffer] = $arRes;
		}
	}
	//prn($arrOffers);
	prn($arInfo);
}
*/
unset($arParams["COLUMNS_LIST"][4]);  // тип цены убрали
//prn($arParams["COLUMNS_LIST"]);
?>

<p class="basket-section">Готовые к покупке:</p>
<table class="sale_basket_basket data-table">
	<tr>
			<th class="product-img">Фото</th>
		<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_NAME")?></th>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PROPS")?></th>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PRICE")?></th>
		<?endif;?>
		<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_PRICE_TYPE")?></th>
		<?endif;?>
		<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_DISCOUNT")?></th>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_QUANTITY")?></th>
		<?endif;?>
		<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
			<th class="product-delete"><?= GetMessage("SALE_DELETE")?></th>
		<?endif;?>
		<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_OTLOG")?></th>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<th><?= GetMessage("SALE_WEIGHT")?></th>
		<?endif;?>
	</tr>
	<?
	$i=0;
	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $arBasketItems)
	{
		?>
		<tr>
			<td class="product-img">
				<?//prn($arBasketItems);?>
				<?if(is_array($arBasketItems["PREVIEW_PICTURE"])):?>
					<div class="item_img">
						<a href="<?=$arResult["EXTRA"][$arBasketItems["PRODUCT_ID"]]["DETAIL_PAGE_URL"]?>">
							<img width="<?=$arBasketItems["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arBasketItems["PREVIEW_PICTURE"]["HEIGHT"]?>" src="<?=$arBasketItems["PREVIEW_PICTURE"]["SRC"]?>">
						</a>
					</div>
				<?else:?>
					<a href="<?=$arResult["EXTRA"][$arBasketItems["PRODUCT_ID"]]["DETAIL_PAGE_URL"]?>"><div class="item_img_blank"></div></a>
				<?endif?>
			</td>
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="product-name">
				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):?>
					<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
					<?endif;?>
						<a href="<?=$arResult["EXTRA"][$arBasketItems["PRODUCT_ID"]]["DETAIL_PAGE_URL"]?>" class="name">
							<?=$arResult["EXTRA"][$arBasketItems["PRODUCT_ID"]]["NAME"]?><?/*?>(<?=$arBasketItems["PRODUCT_XML_ID"]?>)<?*/?>
						</a>
						<br>
						<span class="size-color">
							Цвет: <?=$arBasketItems["NEW_PROPS"]["COLOR"]?><br>
							Размер: <?=$arBasketItems["NEW_PROPS"]["SIZE"]?>
						</span>
							<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):?>
						</a>
						<?endif;?>
				</td>
				<?endif;?>
			<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
				<td>
				<?
				foreach($arBasketItems["PROPS"] as $val)
				{
					echo $val["NAME"].": ".$val["VALUE"]."<br />";
				}
				?>
				</td>
			<?endif;?>
			<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
				<td class="product-price">
				<div class="price"><?=$arBasketItems["PRICE_FORMATED"]?></div>
				<?if(doubleval($arBasketItems["DISCOUNT_PRICE"]) > 0):?>
					<div class="old_price">
						<s><?=SaleFormatCurrency($arBasketItems["PRICE"] + $arBasketItems["DISCOUNT_PRICE"], $arBasketItems["CURRENCY"])?></s>
					</div>
				<?endif?>
				<?=$arBasketItems["NOTES"]?>
				</td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td class="product-type"><?=$arBasketItems["NOTES"]?></td>
			<?endif;?>
			<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
				<td><?=(round($arBasketItems["DISCOUNT_PRICE_PERCENT"])>0) ? round($arBasketItems["DISCOUNT_PRICE_PERCENT"])."%" : "0"?></td>
			<?endif;?>
			<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
				<td class="quantity"><input maxlength="18" type="text" name="QUANTITY_<?=$arBasketItems["ID"] ?>" value="<?=$arBasketItems["QUANTITY"]?>" size="3" ></td>
			<?endif;?>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
				<td class="product-delete">
				<label>
				<input type="checkbox" name="DELETE_<?=$arBasketItems["ID"] ?>" id="DELETE_<?=$i?>" value="Y">
				<span></span>
				</label>
				</td>
			<?endif;?>
			<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
				<td>
				<label>
				<input type="checkbox" name="DELAY_<?=$arBasketItems["ID"] ?>" value="Y">
				<span></span>
				</td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["WEIGHT_FORMATED"] ?></td>
			<?endif;?>
		</tr>
		<?
		$i++;
	}
	?>
	<script>
	function sale_check_all(val)
	{
		for(i=0;i<=<?=count($arResult["ITEMS"]["AnDelCanBuy"])-1?>;i++)
		{
			if(val)
				document.getElementById('DELETE_'+i).checked = true;
			else
				document.getElementById('DELETE_'+i).checked = false;
		}
	}
	</script>
	<tr class="itogo">
		<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<td></td>
			<td class="product-name">
				<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
					<strong><?echo GetMessage('SALE_VAT_INCLUDED')?></strong><br />
				<?endif;?>
				<?
				if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
				{
					?><strong><?echo GetMessage("SALE_CONTENT_DISCOUNT")?><?
					if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0)
						echo " (".$arResult["DISCOUNT_PERCENT_FORMATED"].")";?>:</strong><br /><?
				}
				?>
				<strong><?= GetMessage("SALE_ITOGO")?>:</strong>
			</td>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<td  class="product-price">
				<?if ($arParams['PRICE_VAT_SHOW_VALUE'] == 'Y'):?>
					<?=$arResult["allVATSum_FORMATED"]?><br />
				<?endif;?>
				<?
				if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
				{
					echo $arResult["DISCOUNT_PRICE_FORMATED"]."<br />";
				}
				?>
				<?=$arResult["allSum_FORMATED"]?><br />
			</td>
		<?endif;?>
		<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
			<td class="product-delete">
			<label>
				<input type="checkbox" name="DELETE" value="Y" onClick="sale_check_all(this.checked)">
				<span></span>
				</label>
			</td>
		<?endif;?>
		<?if (in_array("DELAY", $arParams["COLUMNS_LIST"])):?>
			<td>&nbsp;</td>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<td><?=$arResult["allWeight_FORMATED"] ?></td>
		<?endif;?>
	</tr>
</table>

<br />
<table width="100%" border="0">
	<?if ($arParams["HIDE_COUPON"] != "Y"):?>
		<tr>
			<td colspan="2">
				
				<?= GetMessage("STB_COUPON_PROMT") ?>
				<input type="text" name="COUPON" value="<?=$arResult["COUPON"]?>" size="20">
				<br /><br />
			</td>
		</tr>
	<?endif;?>
	<tr>
		<td class="basket-submit">
			<input type="submit" value="<?echo GetMessage("SALE_REFRESH")?>" name="BasketRefresh">
			<input type="submit" value="<?echo GetMessage("SALE_ORDER")?>" name="BasketOrder"  id="basketOrderButton2">
		</td>
	</tr>
</table>
<br />
<?
//prn($arResult);
?>