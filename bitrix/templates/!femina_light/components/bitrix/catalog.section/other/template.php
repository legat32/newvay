<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?if(count($arResult["ITEMS"])>0):?>

	<?
	$APPLICATION->AddHeadScript("/assets/js/plugins.js");
	$APPLICATION->AddHeadScript("/assets/js/sly.min.js");
	?>

	<h2>Другие модели коллекции</h2>
	
	<div class="sly-section">
		<div class="wrap_section">
			<div class="wrap">
				<div class="frame" id="sly-section-centered" style="overflow: hidden;">
					<ul class="clearfix" style="-webkit-transform: translateZ(0px) translateX(-2964px); width: 6840px;">
						<?foreach($arResult["ITEMS"] as $item):?>
						<li class="other_<?=$item["ID"]?>">
						
							
							<div class="item_cell">
								<div class="item_artikul_small"  style="background-color:<?=$item["COLLECTION_COLOR"]?>">Арт.<?=$item["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></div>
								<?if(is_array($item["PREVIEW_IMG"])):?>
									<div class="item_image"><a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["TITLE"]?>"><img style="border-color:<?=$item["COLLECTION_COLOR"]?>" alt="<?=$item["TITLE"]?>" title="<?=$item["TITLE"]?>" width="<?=$item["PREVIEW_IMG"]["width"]?>" height="<?=$item["PREVIEW_IMG"]["height"]?>" src="<?=$item["PREVIEW_IMG"]["src"]?>"/></a></div>
								<?else:?>
									<div class="item_image_empty" style="border-color:<?=$item["COLLECTION_COLOR"]?>"><a href="<?=$item["DETAIL_PAGE_URL"]?>" title="<?=$item["TITLE"]?>"></a></div>
								<?endif?>
								<div class="item_price">
								<?if(PRICE_TYPE == DEALER_PRICE):?>
									<?=CurrencyFormat($item["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"], "RUB");?>
								<?elseif(PRICE_TYPE == JOINT_PRICE):?>
									<?=CurrencyFormat($item["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"], "RUB");?>
								<?endif?>
								</div>
							</div>
							
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
	</div>
	
	
<?endif?>




