<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


// ================================================================================================================================
// Функция формирования данных arFields для шаблонов письма о новом заказе только по номеру заказа
// ================================================================================================================================

function getOrderMail_($ORDER_ID) 
{
	global $OKRUGS, $PARTNER_TYPES, $APPLICATION, $USER;
	
	if(intVal($ORDER_ID) > 0)
	{
	
		$arFields = Array();
		$arFields["ORDER_LIST"] = "";
		$arFields["ORDER_PROPS"] = "";
		$arFields["AGENT_PROPS"] = "";
		$arFields["USER_COMMENTS"] = "";
	
		CModule::IncludeModule("iblock");
		CModule::IncludeModule("catalog");
		CModule::IncludeModule("sale");
		
		$arOrder = CSaleOrder::GetByID($ORDER_ID);
				
		
		// ===================== 1. ВЫБЕРЕМ ДАННЫЕ ПО КОНТРАГЕНТУ
		
		$arFilter = Array( "ID" => $arOrder["USER_ID"]);
		$arParam["SELECT"] = Array("UF_*");
		$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
		if($arUser = $rsUser->GetNext()) 
		{
			$UF_OKRUG = $arUser["UF_OKRUG"];
			$UF_ASSORTIMENT = $arUser["UF_ASSORTIMENT"];
			$arFields["ORDER_USER_ID"] = $arOrder["USER_ID"];
		}

		
		
		
		
		
		
		
				
		// ===================== 2. ВЫБЕРЕМ ДАННЫЕ ПО ЗАКАЗУ
		
		$arPaySys = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"], $arOrder["PERSON_TYPE_ID"]);
		
		if(strpos($arOrder["DELIVERY_ID"], ":")>0)
		{
			$t = explode(":", $arOrder["DELIVERY_ID"]);
			$delivery_id = $t[0];
			$profile_id = $t[1];
			$dbResult = CSaleDeliveryHandler::GetBySID($delivery_id);
			if($arResult = $dbResult->Fetch())
			{
				foreach($arResult["PROFILES"] as $p_code => $profile)
				{
					if($p_code == $profile_id)
					{
						$arDelivery["NAME"] = $profile["TITLE"];
					}
				}
			}
			
		}
		else
		{
			$arDelivery = CSaleDelivery::GetByID($arOrder["DELIVERY_ID"]);	
			if(!is_array($arDelivery)) $arDelivery["NAME"] = $arOrder["DELIVERY_ID"];	
		}

		$arPersonType = CSalePersonType::GetByID($arOrder["PERSON_TYPE_ID"]);
		$arOrderProps = Array();
		$dbRes = CSaleOrderPropsValue::GetList(
			array("SORT" => "ASC"),
			array("ORDER_ID" => $ORDER_ID)
			);
		while($arRes = $dbRes->Fetch())
		{
			$arOrderProps[$arRes["CODE"]] = Array(
				"NAME" => $arRes["NAME"],
				"VALUE" => $arRes["VALUE"]
				);
		}


		
		
		
		

		// =============== 3. ВЫБЕРЕМ ДАННЫЕ ПО КОРЗИНЕ

		$arBasketList = array();
		$dbBasketItems = CSaleBasket::GetList(
			array("ID" => "ASC"),
			array("ORDER_ID" => $ORDER_ID),
			false,
			false,
			Array()
			);
		$arOfferID = Array();
		while ($arItem = $dbBasketItems->Fetch())
		{
			$arOfferID[] = $arItem["PRODUCT_ID"];
			if (CSaleBasketHelper::isSetItem($arItem))
				continue;
			$arBasketList[] = $arItem;
		}
		$arBasketList = getMeasures($arBasketList);
		
		
	
		$arExtData = Array();
		$arProductID = Array();
		$dbRes = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => OFFERS_IBLOCK_ID, "ID" => $arOfferID),
			false,
			false,
			Array("ID", "IBLOCK_ID", "PROPERTY_CML2_LINK", "PROPERTY_CML2_LINK.DETAIL_PAGE_URL", "PROPERTY_COLOR", "PROPERTY_SIZE")
			);
		while($arRes = $dbRes->GetNext())
		{
			$db = CIBlockElement::GetByID($arRes["PROPERTY_CML2_LINK_VALUE"]);
			$ar = $db->GetNext();
			$arExtData[$arRes["ID"]]["LINK"] = "http://www.newvay.ru".$ar["DETAIL_PAGE_URL"];
			//$arExtData[$arRes["ID"]]["COLOR"] = $arRes["PROPERTY_COLOR_VALUE"];
			//$arExtData[$arRes["ID"]]["SIZE"] = $arRes["PROPERTY_SIZE_VALUE"];
		}
		
		// Сортируем в порядке возрастания Артикула (надо выбрать артикул ибо его нет в исходных данных корзины)

		$arOffersID = Array();
		foreach($arBasketList as $itemID => $arItem)
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

		$newArr = Array();
		foreach($arBasketList as $arItem)
		{
			$newArr[$arIndexes[$arItem["PRODUCT_ID"]]] = $arItem;
		}
		ksort($newArr);
		$arBasketList = array_values($newArr);


		
		
		
		// ================== 4. Комментарий пользователя
		$arFields["USER_COMMENTS"] = "";
		if(strLen($arOrder["USER_DESCRIPTION"])>0)
		{
			$arFields["USER_COMMENTS"] = "<p style='font-size:14px;'><b>Комментарий пользователя:</b></p><p style='margin-left:20px;'>".$arOrder["USER_DESCRIPTION"]."</p>";
		}
		
		
		
		
		
		
		// ===================== 5. ФОРМИРУЕМ ВЫХОДНЫЕ ДАННЫЕ strAgentProps - вывод данных контрагента
		$strAgentProps = "<p style='font-size:14px;'><b>Данные контрагента:</b></p>";
		$strAgentProps .= "<table style='border-top:1px solid #CCC; font-size:14px;'>";
		if($arUser["UF_PARTNER_TYPE"] == 21) // физлицо
		{
			$strAgentProps .= "<tr><td style='width:200px; padding:10px 20px 2px 20px;'>Ф.И.О.:</td><td style='padding:10px 20px 2px 20px;'>".$arUser["UF_FIO"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Паспортные данные:</td><td style='padding:2px 20px;'>".$arUser["UF_PASSPORT"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН (физлицо):</td><td style='padding:2px 20px;'>".$arUser["UF_FIZ_INN"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Город:</td><td style='padding:2px 20px;'>".$arUser["UF_CITY"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Федеральный округ:</td><td style='padding:2px 20px;'>".$OKRUGS[$arUser["UF_OKRUG"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>E-mail:</td><td style='padding:2px 20px;'>".$arUser["EMAIL"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Контактное лицо:</td><td style='padding:2px 20px;'>".$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Телефон:</td><td style='padding:2px 20px;'>".$arUser["PERSONAL_PHONE"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Тип партнерства:</td><td style='padding:2px 20px;'>".$PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_INN"])."</td></tr>"; 
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ОГРН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_OGRN"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Паспорт (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_PASSPORT"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Комментарии:</td><td style='padding:2px 20px;'>".$arOrder["USER_DESCRIPTION"]."</td></tr>";
		}
		if(($arUser["UF_PARTNER_TYPE"] == 20)||(($arUser["UF_PARTNER_TYPE"] == 19))) // ИП/ООО
		{
			$strAgentProps .= "<tr><td style='width:200px; padding:10px 20px 2px 20px;'>Название компании:</td><td style='padding:10px 20px 2px 20px;'>".$arUser["UF_COMPANY_NAME"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Юридический адрес:</td><td style='padding:2px 20px;'>".$arUser["UF_COMPANY_ADDRESS"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН:</td><td style='padding:2px 20px;'>".$arUser["UF_INN"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>КПП:</td><td style='padding:2px 20px;'>".$arUser["UF_KPP"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ОГРН:</td><td style='padding:2px 20px;'>".$arUser["UF_OGRN"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Город:</td><td style='padding:2px 20px;'>".$arUser["UF_CITY"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Федеральный округ:</td><td style='padding:2px 20px;'>".$OKRUGS[$arUser["UF_OKRUG"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>E-mail:</td><td style='padding:2px 20px;'>".$arUser["EMAIL"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Контактное лицо:</td><td style='padding:2px 20px;'>".$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Телефон:</td><td style='padding:2px 20px;'>".$arUser["PERSONAL_PHONE"]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Тип партнерства:</td><td style='padding:2px 20px;'>".$PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]]."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Устав (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_USTAV"])."</td></tr>"; 
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Приказ о гендиректоре (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_GENDIR"])."</td></tr>"; 
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ИНН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_INN"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>ОГРН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_OGRN"])."</td></tr>";			
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Выписка из ЕГРН (копия):</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_EGRN"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Карточка с реквизитами:</td><td style='padding:2px 20px;'>".get_file_name($arUser["UF_DOC_REKVIZITY"])."</td></tr>";
			$strAgentProps .= "<tr><td style='padding:2px 20px;'>Комментарии:</td><td style='padding:2px 20px;'>".$arOrder["USER_DESCRIPTION"]."</td></tr>";
		}
		$strAgentProps .= "</table>";
		$strAgentProps .= "<p style='font-size:14px; font-style:italic; margin-left: 20px;'>Профиль на сайте - <a target='_blank' href='http://www.newvay.ru/bitrix/admin/user_edit.php?ID=".$arUser["ID"]."'>http://www.newvay.ru/bitrix/admin/user_edit.php?ID=".$arUser["ID"]."</a></p>";
		$arFields["AGENT_PROPS"] = $strAgentProps;
		
		
		
		
		// ===================== 6. ФОРМИРУЕМ ВЫХОДНЫЕ ДАННЫЕ strOrderProps - вывод свойств заказа
		
		$strOrderProps = "<p style='font-size:14px;'><b>Информация о доставке:</b></p>";
		$strOrderProps .= "<table style='border-top:1px solid #CCC; font-size:14px;'>";
		foreach($arOrderProps as $code => $arProp)
		{
			$val = $arProp["VALUE"];
			//if($code == "DELIVERY_PARAM") continue;
			//if($code == "LOCATION") continue;
			//if($code == "BASKET_DISCOUNT") $val = $val."%";
			if(!in_array($code, Array("DELIVERY_COMPANY", "DELIVERY_CITY", "DELIVERY_TYPE", "DELIVERY_FIO", "JUR_DELIVERY_COMPANY", "JUR_DELIVERY_CITY", "JUR_DELIVERY_TYPE", "JUR_DELIVERY_FIO"))) continue;
			
			if(($code == "DELIVERY_TYPE")||($code == "JUR_DELIVERY_TYPE"))
			{
				switch ($val)
				{
					case "empty": $val = "Не заполнено"; break;
					case "avto": $val = "Автомобильный транспорт"; break;
					case "train": $val = "Железнодорожный транспорт"; break;
					case "avia": $val = "Авиатранспорт"; break;
				}
			}
			
			$strOrderProps .= "<tr><td style='width:200px; padding:2px 20px; vertical-align: top;'>".$arProp["NAME"]."</td><td style='padding:2px 20px; vertical-align: top;'>".$val."</td></tr>";
		}
		$strOrderProps .= "</table>";
		$arFields["ORDER_PROPS"] = $strOrderProps;
		
		
		
		
		
		
		// ====================== 7. ФОРМИРУЕМ ВЫХОДНЫЕ ДАННЫЕ strOrderList - вывод корзины товаров
		
		$strOrderList = "<p style='font-size:14px;'><b>Состав заказа:</b></p>";
		$strOrderList .= "<table border='0' style='width:760px; border-collapse:collapse;' cellpadding='5'>";
		$strOrderList .= "<thead>\n<tr style='border-bottom:1px solid #CCCCCC;'>";
		$strOrderList .= "<td style='padding:10px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>№</b></td>";
		$strOrderList .= "<td style='padding:10px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Фото</b></td>";
		$strOrderList .= "<td style='padding:10px; text-align:left; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Наименование</b></td>";
		$strOrderList .= "<td style='padding:10px; width:100px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Цена</b></td>";
		$strOrderList .= "<td style='padding:10px; width:80px; background-color: #b42e31; color: #FFFFFF; white-space: nowrap; font-size:14px;'><b>Кол-во, шт.</b></td>";
		$strOrderList .= "<td style='padding:10px; width:100px; background-color: #b42e31; color: #FFFFFF; font-size:14px;'><b>Сумма</b></td>";
		$strOrderList .= "</tr>\n</thead><tbody>\n"; 
		
		$num = 0;
		foreach ($arBasketList as $arItem)
		{
			$price = $arItem["PRICE"];
			$oldprice = 0;
			$discount = 0;
			if($arItem["DISCOUNT_PRICE"] > 0)
			{
				$oldprice = $arItem["PRICE"] + $arItem["DISCOUNT_PRICE"];
				$discount = round($arItem["DISCOUNT_PRICE"]*100/($arItem["DISCOUNT_PRICE"] + $arItem["PRICE"]));
			}
			$arImg = getPreview($arItem["PRODUCT_ID"],110,110);
			$num++;
			$measureText = (isset($arItem["MEASURE_TEXT"]) && strlen($arItem["MEASURE_TEXT"])) ? $arItem["MEASURE_TEXT"] : GetMessage("SOA_SHT");
			$strOrderList .= "<tr style='border-bottom:1px solid #CCCCCC;'>";
			$strOrderList .= "<td style='padding:10px; font-size:14px;'>".$num."</td>\n";
			$strOrderList .= "<td style='padding:10px; font-size:14px;'><img height='80' src='".$arImg["SRC"]."'></td>\n";
			$strOrderList .= "<td style='padding:10px; padding-right:30px; font-size:14px;' class='prod-name'>";
			$strOrderList .= "<a href='".$arExtData[$arItem["PRODUCT_ID"]]["LINK"]."' style='color:#b42e31;'>".$arItem["NAME"]."</a>";
			$strOrderList .= "</td>\n";
			$strOrderList .= "<td style='padding:10px; white-space: nowrap; font-size:14px;'><b>".$price." руб.</b>";
			if($arItem["DISCOUNT_PRICE"] > 0) 
			{
				$strOrderList .= "<br><s style='color:#999; font-size:90%;'>".$oldprice." руб.</s>";
				$strOrderList .= "<br><span style='color:#b42e31;'>(-".$discount."%)</span><br>";
			};
			$strOrderList .= "</td>\n";
			$strOrderList .= "<td style='padding:10px; text-align:center; font-size:14px;'>".round($arItem["QUANTITY"])."</td>\n";
			$strOrderList .= "<td style='padding:10px; white-space: nowrap; font-size:14px;'><b>".$price*$arItem["QUANTITY"]." руб.</b></td>\n";
			$strOrderList .= "</tr>\n";
		}
		$strOrderList .= "</tbody></table>\n";

		$arFields["ORDER_LIST"] = $strOrderList;
		$arFields["PAYSYSTEM_NAME"] = $arPaySys["NAME"];
		$arFields["DELIVERY_NAME"] = $arDelivery["NAME"];

		return $arFields;

	}
	else
		return "Неверный номер заказа";
	
}



$ORDER_ID = intVal($_GET["ORDER_ID"]);
if($ORDER_ID > 0) {
	$arInfo = getOrderMail($ORDER_ID);	
	echo $arInfo["ORDER_LIST"];
	echo $arInfo["AGENT_PROPS"];
	echo $arInfo["ORDER_PROPS"];
	echo $arInfo["USER_COMMENTS"];
	//prn($arInfo);
};
?>

