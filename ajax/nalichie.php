<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


if( CModule::IncludeModule("iblock") && CModule::IncludeModule("catalog") ) {
	
	$product_id=intVal($_GET["ID"]);
	
	$dbRes = CIBlockElement::GetByID($product_id);
	if($arProduct = $dbRes->Fetch()) {
		//print_r($arRes);
		}
	//echo $product_id."<hr/>";
	
	$dbRes = CIBlockElement::GetList(
		Array("SORT" => "asc"),
		Array("IBLOCK_ID" => OFFERS_IBLOCK_ID, "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $product_id),
		false,
		false,
		Array("ID", "NAME", "PROPERTY_SIZE", "PROPERTY_COLOR", "CATALOG_QUANTITY")
		);
	$arResult = Array();
	$arSizes = Array();
	$arColors = Array();
	while($arRes = $dbRes->GetNext()) {
		$arResult[$arRes["PROPERTY_COLOR_VALUE"]]["SIZES"][$arRes["PROPERTY_SIZE_VALUE"]]=$arRes["CATALOG_QUANTITY"];
		$arColors[$arRes["PROPERTY_COLOR_VALUE"]]=1;
		$arSizes[$arRes["PROPERTY_SIZE_VALUE"]]=1;
		}
		
	ksort($arSizes);
	//print_r($arColors); 
	
	
	if(count($arColors)>0) 
	{
		$arColorsIds=Array();
		foreach($arColors as $k=>$v) $arColorsIds[]=$k;
		//prn($arColorsIds);
		$dbResCol = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => 8, "XML_ID"=>$arColorsIds),
			false,
			false,
			Array("ID", "NAME", "XML_ID", "DETAIL_PICTURE")
			);
		
		while($arResCol = $dbResCol->GetNext()) {
			//prn($arResCol);
			$arResult[$arResCol["XML_ID"]]["NAME"] = $arResCol["NAME"];
			$arResult[$arResCol["XML_ID"]]["PREVIEW_IMG"] = CFile::ResizeImageGet(
				$arResCol["DETAIL_PICTURE"],
				array("width" => 30, "height" => 30),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true, 
				false
			);
			$arResult[$arResCol["XML_ID"]]["DETAIL_IMG"] = CFile::ResizeImageGet(
				$arResCol["DETAIL_PICTURE"],
				array("width" => 150, "height" => 150),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true, 
				false
			);
		}
	
	}
	
	
	?>
	
	<h1 style="margin-top:0;"><?=$arProduct["NAME"]?></h1>
	<table class="nalichie" cellpadding="5" cellspacing="1">
		<tr>
			<td>Цвет/Размер</td>
			<?foreach($arSizes as $k=>$v):?>
			<td><?=$k?></td>
			<?endforeach?>
		</tr>
		<?foreach($arResult as $color_code=>$sizes):?>
			<tr>
			<td>
				<?if(is_array($sizes["PREVIEW_IMG"])):?>
					<div class="jx_color_img">
						<img alt="<?=$title?>" title="<?=$title?>" src="<?=$sizes["PREVIEW_IMG"]["src"]?>">
					</div>
				<?else:?>
					<div class="jx_color_img">
						<img alt="<?=$title?>" title="<?=$title?>" src="/assets/images/no-color.png">
					</div>
				<?endif?>
				<?=$sizes["NAME"] ? $sizes["NAME"] : $color_code?>
			</td>
			<?foreach($arSizes as $k=>$v):?>
				<td>
				<?if($arResult[$color_code]["SIZES"][$k]>0):?>
					<?if($arResult[$color_code]["SIZES"][$k]>10):?>
						<span title="более 10 шт." class="nal_many" style="cursor:default; width:15px; background-position:center -28px;"></span>
					<?elseif($arResult[$color_code]["SIZES"][$k]>0):?>
						<span title="<?=$arResult[$color_code]["SIZES"][$k]?> шт." class="nal_few" style="width:15px; background-position:center -14px;"></span>
					<?endif?>
				<?else:?>
					<img src="/assets/images/no_nal1.png">
				<?endif?>
				</td>
			<?endforeach?>
			</tr>
		<?endforeach?>
	</table>
	


	
	<?

}



?>
