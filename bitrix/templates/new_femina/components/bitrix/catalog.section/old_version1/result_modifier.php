<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



// Сформируем значения коллекции у каждого элемента и обработаем превью
foreach($arResult["ITEMS"] as $key=>$arElement) {




	
	// установим название, цвет и title для подписи картинок
	$arResult["ITEMS"][$key]["COLLECTION_NAME"] 		= constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_NAME");
	$arResult["ITEMS"][$key]["COLLECTION_COLOR"] 		= constant($arElement["PROPERTIES"]["COLLECTION"]["VALUE"]."_COLOR");
	$arResult["ITEMS"][$key]["TITLE"] 					= $arResult["ITEMS"][$key]["COLLECTION_NAME"]." ".$arElement["NAME"];
	
	// сделаем превью с watermark
	if(is_array($arElement["DETAIL_PICTURE"])) {
		$arFileTmp = CFile::ResizeImageGet(
			$arElement["DETAIL_PICTURE"],
			array("width" => 200, "height" => 300),
			BX_RESIZE_IMAGE_PROPORTIONAL,  
			true, 
			$arFilters = Array(
				array(
					"name" => "watermark", 
					"position" => "bottom right", 
					"alpha_level" => "30", 
					"size"=>"real", 
					"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_".$arElement["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
					)
				)
			);
		$arResult["ITEMS"][$key]["PREVIEW_IMG"] = array(
			"SRC" => $arFileTmp["src"],
			'WIDTH' => $arFileTmp["width"],
			'HEIGHT' => $arFileTmp["height"],
			);
		}	
	}

//prn($arResult);

?>