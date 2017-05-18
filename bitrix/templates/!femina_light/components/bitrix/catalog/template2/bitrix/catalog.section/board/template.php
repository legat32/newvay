<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?
//pra($arResult);
foreach($arResult["NAV_RESULT"] as $key=>$row) 
	if($key=="NavRecordCount") {$items_count=$row; break;}
?>
<script type="text/javascript">
$(document).ready( function() {
	$("#items_count").html("Всего: <?=$items_count?>");
	});
</script>
<div class="catalog">
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
	<div id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<div class="item_cell">
			
			<?//pra($arElement["PROPERTIES"]["SEZON"]["VALUE"])?>
			<div class="item_artikul" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Арт. <?=$arElement["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></div>
			<div class="item_body">
				<div class="item_name"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
				
				<?//pra($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"])?>
				
				<?if($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Новинка"):?><a class="item_new_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Новинка!</a><?endif?>
				<?if($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Распродажа"):?><a class="item_sale_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Распродажа!</a><?endif?>
				<?if($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Товары со скидкой"):?><a class="item_utsenka_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">%</a><?endif?>

				<?if($arElement["PROPERTIES"]["AKTSIYA"]["VALUE"]=="true"):?><a class="item_aktsiya_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>"></a><?endif?>
				
				<?if($arElement["PROPERTIES"]["SEZONNOE_PREDLOZHENIE"]["VALUE"]=="true"):?><a class="item_zimniy_tsenopad_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>"></a><?endif?>
				<?if($arElement["PROPERTIES"]["BAMBOO"]["VALUE"]=="true"):?><a title="Узнать про уникальные свойства трикотажа из бамбукового полотна" class="item_bamboo_sm" href="/stati/unikalnye-svoystva-trikotazha-iz-bambukovogo-volokna.html?back=<?=urlencode($_SERVER["REQUEST_URI"])?>"></a><?endif?>
				<?if($arElement["PROPERTIES"]["AKCIYA_ON_SITE"]["VALUE"]=="Y"):?><a class="item_akciya_on_site_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>"></a><?endif?>
				
				<?if(is_array($arElement["PREVIEW_IMG"])):?>
				<div class="item_img">
					<a title="<?=$arElement["TITLE"]?>" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img alt="<?=$arElement["TITLE"]?>" title="<?=$arElement["TITLE"]?>" style="border-color:<?=$arElement["COLLECTION_COLOR"]?>;" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" /></a>
				</div>
				<?else:?>
				<div class="item_img_blank">
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"></a>
				</div>
				<?endif;?>
				
				<!--noindex-->
				<?if(defined("PRICE_TYPE")):?>
					<div class="item_price">
						<?if(defined("DEALER_USER")):?>
							<span class="price">
								<span class="price_type" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Оптовая цена</span>
								<br/>
								<?if($arElement["PROPERTIES"]["AKCIYA_ON_SITE"]["VALUE"] == "Y"):?>
									<s><?=CurrencyFormat(round($arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"]), "RUB")?></s>
									<span class="discount-price"><?=round($arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"]-$arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"]*.1)?> руб.</span>
								<?else:?>
									<?=CurrencyFormat(round($arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"]), "RUB")?>
								<?endif?>
							</span>
						<?elseif(defined("JOINT_USER")):?>
							<span class="price">
								<span class="price_type" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Оптовая цена (для физ.лиц)</span>
								<br/>
								<?if($arElement["PROPERTIES"]["AKCIYA_ON_SITE"]["VALUE"] == "Y"):?>
									<s><?=CurrencyFormat(round($arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"]), "RUB")?></s>
									<span class="discount-price"><?=round($arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"]-$arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"]*.1)?> руб.</span>
								<?else:?>
									<?=CurrencyFormat(round($arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"]), "RUB")?>
								<?endif?>
							</span>
						<?endif?>
						
						<?/*?>
						<?if(defined("DEALER_USER")):?><span class="price"><span class="price_type" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Оптовая цена</span><br/><?=CurrencyFormat($arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"], "RUB")?></span>
						<?elseif(defined("JOINT_USER")):?><span class="price"><span class="price_type" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Оптовая цена (для физ.лиц)</span><br/><?=CurrencyFormat($arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"], "RUB")?></span>
						<?else:?><span class="price"><span class="price_type" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Розничная цена</span><br/><?=CurrencyFormat($arElement["PROPERTIES"]["RETAIL_PRICE_MIN"]["VALUE"], "RUB")?></span><?endif?>
						<?*/?>
					</div>
					<hr/>
					<div class="item_buy">
						<a class="btn_buy" href="<?=$arElement["DETAIL_PAGE_URL"]?>" rel="nofollow"></a>
					</div>
				<?elseif($USER->isAuthorized()):?>
					<div class="item_price" style="height:40px;">
						<span class="price_type" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Оптовая цена</span>
						<br/>
						<a class="buy-register fancybox-html" href="#">Ожидает подтверждения</a>
					</div>
				<?else:?>
					<div class="item_price" style="height:40px;">
						<span class="price">
							<span class="price_type" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Оптовая цена</span>
							<br/>
							<a class="buy-register" href="/reg/ooo.html" rel="nofollow">Зарегистрироваться</a>
						</span>
					</div>
				<?endif?>
				<!--/noindex-->
				
			</div>
		</div>
	</div>
<?endforeach;?>
<div class="clear"></div>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>


<?if((strLen($arResult["DESCRIPTION"])>0)&&(!isset($_GET["PAGEN_1"]))):?>
	<?echo $arResult["DESCRIPTION"];?>
<?endif?>


</div>