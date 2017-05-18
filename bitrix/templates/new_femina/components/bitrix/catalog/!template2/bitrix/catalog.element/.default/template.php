<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>


<?
// обработка ошибки из добавления товара в корзину
if($_REQUEST["error"]=="buy_limit") $errText="Установлен лимит на покупку товара в ".BUY_LIMIT." единиц (включая корзину и неоплаченные заказы).<br/>Необходимо уменьшить количество для покупки";
if($_REQUEST["error"]=="quantity_limit") $errText="Указанное Вами количество товара (учитывая уже добавленные в корзину) превышает наличие на складе.<br/> Необходимо уменьшить количество для покупки";
?>

<?if($errText):?><div class="errortext"><?=$errText?></div><?endif;?>  
<h1><?=$arResult["NAME"]?></h1>

<?
//prn($arResult["OFFERS"][0]);
?>

<div class="item_wrapper">
	
	<div class="item_images">
		<div class="full-image">
			
			<div class="action-label">
				<?if($arResult["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Новинка"):?><a class="item_novinka" title="Новинка">Новинка!</a><?endif?>
				<?if($arResult["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Распродажа"):?><span class="item_sale">Распродажа!</span><?endif?>
				<?if($arResult["PROPERTIES"]["NOVIZNA"]["VALUE"] == "Товары со скидкой"):?><a class="item_utsenka" title="Товар со скидкой">%</a><?endif?>
				<?if($arResult["PROPERTIES"]["BAMBOO"]["VALUE"]=="true"):?><a title="Узнать про уникальные свойства трикотажа из бамбукового полотна" class="item_bamboo" href="/stati/unikalnye-svoystva-trikotazha-iz-bambukovogo-volokna.html?back=<?=urlencode($arResult["DETAIL_PAGE_URL"])?>">Бамбук</a><?endif?>
				<?if($arResult["PROPERTIES"]["AKCIYA_ON_SITE"]["VALUE"]=="Y"):?><a class="item_akciya_on_site" title="Акция Выгодная покупка!">Акция</a><?endif?>
				<?if($arResult["PROPERTIES"]["SEZONNOE_PREDLOZHENIE"]["VALUE"]=="true"):?><a class="item_zimniy_tsenopad" title="Акция Зимний Ценопад!">Зима</a><?endif?>
				<?if($arResult["PROPERTIES"]["AKTSIYA"]["VALUE"]=="true"):?><a class="item_aktsiya" title="Акция!">Акция</a><?endif?>
			</div>
			
			<?//prn($arResult["DETAIL_PICTURE"])?>
			<div class="item_img" id="<?=$arResult["DETAIL_PICTURE"]["ID"]?>">
				<a title="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" href="<?=$arResult["DETAIL_PICTURE"]["ORIGINAL_PICTURE"]["src"]?>"><img alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" class="item_detail_img" src="<?=$arResult["DETAIL_PICTURE"]["MAIN_PICTURE"]["src"]?>"></a>
			</div>
			
		</div>
		
		<div class="more-photo">
			<?if(count($arResult["MORE_PHOTO"])>0):?>
				<?foreach($arResult["MORE_PHOTO"] as $photo):?>
					<div class="photo-slide">
						<a title="<?=$photo["DESCRIPTION"]?>" href="<?=$photo["MAIN_PICTURE"]["src"]?>" class="fancybox" data-fancybox-group="group">
							<img alt="<?=$photo["DESCRIPTION"]?>" src="<?=$photo["SRC"]?>"/>
						</a>
						<!--<span style="display: none;"><?=$photo["FOR_MAIN_PICTURE"]["src"]?></span>--> 
					</div>
				<?endforeach?>
			<?endif?>
		</div>
		
	</div>
	
	
	<div class="item_descr">
		
		
		<?//pra($arResult);?>
		<div class="item_artikul" id="<?=$arResult["ID"]?>">Арт. <?=$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></div>
		<div class="product-deck-text">
		<?if(strLen(trim($arResult["DETAIL_TEXT"])) > 0):?>
			<?if((strpos(" ".strtoupper($arResult["DETAIL_TEXT"]), "ДЛИНА ИЗДЕЛИЯ")>0) || (strpos(" ".strtoupper($arResult["DETAIL_TEXT"]), "ДЛИНА РУКАВА")>0)):?>
				
			<?else:?>
				<?=$arResult["DETAIL_TEXT"]?>
			<?endif?>
		<?endif?>
		</div>
		<div class="props-table">
		<?=$arResult["PROPS_TABLE"]?>
		</div>
		
		<div class="offers_wrapper">
			<div class="offer_select">
				<span id="color_title">Выберите цвет:</span>
				<div class="color_vars wrap">
					<div class="frame smart" id="smart">
						<ul class="items">
							<?foreach($arResult["SKU_TABLE"]["COLORS"] as $k => $v):?>
								<?
								$title=strLen($v["DISPLAY_NAME"])>0 ? $v["DISPLAY_NAME"] : $k;
								$exists=false;
								foreach($arResult["EXIST_COLORS"] as $color) {
									if(in_array($color, $v["ITEMS"])) {
										$exists=true;
										break;
										}
									}
								?>
								<li class="color_var <?=implode(" ", $v["ITEMS"])?><?=$exists ? " exists" : ""?><?=in_array($arResult["ACTIVE_COLOR_VALUE_ID"], $v["ITEMS"]) ? " color_to_show" : ""?>">
									<a rel="nofollow" class="color_tooltip">
										<div class="color_img<?if(($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"] >= 9500) && ($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"] <= 9517)):?> fix9500<?endif?>" title="<?=$title?>">
											<?if($v["PHOTO_IS"] == "Y"):?>
												<div></div>
											<?else:?>
												<div></div>
												<!--<img alt="<?=$title?>" title="<?=$title?>" src="/assets/images/no-color.png"> -->
											<?endif?>
											<?=strtolower($title)?>
										</div>
										<div class="no-ex"></div>
									</a>
								</li>
							<?endforeach?>
						</ul>
					</div>
					<div class="scrollbar">
						<div class="handle">
							<div class="mousearea"></div>
						</div>
					</div>
				</div>
				<span id="size_title">Выберите размер:</span>
				<div class="size_vars">
					<?foreach($arResult["SKU_TABLE"]["SIZES"] as $k => $v):?>
						<div class="size_var <?=implode(" ", $v)?><?=in_array($arResult["ACTIVE_SIZE_VALUE_ID"], $v) ? " size_to_show" : ""?>">
							<div class="size_val" title="<?=$k?>"><?=$k?></div>
							<div class="no-ex"></div>
						</div>
					<?endforeach?>
				</div>
				<div class="clear"></div>
			</div><!--offer_select-->

			<div class="buy_panel">
				<?if($arResult["NO_QUANTITY"]=="Y"):?>
					<!-- в наличии нет ничего -->
					<div class="offer_block_no_quantity">
						<span class="">Цена: </span><br/>
						<span class="">Нет в наличии</span><br/>
					</div>
				<?else:?>
					<!-- есть наличие -->
					<?foreach($arResult["OFFERS"] as $key => $offer):?>
						<?if($offer["CATALOG_QUANTITY"]>0):?>
							<div class="offer_block color_<?=$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"]?> size_<?=$offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"]?>">
								<div class="price_block">
									<?foreach($offer["PRICES"] as $k => $price):?>
										<?if($price["ID"]==$offer["CATALOG_PRICE_ID_".PRICE_TYPE]):?>
											<span class="price_title"><?=$arResult["CATALOG_GROUP_NAME_".PRICE_TYPE]?>: </span>
											<span class="price_value"><?=$price["PRINT_DISCOUNT_VALUE"]?></span>
											<br/>
										<?endif?>
									<?endforeach;?>
									<?$color_kod=$offer["PROPERTIES"]["COLOR"]["VALUE"];?>
									<div class="offer_color">
										<span class="color_title">Цвет:</span>
										<span class="color_value"><?=strLen($arResult["SKU_TABLE"]["COLORS"][$color_kod]["DISPLAY_NAME"])>0 ? $arResult["SKU_TABLE"]["COLORS"][$color_kod]["DISPLAY_NAME"] : $color_kod?></span>
										</div>
									<div class="offer_size">
										<span class="size_title">Размер:</span>
										<span class="size_value"><?=$offer["PROPERTIES"]["SIZE"]["VALUE"]?></span>
									</div>
									
								</div><!--price_block-->
								
								<!--noindex-->
								<div class="buy_block">
									<!--noindex-->
									<a rel="nofollow" class="fancybox-ajax" id="table_nal" href="http://newvay.ru/ajax/nalichie.php?ID=<?=$arResult["ID"]?>">Таблица наличия</a>
									<!--noindex-->
									<?if(defined("PRICE_TYPE")):?>
										<form action="<?=$_SERVER["ADD_URL"]?>" method="get">
											<input type="hidden" name="SECTION_ID" value="<?=$arResult["IBLOCK_SECTION_ID"]?>">
											<input type="hidden" name="ELEMENT_ID" value="<?=$arResult["ID"]?>">
											<input type="hidden" name="action" value="ADD2BASKET">
											<input type="hidden" name="id" value="<?=$offer["ID"]?>">
											<div class="product-add">
												<?if(($offer["CATALOG_QUANTITY"]>0)&&($offer["CATALOG_QUANTITY"]<=10)):?>
													<span title="<?=$offer["CATALOG_QUANTITY"]?> шт." class="count nal_few"><?=$offer["CATALOG_QUANTITY"]?></span>
												<?elseif($offer["CATALOG_QUANTITY"]>10):?>
													<span title="более 10" class="count nal_many"></span>
												<?else:?>
													<span class="count nal_zero">нет</span>
												<?endif?>
												<div class="quantity-wrap">
												<a rel="nofollow" class="btn_minus" href="" onclick="javascript: v=document.getElementById('quant-<?=$offer["ID"]?>');
												console.log(v.value);
												 if(v.value>1) v.value--; return false;"><span>-</span></a>
												<input class="quant" maxlength="3" type="text" name="quantity" id="quant-<?=$offer["ID"]?>" value="1">
												<a rel="nofollow" class="btn_plus" href="" onclick="javascript: v=document.getElementById('quant-<?=$offer["ID"]?>');
												console.log(v.value);
												 if(v.value<<?=$offer["CATALOG_QUANTITY"]?>) v.value++; return false;"><span>+</span></a>
												 </div>
												
											</div>
											<input class="btn_buy" type="submit" value="В корзину">
										</form>
									<?elseif($USER->isAuthorized()):?>
										<div class="item_price">
											<a rel="nofollow" class="buy-register fancybox-html" href="#">Ожидает подтверждения</a>
										</div>
									<?else:?>
										<span class="price">
											<span class="need-register">Чтобы увидеть оптовую цену вам нужно <a class="buy-register" href="/reg/ooo.html" rel="nofollow">зарегистрироваться</a></span>
										</span>
									<?endif?>
								</div><!--buy_block-->
								<!--/noindex-->
							
								
							</div><!--price_block-->
						<?endif?>
					<?endforeach?>
				<?endif?>
			</div><!--buy_panel-->
		</div><!--offers_wrapper-->

	</div><!--item_descr-->
	
	
	</div>

	<div class="more-info">
		<ul class="links-tab">
				<li><a rel="nofollow" href="/order/"><span class="link_order"></span>Оформить заказ</a></li>
				<li><a rel="nofollow" class="fancybox-iframe" id="sizes" href="/razmery.html?blank=Y"><span class="link_sizes"></span>Сетка размеров</a></li>
				<li><a rel="nofollow" class="" id="colors" href="/colors.html"><span class="link_colors"></span>Цветовая гамма</a></li>
				<li><a rel="nofollow" class="" id="to_print" onclick="javascript: window.print(); return false;"><span class="link_print"></span>Печать страницы</a></li>
			</ul><!--buy_panel-->
		<?//if($USER->isAdmin()):?>
		<?if($arResult["PROPERTIES"]["AKCIYA_ON_SITE"]["VALUE"] == "true"):?>
			<a class="back_link_akciya" href="/akciya/">Вернуться к акции!</a>
		<?endif?>
	<?//endif?>
	
</div>
<script type="text/javascript">
	var picts = <?echo CUtil::PhpToJSObject($arResult["arJsPicts"], false, true);?>;
	//alert(picts.length);
</script>
