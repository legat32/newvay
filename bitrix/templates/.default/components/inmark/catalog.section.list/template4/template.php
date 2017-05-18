<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="sideblock_title">Каталог товаров</div>
	<div class="grey">

		<ul class="menu accordion" id="accordion">
		<?
		$previousLevel = 0;
		foreach($arResult as &$arItem):?>
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>		
			<?if($arItem["IS_PARENT"]):?>		
				<?
				$class_color="";
				if(strpos(" ".$arItem["LINK"], "/vay/")>0) $class_color=" vay";
				if(strpos(" ".$arItem["LINK"], "/detskiy-trikotazh/")>0) $class_color=" det";
				if(strpos(" ".$arItem["LINK"], "/vay-kids/")>0) $class_color=" vaykids";
				if(strpos(" ".$arItem["LINK"], "/vesnushki/")>0) $class_color=" vesnushki";
				?>
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li><a href="<?=$arItem["LINK"]?>" class="<?=$class_color?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?else:?>
					<li><a href="<?=$arItem["LINK"]?>" class="<?=$class_color?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?endif?>		
			<?else:?>		
				<?if ($arItem["PERMISSION"] > "D"):?>		
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>		
				<?else:?>		
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>		
				<?endif?>		
			<?endif?>		
			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>		
		<?endforeach?>		
		<?if ($previousLevel > 1)://close last item tags?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>		
		</ul>
		
	</div>
<?endif?>
<?
//pra($arResult);
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>