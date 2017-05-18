<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if(count($arResult["ITEMS"])>0):?>

	<?
	$APPLICATION->AddHeadScript("/assets/js/plugins.js");
	$APPLICATION->AddHeadScript("/assets/js/sly.min.js");
	?>

	<h2>Другие модели коллекции</h2>
	
	<div class="sly-section">
		<div class="wrap_section">
			<div class="other-products">
				<?foreach($arResult["ITEMS"] as $item):?>
				<div class="other-product other_<?=$item["ID"]?>">
					<div class="item_cell">
						<?if(is_array($item["PREVIEW_IMG"])):?>
							<div class="item_image">
							<a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["TITLE"]?>"><img style="border-color:<?=$item["COLLECTION_COLOR"]?>" alt="<?=$item["TITLE"]?>" title="<?=$item["TITLE"]?>" width="<?=$item["PREVIEW_IMG"]["width"]?>" height="<?=$item["PREVIEW_IMG"]["height"]?>" src="<?=$item["PREVIEW_IMG"]["src"]?>"/>
							<div class="item_artikul_small">
								<span>Арт.<?=$item["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></span>
								<div class="item_price">
								<?if(PRICE_TYPE == DEALER_PRICE):?>
									<?=CurrencyFormat($item["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"], "RUB");?>
								<?elseif(PRICE_TYPE == JOINT_PRICE):?>
									<?=CurrencyFormat($item["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"], "RUB");?>
								<?endif?>
								</div>
							</div>
							</a>
							</div>
						<?else:?>
							<div class="item_image_empty">
							<a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["TITLE"]?>"><img src="/bitrix/templates/new_femina/images/img_catalog_blank.png" alt="no-img">
								<div class="item_artikul_small">
								<span>Арт.<?=$item["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></span>
								<div class="item_price">
								<?if(PRICE_TYPE == DEALER_PRICE):?>
									<?=CurrencyFormat($item["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"], "RUB");?>
								<?elseif(PRICE_TYPE == JOINT_PRICE):?>
									<?=CurrencyFormat($item["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"], "RUB");?>
								<?endif?>
								</div>
							</div>
							</a>
							</div>
						<?endif?>
						
					</div>
					
				</div>
				<?endforeach?>
			</div>
		</div>
	</div>
<?endif?>




