<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["ITEMS"] as $arSection):?>
	<h2><?=$arSection["NAME"]?></h2>
	<?foreach($arSection["ITEMS"] as $arItem):?>
		<div class="color_item">
			<a class="color_tooltip">  
				<div class="color_img">
					<img src="<?=$arItem["PREVIEW_IMG"]["src"]?>">
				</div>
				<span>
					<img src="<?=$arItem["DETAIL_IMG"]["src"]?>">
				</span>
			</a>
			<div class="color_name"><?=$arItem["NAME"]?></div>
		</div>
	<?endforeach?>
	<div class="clear"></div>
<?endforeach?>
