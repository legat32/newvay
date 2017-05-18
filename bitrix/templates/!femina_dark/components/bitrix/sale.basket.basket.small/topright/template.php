<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["ITEMS_COUNT"]>0):?>
	<?
	$word="товаров";
	if(in_array($arResult["ITEMS_COUNT"], Array(1,21,31,41))) $word="товар";
	if(in_array($arResult["ITEMS_COUNT"], Array(2,3,4,22,23,24,32,33,34,42,43,44,52,53,54))) $word="товара";
	if($arResult["SUMMA"]>100000) $word="тов.";
	?>
	<span class="korz">В корзине <?=$arResult["ITEMS_COUNT"]?> <?=$word?> на сумму <?=CurrencyFormat($arResult["SUMMA"], "RUB");?></span>
<?else:?>
	<span class="korz">В корзине нет ни одного товара</span>
<?endif?>
