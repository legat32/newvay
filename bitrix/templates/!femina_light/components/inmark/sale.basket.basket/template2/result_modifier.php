<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($GLOBALS["ERROR_LIMIT"] as $mess) 
{
	$arResult["WARNING_MESSAGE"][] = $mess;
}

$emptyBasket = true;
$arOfferIDs = Array();
foreach($arResult["ITEMS"] as $type => $arType)
{
	foreach($arType as $itemID => $arItem)
	{
		$emptyBasket = false;
		$arOfferIDs[] = $arItem["PRODUCT_ID"];
	}
}

if(!$emptyBasket)
{
	$arImages = Array();
	$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ID" => $arOfferIDs), false, false, Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.DETAIL_PICTURE", "PROPERTY_CML2_LINK.PROPERTY_MORE_PHOTO"));
	while($arRes = $dbRes->GetNext())
	{
		if(!is_array($arImages[$arRes["PROPERTY_CML2_LINK_VALUE"]][$arRes["PROPERTY_CML2_LINK_DETAIL_PICTURE"]]))
		{
			$img = CFile::GetFileArray($arRes["PROPERTY_CML2_LINK_DETAIL_PICTURE"]);
			$arImages[$arRes["PROPERTY_CML2_LINK_VALUE"]][$arRes["PROPERTY_CML2_LINK_DETAIL_PICTURE"]] = Array(
				"NAME" => $img["DESCRIPTION"],
				"SRC" => $img["SRC"]
				);
			$arImg[$arRes["PROPERTY_CML2_LINK_DETAIL_PICTURE"]] = Array(
				"NAME" => $img["DESCRIPTION"],
				"SRC" => $img["SRC"]
				);
		}
		
		$img = CFile::GetFileArray($arRes["PROPERTY_CML2_LINK_PROPERTY_MORE_PHOTO_VALUE"]);
		$arImages[$arRes["PROPERTY_CML2_LINK_VALUE"]][$arRes["PROPERTY_CML2_LINK_PROPERTY_MORE_PHOTO_VALUE"]] = Array(
			"NAME" => $img["DESCRIPTION"],
			"SRC" => $img["SRC"]
			);
		$arImg[$arRes["PROPERTY_CML2_LINK_PROPERTY_MORE_PHOTO_VALUE"]] = Array(
				"NAME" => $img["DESCRIPTION"],
				"SRC" => $img["SRC"]
				);
	};
	
	
	foreach($arResult["ITEMS"] as $type => $arType)
	{
		foreach($arType as $itemID => $arItem)
		{
			//$emptyBasket = false;
			//$arOfferIDs[] = $arItem["PRODUCT_ID"];
			//pra($arItem["PROPS"][0]["VALUE"]);
			
			foreach($arImg as $key => $arPicture)
			{
				//pra($arItem["PROPS"][0]["VALUE"]);
				//pra($arPicture["NAME"]);
				if(strpos(" ".$arPicture["NAME"], $arItem["PROPS"][0]["VALUE"]) > 0)
				{
					//pra($arPicture["NAME"]);
					//pra($arPicture);
					
					$arFile = CFile::ResizeImageGet(
						$key,
						array("width" => 110, "height" => 110),
						BX_RESIZE_IMAGE_PROPORTIONAL,  
						true/*, 
						$arFilters = Array(
							array(
								"name" => "watermark", 
								"position" => "bottom right", 
								"alpha_level" => "30", 
								"size"=>"real", 
								"file"=>$_SERVER['DOCUMENT_ROOT']."/upload/watermarks/logo_".$arElement["PROPERTIES"]["COLLECTION"]["VALUE"].".png"
								)
							)
						*/
						);
					
					
					$arResult["ITEMS"][$type][$itemID]["PREVIEW_PICTURE"] = $arFile;
					
					break;
				}
				//pra($arPicture);
			}

		}
	}
	
	
	
	
}





	
//pra($arResult);


?>