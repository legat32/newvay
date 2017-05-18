<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
<?
//prn($arResult[ID]);
foreach($arResult["NAV_RESULT"] as $key=>$row) 
	if($key=="NavRecordCount") {$items_count=$row; break;}
?>
<span style="color:#CCC; font-size:10px;"><?=time()?></span>
<div class="catalog">
<?foreach($arResult["ITEMS"] as $cell=>&$arElement):?>
	<div id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<div class="item_cell">
			
			<?
			$arElement["DETAIL_PAGE_URL"] = "/neo/?SECTION_ID=".$arElement["IBLOCK_SECTION_ID"]."&ELEMENT_ID=".$arElement["ID"];
			?>
			
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
<div class="page-navigation">
	<div class="items_count">ТОВАРОВ: <span><?=$arResult["ELEMENTS_COUNT"]?></span></div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
	<?endif;?>
	<div class="catalog-show">
		<span class="title">ПОКАЗЫВАТЬ:</span>
		<span class="show-value">
		<?if (isset($_GET['count'])) {
    		$count=$_GET['count']; // val1
		}
		else{
			$count='32';
		}

		?>
			<a class="prod_show_number<?if($count=="32"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=32", Array("view", "sort", "count"))?>" rel="nofollow">32</a>
			<a class="prod_show_number<?if($count=="60"):?>_active<?endif?>" href="<?=$APPLICATION->GetCurPageParam("count=60", Array("view", "sort", "count"))?>" rel="nofollow">60</a>
		</span>
	</div>
</div>

<?if((strLen($arResult["DESCRIPTION"])>0)&&(!isset($_GET["PAGEN_1"]))):?>
	<?echo $arResult["DESCRIPTION"];?>
<?endif?>


</div>

