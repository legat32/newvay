<div class="structure">



<?if($arResult["SECTION"]["DEPTH_LEVEL"]==0):?>

<?foreach($arResult["SECTIONS"] as $arSection):?>
	<?if($arSection[DEPTH_LEVEL]==1):?>
		
		 <section class="s-<?=$arSection[ID]?>">
		 		<?if(!empty($arSection[DETAIL_PICTURE])):?>
					<?$img = CFile::GetFileArray($arSection[DETAIL_PICTURE]);?>
					
					<div class="section-image">
						<a href="<?=$arSection[SECTION_PAGE_URL]?>"><img width="<?=$img[WIDTH]?>" height="<?=$img[HEIGHT]?>" src="<?=$img[SRC]?>"/>
					</a>
					<div class="section-logo"></div>
					</div>
				<?else:?>
					<div class="sect_img_blank"><a href="<?=$arSection[SECTION_PAGE_URL]?>"></a></div>
				<?endif?>
                
                <div class="section-content section-<?=$arSection[ID];?>">
                    <a href="<?=$arSection[SECTION_PAGE_URL]?>">
                    <?/*?><h2><?=$arSection[IPROPERTY_VALUES][SECTION_PAGE_TITLE]?></h2><?*/?>
					<h2><?=$arSection["NAME"]?></h2>
                    <div class="count">МОДЕЛЕЙ:  <span><?=$arSection[ELEMENT_CNT]?></span></div>
                	</a>

                    
                    <?$parent_id = $arSection[ID];?>
                    <ul class="section-<?=$arSection[ID];?>">
                    <?foreach($arResult[SECTIONS] as $arSection):?>
					<?if(($arSection[DEPTH_LEVEL]>1)&&($arSection[IBLOCK_SECTION_ID]==$parent_id)):?>
						<li><a href="<?=$arSection[SECTION_PAGE_URL]?>"><?=$arSection[NAME]?>&nbsp;(<?=$arSection[ELEMENT_CNT]?>)</a>
						<?$parent_id_low = $arSection[ID];?>
						<ul class="section-<?=$arSection[ID];?>">
					<?foreach($arResult[SECTIONS] as $arSection):?>
					<?if(($arSection[DEPTH_LEVEL]>2)&&($arSection[IBLOCK_SECTION_ID]==$parent_id_low)):?>
						<li><a href="<?=$arSection[SECTION_PAGE_URL]?>"><?=$arSection[NAME]?>&nbsp;(<?=$arSection[ELEMENT_CNT]?>)</a>
						</li>
					<?endif?>
					<?endforeach;?>
						</ul>
						</li>
					<?endif?>
					<?endforeach;?>
                	</ul>
                </div>
            </section>
        <?endif?>
	<?endforeach;?>
	
<?endif?>
<?if($arResult["SECTION"]["DEPTH_LEVEL"]==1):?>
	<?if(count($arResult["SECTIONS"])>0):?>
		<div id="section-list-lev1">
			<ul>
			<?foreach($arResult["SECTIONS"] as $arItem):?>
				<?if($arItem["DEPTH_LEVEL"]==2):?> 
					<li><a href="<?=$arItem["SECTION_PAGE_URL"]?>"><?=$arItem["NAME"]?></a><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;<span><?=$arItem["ELEMENT_CNT"]?></span><?endif;?></li>
				<?endif?>
			<?endforeach?>
			</ul>
		</div>
	<?endif?>
<?endif?>
<?if($arResult["SECTION"]["DEPTH_LEVEL"]==2):?>
	<?if(count($arResult["SECTIONS"])>0):?>
		<div id="section-list-lev1">
			<ul>
			<?foreach($arResult["SECTIONS"] as $arItem):?>
				<?if($arItem["DEPTH_LEVEL"]==3):?> 
					<li><a href="<?=$arItem["SECTION_PAGE_URL"]?>"><?=$arItem["NAME"]?></a><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;<span><?=$arItem["ELEMENT_CNT"]?></span><?endif;?></li>
				<?endif?>
			<?endforeach?>
			</ul>
		</div>
	<?endif?>
<?endif?>
</div>