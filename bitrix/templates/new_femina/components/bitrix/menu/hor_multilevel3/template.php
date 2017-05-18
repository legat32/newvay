<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul id="horizontal-multilevel-menu">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
	<?
	if(intVal($arItem["ID"]) > 0) $url_class = "sect-".$arItem["ID"];
	else $url_class = str_replace("/", "", str_replace("-", "", $arItem["LINK"]));
	?>
	
	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>
	<?if ($arItem["IS_PARENT"]):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="<?=$url_class?> contains"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
				<ul class='level-<?=$arItem["DEPTH_LEVEL"]?>'>
		<?else:?>
			<li class="<?=$url_class?><?if($arItem["SELECTED"]):?> item-selected<?endif?>"><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
				<ul class='level-<?=$arItem["DEPTH_LEVEL"]?>'>
		<?endif?>
	<?else:?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="<?=$url_class?>"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li class="<?=$url_class?><?if ($arItem["SELECTED"]):?> item-selected<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>
	<?endif?>
	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
</ul>
<?endif?>
<?//prn($arResult);?>