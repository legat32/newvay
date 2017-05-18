<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if($arResult["DETAIL_PICTURE"]>0) {
	$arFile = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE'],
		Array("width" => 200, "height" => 300),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true, Array()
		);
	}
?>

<div class="photo-random">
	<?if(is_array($arFile)):?>
		<a href="<?=$arResult["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arFile["src"]?>" width="<?=$arFile["width"]?>" height="<?=$arFile["height"]?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>" /></a><br />
	<?endif?>
	<a href="<?=$arResult["DETAIL_PAGE_URL"]?>"><?=$arResult["NAME"]?></a>
</div>
