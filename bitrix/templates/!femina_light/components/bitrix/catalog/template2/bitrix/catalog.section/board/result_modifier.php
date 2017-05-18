<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


//pra($arResult);

/*
foreach($arResult["ITEMS"] as &$arItem) {
	$arItem["DETAIL_PICTURE"] = $arItem["~DETAIL_PICTURE"];
}


/*
foreach($arResult["ITEMS"] as $arItem) {
	echo "<hr/>".$arItem["NAME"]."<hr/>";
	foreach($arItem["OFFERS"] as $arOffer) {
		echo $arOffer["PROPERTIES"]["SIZE"]["VALUE"]." - ".$arOffer["PROPERTIES"]["COLOR"]["VALUE"]." = ".implode(", ", $arOffer["PROPERTIES"]["COLOR_TONE"]["VALUE"])."<br/>";
		}
	}
*/



// подготовим массив для корректировки адресов карточек товара (перенесено в init.php)
global $arDetailPageURL;



// Добавим имя коллекции к заголовку страницы (устанавливается в section.php через переменную GLOBALS["title"])
$t=$arResult["NAME"];
$dbRes = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
if($arRes = $dbRes->GetNext()) 
	$t.=" ".$arRes["NAME"];
$GLOBALS["title"]=$t;




$dbSection = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" =>$arResult["ID"]), false, array("UF_BROWSER_TITLE", "UF_TITLE_H1", "UF_KEYWORDS", "UF_META_DESCRIPTION"));
if ($arSection = $dbSection->GetNext())
{
	$arResult["SECTION_USER_FIELDS"]["UF_BROWSER_TITLE"] 		= $arSection["UF_BROWSER_TITLE"];
	$arResult["SECTION_USER_FIELDS"]["UF_TITLE_H1"] 			= $arSection["UF_TITLE_H1"];
	$arResult["SECTION_USER_FIELDS"]["UF_KEYWORDS"] 			= $arSection["UF_KEYWORDS"];
	$arResult["SECTION_USER_FIELDS"]["UF_META_DESCRIPTION"] 	= $arSection["UF_META_DESCRIPTION"];
}


// Сформируем значения коллекции у каждого элемента и обработаем превью
foreach($arResult["ITEMS"] as $key=>$arElement) {

	if(!defined("PRICE_TYPE")) 
	{
		unset($arResult["ITEMS"][$key]["PROPERTIES"]["JOINT_PRICE_MIN"]);
		unset($arResult["ITEMS"][$key]["PROPERTIES"]["JOINT_PRICE_MAX"]);
		unset($arResult["ITEMS"][$key]["PROPERTIES"]["DEALER_PRICE_MIN"]);
		unset($arResult["ITEMS"][$key]["PROPERTIES"]["DEALER_PRICE_MAX"]);
		unset($arResult["ITEMS"][$key]["PROPERTIES"]["RETAIL_PRICE_MIN"]);
		unset($arResult["ITEMS"][$key]["PROPERTIES"]["RETAIL_PRICE_MAX"]);
	}

	// заменим адрес карточки товара на правильный
	$arResult["ITEMS"][$key]["DETAIL_PAGE_URL"] = $arDetailPageURL[$arElement["ID"]];
	
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


//pra($arResult);


// cache hack to use items list in component_epilog.php
/*
$this->__component->arResult["IDS"] = array();
$this->__component->arResult["DELETE_COMPARE_URLS"] = array();
$this->__component->arResult["SECTION_USER_FIELDS"] = $arResult["SECTION_USER_FIELDS"];
$this->__component->arResult["OFFERS_IDS"] = array();
*/
/*
$this->__component->SetResultCacheKeys(array("IDS"));
$this->__component->SetResultCacheKeys(array("DELETE_COMPARE_URLS"));
$this->__component->SetResultCacheKeys(array("SECTION_USER_FIELDS"));
$this->__component->SetResultCacheKeys(array("OFFERS_IDS"));
*/

?>