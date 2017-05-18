<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	

	// Сформируем дополнительные параметры
	foreach($arResult["ITEMS"] as $key=>$arElement) {
		$arResult["ITEMS"][$key]["COLLECTION_NAME"]=constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_NAME");
		$arResult["ITEMS"][$key]["COLLECTION_COLOR"]=constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_COLOR");
		$arResult["ITEMS"][$key]["TITLE"]=$arResult["ITEMS"][$key]["COLLECTION_NAME"]." ".$arElement["NAME"];
		if(is_array($arElement["DETAIL_PICTURE"])) {
			$arResult["ITEMS"][$key]["PREVIEW_IMG"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 100, "height" => 150), BX_RESIZE_IMAGE_EXACT, true);
			}
		}
		
	//prn($arResult);
		
		
	// Отсортируем массив ITEMS в порядке следования ID в фильтре
	$new=Array();
	$order=$GLOBALS[$arParams["FILTER_NAME"]]["ID"];
	$order=array_flip($order);
	foreach($arResult["ITEMS"] as $key => $item) 
		$new[$order[intVal($item["ID"])]]=$item;
	ksort($new);
	$arResult["ITEMS"]=$new;
	
	

	?>
