<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//prn($arResult)?>

<?if($arResult["SECTION"]["DEPTH_LEVEL"]==0):?>

	
	
	<div id="section-list-lev0">
	<?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;

	foreach($arResult["SECTIONS"] as $arSection):
		//echo $arSection["ELEMENT_CNT"]."<hr/>";
		if($arSection["ELEMENT_CNT"] < 1) continue;
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
		if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
			echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH),"<ul class='lsnn'>";
		elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
			echo "</li>";
		else
		{
			while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
			{
				echo "</li>";
				echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
				if($CURRENT_DEPTH == 2) echo "<hr class='divider'/>";
				$CURRENT_DEPTH--;
			}
			echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</li>";
		}

		echo "\n",str_repeat("\t", $arSection["DEPTH_LEVEL"]-$TOP_DEPTH);
		?><li id="<?=$this->GetEditAreaId($arSection['ID']);?>">
			<?if($arSection["DEPTH_LEVEL"]==1):?>
				<?if(!empty($arSection["DETAIL_PICTURE"])):?>
					<?$img = CFile::GetFileArray($arSection["DETAIL_PICTURE"]);?>
					<div class="sect_img"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img width="<?=$img["WIDTH"]?>" height="<?=$img["HEIGHT"]?>" src="<?=$img["SRC"]?>"/></a></div>
				<?else:?>
					<div class="sect_img_blank"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"></a></div>
				<?endif?>
			<?endif?>
			<a class="sect_title" href="<?=$arSection["SECTION_PAGE_URL"]?>">
				<?=$arSection["NAME"]?>
				<?//if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?//endif;?>
			</a>
		<?/*if(($arSection["DEPTH_LEVEL"]==1)&&(strLen($arSection["DESCRIPTION"])>0)):?>
				<span class="descr"><?=$arSection["DESCRIPTION"]?></span>
<?endif*/?>

			<?

		$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
	endforeach;

	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</li>";
		echo "\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH),"</ul>","\n",str_repeat("\t", $CURRENT_DEPTH-$TOP_DEPTH-1);
		$CURRENT_DEPTH--;
	}
	?>
	</div>
	
<?endif?>








<?if($arResult["SECTION"]["DEPTH_LEVEL"]==1):?>
	<?if(count($arResult["SECTIONS"])>0):?>
		<div id="section-list-lev1">
			<ul>
			<?foreach($arResult["SECTIONS"] as $arItem):?>
				<?if($arItem["DEPTH_LEVEL"]==2):?> 
					<li><a href="<?=$arItem["SECTION_PAGE_URL"]?>"><?=$arItem["NAME"]?></a><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arItem["ELEMENT_CNT"]?>)<?endif;?></li>
				<?endif?>
			<?endforeach?>
			</ul>
		</div>
	<?endif?>
<?endif?>
