<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

<?
foreach($arResult["NAV_RESULT"] as $key=>$row) 
	if($key=="NavRecordCount") {$items_count=$row; break;}
?>

<script>
$(document).ready( function() {
	$("#items_count").html("Всего: <?=$items_count?>");
	});
</script>

<?//pra($arResult["ITEMS"])?>

<div class="catalog">
<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
	<div id="<?=$this->GetEditAreaId($arElement['ID']);?>">
		<div class="item_cell">
			<div class="item_artikul" style="background-color:<?=$arElement["COLLECTION_COLOR"]?>">Арт. <?=$arElement["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></div>
			<div class="item_body">
				<div class="item_name"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></div>
				<?if($arElement["PROPERTIES"]["RASPRODAZHA"]["VALUE"]=="true"):?><a class="item_sale_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>">Распродажа!</a><?endif?>
				<?if($arElement["PROPERTIES"]["SEZONNOE_PREDLOZHENIE"]["VALUE"]=="true"):?>
					<a class="item_season_sm" href="<?=$arElement["DETAIL_PAGE_URL"]?>"<?if($arElement["PROPERTIES"]["RASPRODAZHA"]["VALUE"]=="true"):?> style="top:72px;"<?endif?>>Сезонное предложение</a>
				<?endif?>
				<?if(is_array($arElement["PREVIEW_IMG"])):?>
				<div class="item_img">
					<a title="<?=$arElement["TITLE"]?>" href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img alt="<?=$arElement["TITLE"]?>" title="<?=$arElement["TITLE"]?>" style="border-color:<?=$arElement["COLLECTION_COLOR"]?>;" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" src=<?=$arElement["PREVIEW_IMG"]["SRC"]?>></a>
				</div>
				<?else:?>
				<div class="item_img_blank">
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"></a>
				</div>
				<?endif;?>
				<div class="item_price">
					<?if(defined("DEALER_USER")):?><span class="price"><?=CurrencyFormat($arElement["PROPERTIES"]["DEALER_PRICE_MIN"]["VALUE"], "RUB")?></span>
					<?elseif(defined("JOINT_USER")):?><span class="price"><?=CurrencyFormat($arElement["PROPERTIES"]["JOINT_PRICE_MIN"]["VALUE"], "RUB")?></span>
					<?else:?><span class="price"><?=CurrencyFormat($arElement["PROPERTIES"]["RETAIL_PRICE_MIN"]["VALUE"], "RUB")?></span><?endif?>
				</div>
				<hr/>
				<div class="item_buy">
					<a class="btn_buy" href="<?=$arElement["DETAIL_PAGE_URL"]?>"></a>
				</div>
			</div>
		</div>
	</div>
<?endforeach;?>
<div class="clear"></div>

<?if(strLen($arResult["DESCRIPTION"])>0):?>
	<?//echo $arResult["DESCRIPTION"];?>
<?endif?>

</div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>