<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//echo time()."<hr/>";
	// определим цвет и название коллекции
	/*switch ($arResult["IBLOCK_SECTION_ID"]) {
		case VAY_SECTION_ID: {
			$arResult["COLLECTION_COLOR"]=VAY_COLOR;
			$arResult["COLLECTION_NAME"]=VAY_NAME;  
			break;
			}
		case JW_SECTION_ID: {
			$arResult["COLLECTION_COLOR"]=JW_COLOR;
			$arResult["COLLECTION_NAME"]=JW_NAME;
			break;
			}
		case VAYKIDS_SECTION_ID: {
			$arResult["COLLECTION_COLOR"]=VAYKIDS_COLOR;
			$arResult["COLLECTION_NAME"]=VAYKIDS_NAME;
			break;
			}
		case VESNUSHKI_SECTION_ID: {
			$arResult["COLLECTION_COLOR"]=VESNUSHKI_COLOR;
			$arResult["COLLECTION_NAME"]=VESNUSHKI_NAME;
			break;
			}
		}
	*/
	
	// —формируем дополнительные параметры
	foreach($arResult["ITEMS"] as $key=>$arElement) {
		$arResult["ITEMS"][$key]["COLLECTION_NAME"]=constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_NAME");
		$arResult["ITEMS"][$key]["COLLECTION_COLOR"]=constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_COLOR");
		$arResult["ITEMS"][$key]["TITLE"]=$arResult["ITEMS"][$key]["COLLECTION_NAME"]." ".$arElement["NAME"];
		if(is_array($arElement["DETAIL_PICTURE"])) {
			$arResult["ITEMS"][$key]["PREVIEW_IMG"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 100, "height" => 150), BX_RESIZE_IMAGE_EXACT, true);
			}
		}
		
		
	//echo "<pre>";
	//prn($arResult);
	//echo "</pre>";
		
?>
