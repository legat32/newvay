<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<b><?= GetMessage("SALE_UNAVAIL_TITLE")?></b><br /><br />
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
				<?//prn($arBasketItems);?>
				<?if(is_array($arBasketItems["PREVIEW_PICTURE"])):?>
					<div class="item_img">
					<img width="<?=$arBasketItems["PREVIEW_PICTURE"]["width"]?>" height="<?=$arBasketItems["PREVIEW_PICTURE"]["height"]?>" src="<?=$arBasketItems["PREVIEW_PICTURE"]["src"]?>">
					</div>
				<?else:?>
					<div class="item_img_blank"></div>
				<?endif?>
			</td>
			<?if (in_array("NAME", $arParams["COLUMNS_LIST"])):?>
				<td class="product-name">
				<?if (strlen($arBasketItems["DETAIL_PAGE_URL"])>0):?>
					<a href="<?=$arBasketItems["DETAIL_PAGE_URL"] ?>">
					<?endif;?>
						<strong class="name">
							<?=$arBasketItems[CATALOG][PARENT_NAME]?>
						</strong><br>
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
				<td class="product-price"><?=$arBasketItems["PRICE_FORMATED"]?></td>
			<?endif;?>
			<?if (in_array("TYPE", $arParams["COLUMNS_LIST"])):?>
				<td class="product-type"><?=$arBasketItems["NOTES"]?></td>
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