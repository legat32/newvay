<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["ITEMS_COUNT"]>0):?>
	<?
	$word="товаров";
	if(in_array($arResult["ITEMS_COUNT"], Array(1,21,31,41))) $word="товар";
	if(in_array($arResult["ITEMS_COUNT"], Array(2,3,4,22,23,24,32,33,34,42,43,44,52,53,54))) $word="товара";
	if($arResult["SUMMA"]>100000) $word="тов.";
	?>
	<div class="items"><span><?=$arResult["ITEMS_COUNT"]?> <?=$word?></span></div>
	<div class="price"><span><?=CurrencyFormat($arResult["SUMMA"], "RUB");?></span></div>
<?else:?>
	<div class="items"><span>0 товаров</span></div>
    <div class="price"><span>0.00</span>P</div>
<?endif?>
                  