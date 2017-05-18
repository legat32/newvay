<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?
//prn($arResult[ID]);
foreach($arResult["NAV_RESULT"] as $key=>$row) 
	if($key=="NavRecordCount") {$items_count=$row; break;}
?>
<div class="catalog">
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
	<div id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<div class="item_cell">
			
			<?//pra($arElement["PROPERTIES"]["SEZON"]["VALUE"])?>
			
			<div class="item_body">
				<div class="item_artikul">Арт. <?=$arElement["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></div>
				<div class="item_name"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
				
				<?//pra($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"])?>

				<?if(is_array($arElement["PREVIEW_IMG"])):?>
				<div class="item_img">
					<div class="action-label">
					<?if($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Новинка"):?><a class="item_new_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Новинка</a><?endif?>
					<?if($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Распродажа"):?><a class="item_sale_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Распродажа</a><?endif?>
					<?if($arElement["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Товары со скидкой"):?><a class="item_utsenka_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Скидка %</a><?endif?>
					<?if($arElement["PROPERTIES"]["AKTSIYA"]["VALUE"]=="true"):?><a class="item_aktsiya_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Акция</a><?endif?>
					<?if($arElement["PROPERTIES"]["SEZONNOE_PREDLOZHENIE"]["VALUE"]=="true"):?><a class="item_zimniy_tsenopad_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Зима</a><?endif?>
					<?if($arElement["PROPERTIES"]["BAMBOO"]["VALUE"]=="true"):?><a title="Узнать про уникальные свойства трикотажа из бамбукового полотна" class="item_bamboo_sm" href="/stati/unikalnye-svoystva-trikotazha-iz-bambukovogo-volokna.html?back=<?=urlencode($_SERVER["REQUEST_URI"])?>">Бамбук</a><?endif?>
					<?if($arElement["PROPERTIES"]["AKCIYA_ON_SITE"]["VALUE"]=="Y"):?><a class="item_akciya_on_site_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Акция</a><?endif?>
				</div>
					<a title="<?=$arElement["TITLE"]?>" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img alt="<?=$arElement["TITLE"]?>" title="<?=$arElement["TITLE"]?>" style="border-color:<?=$arElement["COLLECTION_COLOR"]?>;" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" /></a>
				</div>
				<?else:?>
				<div class="item_img_blank">
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>">
					<img src="/bitrix/templates/new_femina/images/img_catalog_blank.png" alt="no-img">
					</a>
				</div>
				<?endif;?>
				
				<!--noindex-->
				<?if(defined("PRICE_TYPE")):?>
					<div class="item_price">
						<?if(defined("DEALER_USER")):?>
						<span class="price">
							<span class="price_type">Оптовая цена</span>
							<span class="price-value"><?=CurrencyFormat($arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"], "RUB")?></span>
						</span>
						<?elseif(defined("JOINT_USER")):?>
						<span class="price">
							<span class="price_type">Оптовая цена (для физ.лиц)</span>
							<span class="price-value"><?=CurrencyFormat($arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"], "RUB")?></span>
						</span>
						<?else:?>
						<span class="price">
							<span class="price_type">Розничная цена</span>
							<span class="price-value"><?=CurrencyFormat($arElement["PROPERTIES"]["RETAIL_PRICE_MIN"]["VALUE"], "RUB")?></span>
						</span>
						<?endif?>
					</div>
					<div class="item_buy">
						<a class="btn_buy" href="<?=$arElement["DETAIL_PAGE_URL"]?>" rel="nofollow"></a>
					</div>
				<?elseif($USER->isAuthorized()):?>
					<div class="item_price">
						<span class="price">
							<span class="price_type">Оптовая цена</span>
							<span class="register"><a class="buy-register fancybox-html" href="#">Ожидает подтверждения</a></span>
						</span>
					</div>
				<?else:?>
					<div class="item_price">
						<span class="price">
							<span class="price_type">Оптовая цена</span>
							<span class="register"><a class="buy-register" href="/reg/ooo.html" rel="nofollow">Зарегистрироваться</a></span>
						</span>
					</div>
				<?endif?>
				<!--/noindex-->
				
			</div>
		</div>
	</div>
<?endforeach;?>




<?if((strLen($arResult["DESCRIPTION"])>0)&&(!isset($_GET["PAGEN_1"]))):?>
	<?echo $arResult["DESCRIPTION"];?>
<?endif?>


</div>
<br>