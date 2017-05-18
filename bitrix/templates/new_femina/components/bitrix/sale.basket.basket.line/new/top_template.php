<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<a href="<?=$arParams['PATH_TO_BASKET']?>" class="bx-hdr-profile">

		<?/*?>
		<a href="<?=$arParams['PATH_TO_BASKET']?>"><?=GetMessage('TSB1_CART')?></a>
		<?*/?>
		
		<?if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')):?>
			<div class="items"><span><?=$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)']?></span></div>
		<?endif?>
		<?if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>
			<div class="price">
				<span>
					<?if ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'):?>
						<?=$arResult['TOTAL_PRICE']?>
					<?endif?>
				</span>
			</div>
		<?endif?>
</a>
