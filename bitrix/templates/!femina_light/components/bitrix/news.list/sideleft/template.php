<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?if(count($arResult["ITEMS"])>0):?>
	<ul>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<li><a title="<?=$arItem["NAME"]?>" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></li>
	<?endforeach?>
	</ul>
	<hr style="width:80%; height:1px; border:none; border-top:1px dashed #999;"/>
<?endif?>	
	<ul>
		<li><a href="/razmery.html">Размерные ряды</a></li>
		<li><a href="/colors.html">Наши цвета и пряжи</a></li>
	</ul>
	
