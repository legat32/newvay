<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>


<style>

</style>
				

<?
// обработка ошибки из добавления товара в корзину
if($_REQUEST["error"]=="buy_limit") $errText="Установлен лимит на покупку товара в ".BUY_LIMIT." единиц (включая корзину и неоплаченные заказы).<br/>Необходимо уменьшить количество для покупки";
if($_REQUEST["error"]=="quantity_limit") $errText="Указанное Вами количество товара (учитывая уже добавленные в корзину) превышает наличие на складе.<br/> Необходимо уменьшить количество для покупки";
?>

<?if($errText):?><div class="errortext"><?=$errText?></div><?endif;?>  

<div class="item_wrapper">
	<div class="item_images">
		<div class="item_artikul">Арт. <?=$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></div>
		<?if($arResult["PROPERTIES"]["RASPRODAZHA"]["VALUE"]=="true"):?><span class="item_sale">Распродажа!</span><?endif?>
		<?if($arResult["PROPERTIES"]["UTSENKA"]["VALUE"]=="true"):?><a class="item_utsenka" title="Уцененный товар">%</a><?endif?>
		<?if($arResult["PROPERTIES"]["SEZONNOE_PREDLOZHENIE"]["VALUE"]=="true"):?>
			<span class="item_season"<?if($arResult["PROPERTIES"]["RASPRODAZHA"]["VALUE"]=="true"):?> style="top:85px"<?endif?>>Сезонное предложение</span>
		<?endif?>
		<?if(is_array($arResult["DETAIL_IMG"])):?>
			<div class="item_img">
				<a title="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" class="fancybox" rel="group1" href="<?=$arResult["ORIGINAL_IMG"]["src"]?>"><img alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" class="item_detail_img" width="<?=$arResult["DETAIL_IMG"]["width"]?>" height="<?=$arResult["DETAIL_IMG"]["height"]?>" src="<?=$arResult["DETAIL_IMG"]["src"]?>"></a>
			</div>
		<?else:?>
			<div class="item_img_blank">
			</div>
		<?endif;?>
		
		<?if(count($arResult["MORE_PHOTO"])>0):?>
		<div class="item_more_files">
			<div class="wrap_more">
				<div class="wrap">
					<div class="frame" id="centered" style="overflow: hidden;">
						<ul class="clearfix" style="-webkit-transform: translateZ(0px) translateX(-2964px); width: 6840px;">
							<?foreach($arResult["MORE_PHOTO"] as $photo):?>
							<li class="">
								<a title="<?=$photo["DESCRIPTION"]?>" class="fancybox" rel="group1" href="<?=$photo["ORIGINAL"]["src"]?>">
									<img alt="<?=$photo["DESCRIPTION"]?>" src="<?=$photo["SRC"]?>"/>
								</a>
								<!--<span style="display: none;"><?=$photo["FOR_MAIN_PICTURE"]["src"]?></span>-->
							</li>
							<?endforeach?>
						</ul>
					</div>
				</div>
				<div class="scrollbar">
						<div class="handle" style="-webkit-transform: translateZ(0px) translateX(503px); width: 168px;">
						<div class="mousearea"></div>
					</div>
				</div>
			</div>
		</div><!--item_more_files-->
		<?endif?>
	</div><!--item_images-->
	
	<div class="item_descr">
		<h1><?=$arResult["NAME"]?></h1>
		<a class="back_link" href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>">Назад в каталог</a>
		
		<p style="margin-left:15px;">
			<!--
			<?if($arResult["PREVIEW_TEXT"]):?>
				<?=$arResult["PREVIEW_TEXT"]?><br/>
			<?endif?>
			-->
			
			<?if($arResult["DETAIL_TEXT"]):?>
				<?=$arResult["DETAIL_TEXT"]?><br/>
			<?endif?>
		</p>
		
		<?if($arResult["DISPLAY_PROPERTIES"]["SOSTAV"]["VALUE"]):?>
			<div class="sostav">
				<span class="sostav_label">Состав:</span><br/>
				<span class="sostav_value"><?=$arResult["DISPLAY_PROPERTIES"]["SOSTAV"]["VALUE"]?></span>
			</div>
		<?endif?>

		<div class="offers_wrapper">

			<div class="offer_select">
				<span id="color_title">Выберите цвет:</span><br/>
				
				<?//if($USER->isAdmin()):?>
				
				
				<div class="color_vars">
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
						<div class="color_var <?=implode(" ", $v["ITEMS"])?><?=$exists ? " exists" : ""?>">
							<?if(is_array($v["PREVIEW_PICTURE"])):?>
								<a rel="nofollow" class="color_tooltip">
									<div class="color_img">
										<img alt="<?=$title?>" title="<?=$title?>" src="<?=$v["PREVIEW_PICTURE"]["src"]?>">
									</div>
									<div class="no-ex"></div>
									<span>
										<img alt="<?=$title?>" title="<?=$title?>" src="<?=$v["DETAIL_PICTURE"]["src"]?>">
										<div class="col_description"><?=$title?></div>
									</span>
								</a>
							<?else:?>
								<a rel="nofollow" class="color_tooltip">
									<div class="color_img">
										<img alt="<?=$title?>" title="<?=$title?>" src="/assets/images/no-color.png"> <?=strtolower($title)?>
									</div>
									<div class="no-ex" title="<?=$title?>"></div>
								</a>
							<?endif?>
						</div>
					<?endforeach?>
				</div>
				
				<span class="all-colors">все варианты</span>
				<div style="height:10px; width:10px;"></div>

				
				
				
				<?/*?>
				
				
				
				<div class="color_vars">
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
						<div class="color_var <?=implode(" ", $v["ITEMS"])?><?=$exists ? " exists" : ""?>">
							<?if(is_array($v["PREVIEW_PICTURE"])):?>
								<a rel="nofollow" class="color_tooltip">
									<div class="color_img">
										<img alt="<?=$title?>" title="<?=$title?>" src="<?=$v["PREVIEW_PICTURE"]["src"]?>">
									</div>
									<div class="no-ex"></div>
									<span>
										<img alt="<?=$title?>" title="<?=$title?>" src="<?=$v["DETAIL_PICTURE"]["src"]?>">
										<div class="col_description"><?=$title?></div>
									</span>
								</a>
							<?else:?>
								<a rel="nofollow" class="color_tooltip">
									<div class="color_img">
										<img alt="<?=$title?>" title="<?=$title?>" src="/assets/images/no-color.png">
									</div>
									<div class="no-ex" title="<?=$title?>"></div>
								</a>
							<?endif?>
						</div>
					<?endforeach?>
				</div>
					
					
				<?*/?>	
				
				
				
				<div class="clear"></div>
				 
				<span id="size_title">Выберите размер:</span><br/>
				<div class="size_vars">
					<?foreach($arResult["SKU_TABLE"]["SIZES"] as $k => $v):?>
						<div class="size_var <?=implode(" ", $v)?>">
							<div class="size_val" title="<?=$k?>"><?=$k?></div>
							<div class="no-ex"></div>
						</div>
					<?endforeach?>
				</div>
				
				<div class="clear"></div>
				
				<div class="prim">нет в наличии - <span class="no-ex"></span></div>
				
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
									<div class="offer_color"><b>Цвет:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=strLen($arResult["SKU_TABLE"]["COLORS"][$color_kod]["DISPLAY_NAME"])>0 ? $arResult["SKU_TABLE"]["COLORS"][$color_kod]["DISPLAY_NAME"] : $color_kod?></div>
									<div class="offer_size"><b>Размер:</b>&nbsp;&nbsp;<?=$offer["PROPERTIES"]["SIZE"]["VALUE"]?></div>
									
									<?if(defined("BUY_LIMIT")):?>
										<!--noindex-->
										<div class="limit_block">
											<div class="limit_text">Максимально возможное количество для покупки данной торговой позиции ограничено <?=BUY_LIMIT?> единицами (артикул/цвет/размер)</div>
											<div class="limit_ico"></div>
										</div>
										<!--/noindex-->
									<?endif?>
									
									
								</div><!--price_block-->
								
								<!--noindex-->
								<div class="buy_block">
								
									<?if(defined("PRICE_TYPE")):?>
										<form action="<?=$_SERVER["ADD_URL"]?>" method="get">
											<input type="hidden" name="SECTION_ID" value="<?=$arResult["IBLOCK_SECTION_ID"]?>">
											<input type="hidden" name="ELEMENT_ID" value="<?=$arResult["ID"]?>">
											<input type="hidden" name="action" value="ADD2BASKET">
											<input type="hidden" name="id" value="<?=$offer["ID"]?>">
											<div>
												<a rel="nofollow" class="btn_plus" href="" onclick="javascript: v=document.getElementById('quant-<?=$offer["ID"]?>'); if(v.value<<?=$offer["CATALOG_QUANTITY"]?>) v.value++; return false;"></a>
												<input class="quant" maxlength="3" type="text" name="quantity" id="quant-<?=$offer["ID"]?>" value="1">
												<a rel="nofollow" class="btn_minus" href="" onclick="javascript: v=document.getElementById('quant-<?=$offer["ID"]?>'); if(v.value>1) v.value--; return false;"></a>
												<?if(($offer["CATALOG_QUANTITY"]>0)&&($offer["CATALOG_QUANTITY"]<=10)):?>
													<span title="<?=$offer["CATALOG_QUANTITY"]?> шт." class="count nal_few"><?=$offer["CATALOG_QUANTITY"]?></span>
												<?elseif($offer["CATALOG_QUANTITY"]>10):?>
													<span title="более 10" class="count nal_many"></span>
												<?else:?>
													<span class="count nal_zero">нет</span>
												<?endif?>
											</div>
											<div class="clear"></div>
											<input class="btn_buy" type="submit" value="">
										</form>
									<?elseif($USER->isAuthorized()):?>
										<div class="item_price" style="height:40px;">
											<span class="price_type" style="background-color:#A3A2A2;">Оптовая цена</span>
											<br/>
											<a rel="nofollow" class="buy-register fancybox-html" href="#">Ожидает подтверждения</a>
										</div>
									<?else:?>
										<span class="price">
											<span class="price_type" style="background-color: #7475AC;">Оптовая цена</span>
											<br/>
											<a rel="nofollow" class="buy-register" href="/reg/ooo.html" rel="nofollow">Зарегистрироваться *</a>
											<span class="need-register">* Чтобы увидеть оптовую цену вам нужно зарегистрироваться</span>
										</span>
									<?endif?>
								</div><!--buy_block-->
								<!--/noindex-->
							
								
							</div><!--price_block-->
						<?endif?>
					<?endforeach?>
				<?endif?>
			</div><!--buy_panel-->
	

			<div class="clear"></div>	
			
			<!--noindex-->
			<a rel="nofollow" class="fancybox-ajax" id="table_nal" href="http://www.newvay.ru/ajax/nalichie.php?ID=<?=$arResult["ID"]?>">Таблица наличия</a>
			
			
			<div class="links">
				<a rel="nofollow" href="/order/"><span class="link_order"></span>Оформить заказ</a>
				<a rel="nofollow" class="fancybox-iframe" id="sizes" href="/razmery.html?blank=Y"><span class="link_sizes"></span>Сетка размеров</a>
				<a rel="nofollow" class="" id="colors" href="/colors.html"><span class="link_colors"></span>Цветовая гамма</a>
				<a rel="nofollow" class="" id="to_print" onclick="javascript: window.print(); return false;"><span class="link_print"></span>Печать страницы</a>
			</div><!--buy_panel-->
			<!--noindex-->


		</div><!--offers_wrapper-->

	</div><!--item_descr-->
	
	<div class="clear"></div>
	
	<a class="back_link" href="<?=$arResult["SECTION"]["SECTION_PAGE_URL"]?>">Назад в каталог</a>
	
</div>



<?//pra($arResult)?>