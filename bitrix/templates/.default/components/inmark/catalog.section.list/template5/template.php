<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if(strpos(" ".$_SERVER["SCRIPT_URL"], ".html") > 0)
{
	$t = explode("/", $_SERVER["SCRIPT_URL"]);
	$t[count($t)-1] = "";
	$script_url = implode("/", $t);
}
else 
	$script_url = $_SERVER["SCRIPT_URL"];
?> 

<?if (!empty($arResult)):?>
	<div class="sideblock_title">Каталог товаров</div>
	<div class="grey">

		<ul class="menu accordion" id="accordion-1">
		<?
		$previousLevel = 0;
		foreach($arResult as &$arItem):?>
			<?
			$current = false;
			if($script_url == $arItem["LINK"]) $current = true;
			?>
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>		
			<?if($arItem["IS_PARENT"]):?>		
				<?
				$class_color="";
				//if(strpos(" ".$arItem["LINK"], "/vay/")>0) $class_color=" vay";
				//if(strpos(" ".$arItem["LINK"], "/detskiy-trikotazh/")>0) $class_color=" det";
				//if(strpos(" ".$arItem["LINK"], "/vay-kids/")>0) $class_color=" vaykids";
				//if(strpos(" ".$arItem["LINK"], "/vesnushki/")>0) $class_color=" vesnushki";
				?>
				<?if($arItem["DEPTH_LEVEL"] == 1):?>
					<li class="lev-<?=$arItem["DEPTH_LEVEL"]?><?if($current):?> active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?=$class_color?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?else:?>
					<li class="lev-<?=$arItem["DEPTH_LEVEL"]?><?if($current):?> active<?endif?>"><a href="<?=$arItem["LINK"]?>" class="<?=$class_color?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?endif?>		
			<?else:?>		
				<?if ($arItem["PERMISSION"] > "D"):?>		
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li class="lev-<?=$arItem["DEPTH_LEVEL"]?><?if($current):?> active<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li class="lev-<?=$arItem["DEPTH_LEVEL"]?><?if($current):?> active<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>		
				<?else:?>		
					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li class="lev-<?=$arItem["DEPTH_LEVEL"]?><?if($current):?> active<?endif?>"><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?else:?>
						<li class="lev-<?=$arItem["DEPTH_LEVEL"]?><?if($current):?> active<?endif?>"><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
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