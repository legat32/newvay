<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?
// обработка ошибки из добавления товара в корзину
if($_REQUEST["error"]=="buy_limit") $errText="Установлен лимит на покупку товара в ".BUY_LIMIT." единиц (включая корзину и неоплаченные заказы).<br/>Необходимо уменьшить количество для покупки";
if($_REQUEST["error"]=="quantity_limit") $errText="Указанное Вами количество товара (учитывая уже добавленные в корзину) превышает наличие на складе.<br/> Необходимо уменьшить количество для покупки";
?>

<?if($errText):?><div class="errortext"><?=$errText?></div><?endif;?>  

<div class="item_wrapper">
	<div class="item_images">
		<div class="item_artikul">Арт. <?=$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></div>
		<?if($arResult["PROPERTIES"]["RASPRODAZHA"]["VALUE"]=="true"):?><a class="item_sale">Распродажа!</a><?endif?>
		
		<?if($arResult["PROPERTIES"]["SEZONNOE_PREDLOZHENIE"]["VALUE"]=="true"):?>
			<a class="item_season"<?if($arResult["PROPERTIES"]["RASPRODAZHA"]["VALUE"]=="true"):?> style="top:85px"<?endif?>>Сезонное предложение</a>
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
							<li class=""><a title="<?=$photo["DESCRIPTION"]?>" class="fancybox" rel="group1" href="<?=$photo["ORIGINAL"]["src"]?>"><img alt="<?=$photo["DESCRIPTION"]?>" src="<?=$photo["SRC"]?>"/></a></li>
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
				<span id="color_title">Цвета:</span><br/>
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
								<a class="color_tooltip">
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
								<a class="color_tooltip">
									<div class="color_img">
										<img alt="<?=$title?>" title="<?=$title?>" src="/assets/images/no-color.png">
									</div>
									<div class="no-ex" title="<?=$title?>"></div>
								</a>
							<?endif?>
						</div>
					<?endforeach?>
					</div>
				<div class="clear"></div>
				 
				<span id="size_title">Размеры:</span><br/>
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
									<div class="offer_color">Цвет <?=strLen($arResult["SKU_TABLE"]["COLORS"][$color_kod]["DISPLAY_NAME"])>0 ? $arResult["SKU_TABLE"]["COLORS"][$color_kod]["DISPLAY_NAME"] : $color_kod?></div>
									<div class="offer_size">Размер <?=$offer["PROPERTIES"]["SIZE"]["VALUE"]?></div>
									
									<?if(defined("BUY_LIMIT")):?>
										<div class="limit_block">
											<div class="limit_text">Максимально возможное количество для покупки данной торговой позиции ограничено <?=BUY_LIMIT?> единицами (артикул/цвет/размер)</div>
											<div class="limit_ico"></div>
										</div>
									<?endif?>
									
									
								</div><!--price_block-->
								
								<div class="buy_block">
									<form action="<?=$_SERVER["ADD_URL"]?>" method="get">
										<input type="hidden" name="SECTION_ID" value="<?=$arResult["IBLOCK_SECTION_ID"]?>">
										<input type="hidden" name="ELEMENT_ID" value="<?=$arResult["ID"]?>">
										<input type="hidden" name="action" value="ADD2BASKET">
										<input type="hidden" name="id" value="<?=$offer["ID"]?>">
										<div>
											<a class="btn_plus" href="" onclick="javascript: v=document.getElementById('quant-<?=$offer["ID"]?>'); if(v.value<<?=$offer["CATALOG_QUANTITY"]?>) v.value++; return false;"></a>
											<input class="quant" maxlength="3" type="text" name="quantity" id="quant-<?=$offer["ID"]?>" value="1">
											<a class="btn_minus" href="" onclick="javascript: v=document.getElementById('quant-<?=$offer["ID"]?>'); if(v.value>1) v.value--; return false;"></a>
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
									<!--<hr/>
									<a href="<?=$offer["ADD_URL"]?>">Купить одну штуку</a>
									<a href="<?=$offer["ADD_URL"]?>" onclick="javascript: var url='<?=$offer["ADD_URL"]?>&quantity='+$('#quant-<?=$offer["ID"]?>').val(); alert(url); document.location.href=url;">Купить несколько штук</a>
									-->
								</div><!--buy_block-->
								
							</div><!--price_block-->
						<?endif?>
					<?endforeach?>
				<?endif?>
			</div><!--buy_panel-->
	

			<div class="clear"></div>	
			
			<a class="" id="table_nal" href="">Таблица наличия</a>
			
			
			<div class="links">
				<a class="" id="ask"><span class="link_ask"></span>Задать вопрос по модели</a>
				<a href="/order.php"><span class="link_order"></span>Оформить заказ</a>
				<a class="" id="sizes" href="/razmery.html" target="_blank"><span class="link_sizes"></span>Сетка размеров</a>
				<a class="" id="colors" href="/colors.html"><span class="link_colors"></span>Цветовая гамма</a>
				<a class="" id="to_print" onclick="javascript: window.print(); return false;"><span class="link_print"></span>Печать страницы</a>
			</div><!--buy_panel-->


		</div><!--offers_wrapper-->

	</div><!--item_descr-->
	
	<div class="clear"></div>
	
