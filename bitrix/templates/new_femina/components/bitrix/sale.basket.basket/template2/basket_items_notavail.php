<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p class="basket-section"><?= GetMessage("SALE_UNAVAIL_TITLE")?>:</p>
<?
//prn($arParams["COLUMNS_LIST"]);
//unset($arParams["COLUMNS_LIST"][4]);  // тип цены убрали
?>
<table class="sale_basket_basket data-table">
	<tr>
		<th>Фото</th>
		<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_NAME")?></th>
		<?endif;?>
		<?if (in_array("PROPS", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_PROPS")?></th>
		<?endif;?>
		<?if (in_array("PRICE", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_PRICE")?></th>
		<?endif;?>
		<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_PRICE_TYPE")?></th>
		<?endif;?>
		<?if (in_array("DISCOUNT", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_DISCOUNT")?></th>
		<?endif;?>
		<?if (in_array("QUANTITY", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_QUANTITY")?></th>
		<?endif;?>
		<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_DELETE")?></th>
		<?endif;?>
		<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
			<th align="center"><?echo GetMessage("SALE_WEIGHT")?></th>
		<?endif;?>
	</tr>
	<?
	foreach($arResult["ITEMS"]["nAnCanBuy"] as $arBasketItems)
	{
		?>
		<tr>
			<td class="product-img">
				<?//prn($arBasketItems["PROPS"]);?>
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
							Цвет: <?=$arBasketItems[PROPS][0][VALUE] ?><br>
							Размер: <?=$arBasketItems[PROPS][1][VALUE] ?>
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
				<td class="quantity"><?=$arBasketItems["QUANTITY"]?></td>
			<?endif;?>
			<?if (in_array("DELETE", $arParams["COLUMNS_LIST"])):?>
				<td class="product-delete">
				<label>
				<input type="checkbox" name="DELETE_<?echo $arBasketItems["ID"] ?>" value="Y">
				<span></span>
				</label>
				</td>
			<?endif;?>
			<?if (in_array("WEIGHT", $arParams["COLUMNS_LIST"])):?>
				<td><?=$arBasketItems["WEIGHT_FORMATED"] ?></td>
			<?endif;?>
		</tr>
		<?
	}
	?>
</table>

<br />
<div class="basket-submit">
	<input type="submit" value="<?= GetMessage("SALE_REFRESH") ?>" name="BasketRefresh"><br />
	<small><?= GetMessage("SALE_REFRESH_DESCR") ?></small>
</div>
<br />
<?