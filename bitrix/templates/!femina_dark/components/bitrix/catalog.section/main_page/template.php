<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$APPLICATION->AddHeadScript("/assets/js/plugins.js");
$APPLICATION->AddHeadScript("/assets/js/sly.min.js");
?>
<?=constant($section_code."_NAME")?>



<script>
$(document).ready( function() {
// Call Sly on frame
	<?foreach($arResult["SLIDES"] as $section_code => $slide):?>
	var $frame  = $('#slider_<?=$section_code?>');
	var $slidee = $frame.children('ul').eq(0);
	var $wrap   = $frame.parent();
	$frame.sly({
		horizontal: 1,
		itemNav: 'basic',
		smart: 0,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 0,
		scrollBar: $wrap.find('.scrollbar'),
		scrollBy: 1,
		pagesBar: $wrap.find('.pages'),
		activatePageOn: 'click',
		speed: 300,
		elasticBounds: 1,
		easing: 'easeOutExpo',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,
		// Buttons
		prevPage: $wrap.find('.prevPage'),
		nextPage: $wrap.find('.nextPage')
	});
	<?endforeach?>
});
</script>


<div class="slider_wrapper">

	<div class="tab_nav_wrapper" style="position: relative;">
		<ul class="tabs bl">
			<?foreach($arResult["SLIDES"] as $section_code => $section):?>
			<li class="tab_<?=$section_code?> bl" style="background-color:<?=constant($section_code."_COLOR")?>"><a href="#tab_<?=$section_code?>"><?=constant($section_code."_NAME")?></a></li>
			<?endforeach?>
		</ul>
	</div>

	<div class="tab_container" style="position: relative;">
	<?foreach($arResult["SLIDES"] as $section_code => $section):?>
		<div id="tab_<?=$section_code?>" class="tab_content">
		
			<div class="collection_link"><a href="<?=$arResult["SLIDES_SECTS_DATA"][$section_code]["SECTION_PAGE_URL"]?>">Перейти к коллекции</a></div>

			<div class="wrap">

				<div class="controls center cleft">
					<button class="btn prevPage"></button>
				</div>

				<div class="frame" id="slider_<?=$section_code?>" style="overflow: hidden;">
					<ul class="clearfix" style="-webkit-transform: translateZ(0px) translateX(-3648px); width: 6840px;">
					<?foreach($section as $slide):?>
						<li class="active">
							<div class="slide_img_wrapper">
								<a title="<?=$slide["COLLECTION"]." ".$slide["NAME"]?>" href="<?=$slide["DETAIL_PAGE_URL"]?>">
									<?if(is_array($slide["PREVIEW_IMG"])):?><img src="<?=$slide["PREVIEW_IMG"]["src"]?>"/><?endif?>
								</a>
							</div>
							<div class="slide_prod_title"><a href="<?=$slide["DETAIL_PAGE_URL"]?>"><?=$slide["NAME"]?></a></div>
							<div class="slide_prod_price"><?=$slide["PRICE"]?></div>
						</li>
					<?endforeach?>
					</ul>
				</div>

				<div class="controls center cright">
					<button class="btn nextPage"></button>
				</div>

			</div>



		</div>
	<?endforeach?>
	</div>


</div>


