<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(is_array($arResult["DETAIL_PICTURE"]))
{


	$arResult["DETAIL_IMG"] = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE'],
		array("width" => 333, "height" => 500),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		true,
		$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
				
	$arResult["ORIGINAL_IMG"] = CFile::ResizeImageGet(
		$arResult['DETAIL_PICTURE'],
		array("width" => 550, "height" => 800),
		BX_RESIZE_IMAGE_PROPORTIONAL, 
		true,
		$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					//"position" => "center", 
					"alpha_level" => "30", 
					"size"=>"big", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
			
	/*
	prn($arResult["DETAIL_PICTURE"]);
	prn($arResult["DETAIL_IMG"]);
	prn($arResult["ORIGINAL_IMG"]);
	*/
}

//pra($arResult['MORE_PHOTO']);

if (is_array($arResult['MORE_PHOTO']) && count($arResult['MORE_PHOTO']) > 0)
{
	unset($arResult['DISPLAY_PROPERTIES']['MORE_PHOTO']);

	foreach ($arResult['MORE_PHOTO'] as $key => $arFile)
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array("name" => "sharpen", "precision" => $arParams["SHARPEN"]);
		}
		$arFileTmp = CFile::ResizeImageGet(
			$arFile,
			array("width" => $arParams["DISPLAY_MORE_PHOTO_WIDTH"], "height" => $arParams["DISPLAY_MORE_PHOTO_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, $arFilter
		);
		
		
		/* ========= ЗАГОТОВКА ДЛЯ ФОТО ПО КЛИКУ =======
		$arFileMoreOriginal = CFile::ResizeImageGet(
			$arFile,
			array("width" => 332, "height" => 500),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
		*/
		
		$arFileOriginal = CFile::ResizeImageGet(
			$arFile,
			array(),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_big_".$arResult["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
		
		

		$arFile['PREVIEW_WIDTH'] = $arFileTmp["width"];
		$arFile['PREVIEW_HEIGHT'] = $arFileTmp["height"];

		$arFile['SRC'] = $arFileTmp['src'];
		$arResult['MORE_PHOTO'][$key] = $arFile;
		$arResult['MORE_PHOTO'][$key]["ORIGINAL"] = $arFileOriginal;
		//$arResult['MORE_PHOTO'][$key]["FOR_MAIN_PICTURE"] = $arFileMoreOriginal;     // ДЛЯ ФОТО ПО КЛИКУ
	}
	
	//prn($arResult);
	
}



// Создадим таблицу для выбора торговых предложений
// выберем правильные названия цветов и их изображения

$arTmpColors=Array();
$arTmpSizes=Array();
$arColorVars=Array();
foreach($arResult["OFFERS"] as $key => $offer) {
	$arTmpColors[$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
	$arTmpSizes[$offer["PROPERTIES"]["SIZE"]["PROPERTY_VALUE_ID"]]=$offer["PROPERTIES"]["SIZE"]["VALUE"];
	if((!in_array($offer["PROPERTIES"]["COLOR"]["VALUE"], $arColorVars))&&(strLen($offer["PROPERTIES"]["COLOR"]["VALUE"])>0)) $arColorVars[]=$offer["PROPERTIES"]["COLOR"]["VALUE"];
	}
$arColors=Array();
$arSizes=Array();
foreach($arTmpColors as $k=>$v) if(trim($v)!="") $arColors[$v]["ITEMS"][]=$k;
foreach($arTmpSizes as $k=>$v) if(trim($v)!="") $arSizes[$v][]=$k;

//prn($arColors);
if(count($arColors)>0) 
{
	$arSelect = Array("NAME","XML_ID","DETAIL_PICTURE");
	$arFilter = Array("IBLOCK_ID"=>8, "XML_ID" => $arColorVars);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($arFields = $res->GetNext()) {
		$arColors[$arFields["XML_ID"]]["DISPLAY_NAME"]=$arFields["NAME"];
		$arColors[$arFields["XML_ID"]]["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 30, "height" => 30), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arColors[$arFields["XML_ID"]]["DETAIL_PICTURE"] = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array("width" => 150, "height" => 150), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		}

	ksort($arSizes);
	ksort($arColors);

	$arResult["SKU_TABLE"]=Array(
		"COLORS" => $arColors,
		"SIZES" => $arSizes
		);

		
		
		
		
	// Перечень существующих значений цветов (для подсветки цветов которые есть в наличии при загрузке страницы)
	$arExColors = Array();
	foreach($arResult["OFFERS"] as $key=>$offer) {
		if($offer["CATALOG_QUANTITY"]>0) {
			$arExColors[]=$offer["PROPERTIES"]["COLOR"]["PROPERTY_VALUE_ID"];
			}
		}
	$arResult["EXIST_COLORS"]=$arExColors;

	// Если нет ни одного товара в наличии то ставим параметр NO_QUANTITY
	if(count($arResult["EXIST_COLORS"])<1) $arResult["NO_QUANTITY"]="Y";
}

//prn($arResult);

?>