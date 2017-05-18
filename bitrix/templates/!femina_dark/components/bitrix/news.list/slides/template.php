<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<?if(count($arResult["ITEMS"]) > 0):?>
	<div id="akc_slider" style="margin-top:20px;">
		<div class="wrap">
			<div class="frame oneperframe" id="oneperframe"> 
				
				<ul class="clearfix">
					<?foreach($arResult["ITEMS"] as $arItem):?>
					<li>
						<?if(strLen($arItem["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]) > 0):?>
							<a href="<?=$arItem["DISPLAY_PROPERTIES"]["LINK"]["DISPLAY_VALUE"]?>">
								<img title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"/>
							</a>
						<?else:?>
							<img title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"/>
						<?endif?>
						
						<?if($arItem["ID"] == 13374626):?>
							<a class="linkWoman" href="/vay/?arrFilter_136_595022058=Y&arrFilter_137_274208589=Y&set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C">Женский ассортимент</a>
							<a class="linkChildren" href="/detskiy-trikotazh/?arrFilter_136_595022058=Y&arrFilter_137_274208589=Y&set_filter=%D0%9F%D0%BE%D0%BA%D0%B0%D0%B7%D0%B0%D1%82%D1%8C">Детский ассортимент</a>
						<?endif?>
						
						<?if($arItem["ID"] == 26351485):?>
							<a class="linkCRM" href="https://www.igedo-tickets.ru/" rel="nofollow" target="_blank">Получить бесплатное приглашение<br/>можно здесь</a>
						<?endif?>
						
					</li>
					<?endforeach?>
				</ul>
			</div>
			<?if(count($arResult["ITEMS"]) > 1):?>
			<ul class="pages">
				<?foreach($arResult["ITEMS"] as $num => $arItem):?>
				<li><?=$num?></li>
				<?endforeach?>
			</ul>
			<?endif?>
		</div>
	</div>
<?endif?>

