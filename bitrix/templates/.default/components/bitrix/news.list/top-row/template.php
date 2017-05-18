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

<?if(count($arResult["ITEMS"])>0):?>
	<!-- noindex -->
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="top-row" style="background-color: <?=$arItem["PROPERTIES"]["BACKGROUND_COLOR"]["VALUE"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<h2 style="color: <?=$arItem["PROPERTIES"]["COLOR"]["VALUE"]?>"><?=$arItem["NAME"];?><?if(strLen(trim($arItem["PREVIEW_TEXT"]))>0):?> <i class="fa fa-caret-down"></i><?endif?></h2>
		</div>
		<?if(strLen(trim($arItem["PREVIEW_TEXT"]))>0):?>
		<div class="top-row-2" style="background-color: <?=$arItem["PROPERTIES"]["BACKGROUND_COLOR"]["VALUE"]?>">
			<div class="top-row-2-inner" style="color: <?=$arItem["PROPERTIES"]["COLOR"]["VALUE"]?>">
				<?=$arItem["PREVIEW_TEXT"]?>
			</div>
		</div>
		<?endif?>
	<?endforeach?>
	<script>
	$(document).ready( function() {
		$(".top-row").click( function() {
			if($(".top-row").find(".fa-caret-down").size()>0) {
				$(".top-row").find(".fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-up");
				$(".top-row-2").slideDown();
			}
			else 
			if($(".top-row").find(".fa-caret-up").size()>0) {
				$(".top-row").find(".fa-caret-up").removeClass("fa-caret-up").addClass("fa-caret-down");
				$(".top-row-2").slideUp();
			};
			
		});
	});
	</script>
	<!-- /noindex -->
<?endif?>