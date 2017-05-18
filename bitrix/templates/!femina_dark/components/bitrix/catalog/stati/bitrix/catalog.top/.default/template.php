<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="catalog-top">



	<?foreach($arResult["stati"] as $ks => $arSect):?>
		<h2><?=$arSect["SECTION_NAME"]?></h2>
		<?if(count($arSect["ITEMS"])>0):?>
			<?if(strLen($ks)<1) continue;?>
			<ul>
			<?foreach($arSect["ITEMS"] as $k => $arItem):?>
				<?if(strLen($k)>0):?>
					<li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></li>
				<?endif?>
			<?endforeach?>
			</ul>
		<?endif?>
	<?endforeach?>



</div>
