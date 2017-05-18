<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if($arResult["DETAIL_PICTURE"]>0) {
	$arFile = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE'],
		Array("width" => 180, "height" => 270),
		BX_RESIZE_IMAGE_PROPORTIONAL,
		true, 
		Array(
			Array(
				"name" => "watermark", 
				"position" => "bottom right", 
				"alpha_level" => "30", 
				"size"=>"real", 
				"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_".$arResult["PROPERTY_COLLECTION_VALUE"].".png"
				)
			)
		);
	}

//pra($arResult);

$title = constant($arResult["PROPERTY_COLLECTION_VALUE"]."_NAME")." ".$arResult["NAME"];
$color = constant($arResult["PROPERTY_COLLECTION_VALUE"]."_COLOR");

?>


<div class="photo-random">
	<?if(is_array($arFile)):?>
		<a title="<?=$title?>" href="<?=$arResult["DETAIL_PAGE_URL"]?>">
			<img style="border-color:<?=$color?>" src="<?=$arFile["src"]?>" width="<?=$arFile["width"]?>" height="<?=$arFile["height"]?>" alt="<?=$title?>" title="<?=$title?>" />
		</a>
		<br />
	<?endif?>
	<a href="<?=$arResult["DETAIL_PAGE_URL"]?>"><?=$arResult["NAME"]?></a>
</div>
