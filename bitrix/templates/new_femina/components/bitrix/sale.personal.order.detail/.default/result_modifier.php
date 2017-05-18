<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$cp = $this->__component;
if (is_object($cp))
{
	CModule::IncludeModule('iblock');

	if(empty($arResult['ERRORS']['FATAL']))
	{

		$hasDiscount = false;
		$hasProps = false;
		$productSum = 0;
		$basketRefs = array();

		/*
		$noPict = array(
			'SRC' => $this->GetFolder().'/images/no_photo.png'
		);

		if(is_readable($nPictFile = $_SERVER['DOCUMENT_ROOT'].$noPict['SRC']))
		{
			$noPictSize = getimagesize($nPictFile);
			$noPict['WIDTH'] = $noPictSize[0];
			$noPict['HEIGHT'] = $noPictSize[1];
		}
		*/

		foreach($arResult["BASKET"] as $k => &$prod)
		{
			// найдем DETAIL_PAGE_URL (ибо в offers не заданы)
			$ar = CCatalogSKU::getProductList($prod["PRODUCT_ID"]);
			unset($pr_id);
			foreach($ar as $vals) $pr_id = $vals["ID"];
			if($pr_id > 0)
			{
				$dbRes = CIBlockElement::GetByID($pr_id);
				$arRes = $dbRes->GetNext();
				//prn($arRes);
				$prod["NAME"] = $arRes["NAME"];
				$prod["DETAIL_PAGE_URL"] = $arRes["DETAIL_PAGE_URL"];
			}
			
			if(floatval($prod['DISCOUNT_PRICE']))
				$hasDiscount = true;

			// move iblock props (if any) to basket props to have some kind of consistency
			if(isset($prod['IBLOCK_ID']))
			{
				$iblock = $prod['IBLOCK_ID'];
				if(isset($prod['PARENT']))
					$parentIblock = $prod['PARENT']['IBLOCK_ID'];

				foreach($arParams['CUSTOM_SELECT_PROPS'] as $prop)
				{
					$key = $prop.'_VALUE';
					if(isset($prod[$key]))
					{
						// in the different iblocks we can have different properties under the same code
						if(isset($arResult['PROPERTY_DESCRIPTION'][$iblock][$prop]))
							$realProp = $arResult['PROPERTY_DESCRIPTION'][$iblock][$prop];
						elseif(isset($arResult['PROPERTY_DESCRIPTION'][$parentIblock][$prop]))
							$realProp = $arResult['PROPERTY_DESCRIPTION'][$parentIblock][$prop];
						
						if(!empty($realProp))
							$prod['PROPS'][] = array(
								'NAME' => $realProp['NAME'], 
								'VALUE' => htmlspecialcharsEx($prod[$key])
							);
					}
				}
			}

			// if we have props, show "properties" column
			if(!empty($prod['PROPS']))
				$hasProps = true;

			$productSum += $prod['PRICE'] * $prod['QUANTITY'];

			$basketRefs[$prod['PRODUCT_ID']][] =& $arResult["BASKET"][$k];

			$prod['PICTURE'] = getPreview($prod["PRODUCT_ID"], 110, 110);    // FIX inmarketing
		}

		$arResult['HAS_DISCOUNT'] = $hasDiscount;
		$arResult['HAS_PROPS'] = $hasProps;

		$arResult['PRODUCT_SUM_FORMATTED'] = SaleFormatCurrency($productSum, $arResult['CURRENCY']);

		if($img = intval($arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']]['IMAGE_ID']))
		{

			$pict = CFile::ResizeImageGet($img, array(
				'width' => 150,
				'height' => 90
			), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);

			if(strlen($pict['src']))
				$pict = array_change_key_case($pict, CASE_UPPER);

			$arResult["DELIVERY"]["STORE_LIST"][$arResult['STORE_ID']]['IMAGE'] = $pict;
		}
		
		
		
		
		
		

		// Сортируем в порядке возрастания Артикула (надо выбрать артикул ибо его нет в исходных данных корзины)

		$arOffersID = Array();
		foreach($arResult["BASKET"] as $itemID => $arItem)
			$arOffersID[] = $arItem["PRODUCT_ID"];

		$arArticles = Array();
		$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ID" => $arOffersID), false, false, Array("ID", "NAME", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.PROPERTY_CML2_ARTICLE"));
		while($arRes = $dbRes->GetNext())
		{
			$arArticles[$arRes["ID"]] = $arRes["PROPERTY_CML2_LINK_PROPERTY_CML2_ARTICLE_VALUE"];
		}
		asort($arArticles, SORT_NUMERIC);
		$arIndexes = Array(); 
		$ind = 0;
		foreach($arArticles as $k => $v) $arIndexes[$k] = $ind++;
		//prn($arArticles);

		$newArr = Array();
		foreach($arResult["BASKET"] as $arItem)
		{
			$newArr[$arIndexes[$arItem["PRODUCT_ID"]]] = $arItem;
		}
		ksort($newArr);
		$arResult["BASKET"] = array_values($newArr);
		
		
		
		

	}
}

//prn($arResult);
?>