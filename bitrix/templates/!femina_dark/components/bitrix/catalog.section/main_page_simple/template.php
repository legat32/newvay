<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->AddHeadScript("/assets/js/plugins.js");
$APPLICATION->AddHeadScript("/assets/js/sly.min.js");
?>
<?=constant($section_code."_NAME")?>
<div class="slider_wrapper">

	<div class="tab_nav_wrapper" style="position: relative;">
		<ul class="tabs bl">
			<?foreach($arResult["SECTIONS"] as $section_code => $section):?>
			<?
				if($section_code == "MUZHSKOY-TRIKOTAZH")
					$section_code = "VAYMAN";
			?>
			<li class="tab_<?=$section_code?> bl" style="background-color:<?=constant(str_replace("-", "", str_replace("_", "", $section_code))."_COLOR")?>"><a href="<?=$section["SECTION_PAGE_URL"]?>"><?=constant(str_replace("-", "", str_replace("_", "", $section_code))."_NAME")?></a></li>
			<?endforeach?>
		</ul>
	</div>

	<div class="tab_container" style="position: relative;">

		<div class="wrap" id="mainpage_slider">

			<div class="controls center cleft">
					<button class="btn prevPage"></button>
				</div>

				<div class="frame" id="slider" style="overflow: hidden;">
					<ul class="clearfix" style="-webkit-transform: translateZ(0px) translateX(-3648px); width: 6840px;">
					<?foreach($arResult["SLIDES"] as $arSlide):?>
						<li class="active">
							<div class="slide_img_wrapper">
								<a title="<?=$arSlide["COLLECTION"]?> <?=$arSlide["NAME"]?>" href="<?=$arSlide["DETAIL_PAGE_URL"]?>">
									<?if(is_array($arSlide["PREVIEW_IMG"])):?><img src="<?=$arSlide["PREVIEW_IMG"]["src"]?>" alt="<?=$arSlide["NAME"]?>" title="<?=$arSlide["NAME"]?>" /><?endif?>
								</a>
							</div>
							<div class="slide_prod_title"><a href="<?=$arSlide["DETAIL_PAGE_URL"]?>"><?=$arSlide["NAME"]?></a></div>
							<div class="slide_prod_price">
								<?if(!defined("PRICE_TYPE") && $USER->isAuthorized() ):?>
									<a class="buy-register fancybox-html" href="#">Ожидает подтверждения</a>
								<?else:?>
									<?=$arSlide["PRICE"]?>
								<?endif?>
							</div>
						</li>
					<?endforeach?>
					</ul>
				</div>

				<div class="controls center cright">
					<button class="btn nextPage"></button>
				</div>

			</div>



		</div>

	</div>


</div>