</div>

<?
$GLOBALS["arrFilterOther"] = Array("IBLOCK_ID"=>10, "!ID"=>$arResult["ID"]);
?>

<?$APPLICATION->IncludeComponent("bitrix:catalog.section", "other", array(
	"IBLOCK_TYPE" => "1c_catalog",
	"IBLOCK_ID" => "6",
	"SECTION_ID" => $_REQUEST["SECTION_ID"],
	"SECTION_CODE" => "",
	"SECTION_USER_FIELDS" => array(
		0 => "",
		1 => "",
	),
	"ELEMENT_SORT_FIELD" => "PROPERTY_CML2_ARTICLE",
	"ELEMENT_SORT_ORDER" => "asc",
	"FILTER_NAME" => "arrFilterOther",
	"INCLUDE_SUBSECTIONS" => "Y",
	"SHOW_ALL_WO_SECTION" => "Y",
	"PAGE_ELEMENT_COUNT" => "1000",
	"LINE_ELEMENT_COUNT" => "1000",
	"PROPERTY_CODE" => array(
		0 => "CML2_ARTICLE",
		1 => "",
	),
	"OFFERS_FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"OFFERS_PROPERTY_CODE" => array(
		0 => "",
		1 => "",
	),
	"OFFERS_SORT_FIELD" => "sort",
	"OFFERS_SORT_ORDER" => "asc",
	"OFFERS_LIMIT" => "5",
	"SECTION_URL" => "",
	"DETAIL_URL" => "#SITE_DIR#/shop/index.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ELEMENT_ID#",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"ADD_SECTIONS_CHAIN" => "N",
	"DISPLAY_COMPARE" => "N",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"CACHE_FILTER" => "N",
	"PRICE_CODE" => array(
		0 => "для Физ.лиц",
		1 => "Оптовые",
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"CONVERT_CURRENCY" => "N",
	"OFFERS_CART_PROPERTIES" => array(
	),
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Товары",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>


<script>
$(document).ready( function() {
	
	$("#table_nal").on("click", function() {
		$.fancybox.open([
			{
				href : '/ajax/nalichie.php?ID=<?=$arResult["ID"]?>',
				type : 'ajax',
				autoSize: true
			}
		]);
		return false;
		});
		
		
	$("#ask").on("click", function() {
		$.fancybox.open([
			{
				href : '/forms/ask.php?blank=Y&model=<?=$arResult["NAME"]?>',
				type : 'iframe',
				autoSize: true,
				maxWidth: '500px'
			}
		]);
		return false;
		});
		
		
		
	$("#sizes").on("click", function() {
		$.fancybox.open([
			{
				href : '/razmery_popup.php?blank=Y',
				type : 'iframe',
				autoSize: true
			}
		]);
		return false;
		});
		
		
		
	});
</script>