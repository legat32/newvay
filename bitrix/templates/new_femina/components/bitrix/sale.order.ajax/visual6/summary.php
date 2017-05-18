<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDefaultColumns = $arResult["GRID"]["DEFAULT_COLUMNS"];
$colspan = ($bDefaultColumns) ? count($arResult["GRID"]["HEADERS"]) : count($arResult["GRID"]["HEADERS"]) - 1;
$bPropsColumn = false;
$bUseDiscount = false;
$bShowNameWithPicture = ($bDefaultColumns) ? true : false; // flat to show name and picture column in one column





// выберем дополнительные данные

$arOffers = Array();
foreach($arResult["GRID"]["ROWS"] as $kItem => $arItem) 
{
	$arOffers[$arItem["data"]["PRODUCT_ID"]] = 1;	
	$arResult["GRID"]["ROWS"][$kItem]["data"]["PREVIEW_PICTURE"] = getPreview($arItem["data"]["PRODUCT_ID"], 110, 110);    // довыберем картинку-превью
	foreach($arItem["data"]["PROPS"] as $arProp) 
	{
		if(($arProp["CODE"] == "COLOR")||($arProp["CODE"] == "COLOR_LIST")) $arResult["GRID"]["ROWS"][$kItem]["data"]["NEW_PROPS"]["COLOR"] = Array("NAME" => "Цвет", "VALUE" => $arProp["VALUE"]);
		if(($arProp["CODE"] == "SIZE")||($arProp["CODE"] == "SIZE_LIST")) $arResult["GRID"]["ROWS"][$kItem]["data"]["NEW_PROPS"]["SIZE"] = Array("NAME" => "Размер", "VALUE" => $arProp["VALUE"]);
	}
}

$arrID = Array();
$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 7, "ID" => array_keys($arOffers)), false, false, Array("ID", "PROPERTY_CML2_LINK"));
while($arRes = $dbRes->GetNext()) 
{
	$arOffers[$arRes["ID"]] = $arRes["PROPERTY_CML2_LINK_VALUE"];
	$arrID[] = $arRes["PROPERTY_CML2_LINK_VALUE"];	
}

$dbRes = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 6, "ID" => $arrID), false, false, Array("ID", "NAME", "DETAIL_PAGE_URL"));
while($arRes = $dbRes->GetNext())
{
	foreach($arOffers as $kOffer => $arOffer)
	{
		if($arOffer == $arRes["ID"]) $arOffers[$kOffer] = $arRes;
	}
}
$arResult["EXTRA"] = $arOffers;







// Переставим колонки в таблице в другом порядке
$nAr = Array(
	$arResult["GRID"]["HEADERS"][0], 	// название
	$arResult["GRID"]["HEADERS"][3],	// цена
	$arResult["GRID"]["HEADERS"][2],	// скидка
	$arResult["GRID"]["HEADERS"][4],	// кол-во
	$arResult["GRID"]["HEADERS"][5]	// сумма по товару
);
$arResult["GRID"]["HEADERS"] = $nAr;






// Сортируем в порядке возрастания Артикула (надо выбрать артикул ибо его нет в исходных данных корзины)

$arOffersID = Array();
foreach($arResult["GRID"]["ROWS"] as $itemID => $arItem)
	$arOffersID[] = $arItem["data"]["PRODUCT_ID"];

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
foreach($arResult["GRID"]["ROWS"] as $arItem)
{
	$newArr[$arIndexes[$arItem["data"]["PRODUCT_ID"]]] = $arItem;
}
ksort($newArr);
$arResult["GRID"]["ROWS"] = array_values($newArr);







?>








<h4>Состав заказа</h4>
<?//prn($arResult["GRID"]["HEADERS"])?>

<div class="bx_ordercart">
	<div class="bx_ordercart_order_table_container">
		<table class='sale_basket_basket data-table'>

			<thead>
				<tr>

					<?
					$bPreviewPicture = false;
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arColumn):
						if ($arColumn["id"] == "PROPS")
							$bPropsColumn = true;
						if ($arColumn["id"] == "PREVIEW_PICTURE")
							$bPreviewPicture = true;
					endforeach;
					if ($bPreviewPicture)
						$bShowNameWithPicture = true;
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arColumn):
						if (in_array($arColumn["id"], array("PROPS", "TYPE", "NOTES"))) // some values are not shown in columns in this template
							continue;
						if ($arColumn["id"] == "PREVIEW_PICTURE" && $bShowNameWithPicture)
							continue;
						if ($arColumn["id"] == "NAME" && $bShowNameWithPicture):?>
							<th class="products-img">ФОТО</th><th class="products">
						<?echo "Название";
						elseif ($arColumn["id"] == "NAME" && !$bShowNameWithPicture):?>
							<th>
						<?echo $arColumn["name"];
						elseif ($arColumn["id"] == "PRICE"):?>
							<th>
						<?echo $arColumn["name"];else:?>
							<th>
						<?echo $arColumn["name"];
						endif;?>
							</th>
					<?endforeach;?>
				</tr>
			</thead>

			<tbody>
				<?foreach ($arResult["GRID"]["ROWS"] as $k => $arData):?>
				<tr>
					<?if ($bShowNameWithPicture):?>
						<td class="product-img" >
							<?
							if(strlen($arData["data"]["PREVIEW_PICTURE"]["SRC"]) > 0):
							$url = $arData["data"]["PREVIEW_PICTURE"]["SRC"];
							?>
								<div class="item_img">
									<img src="<?=$url?>">
								</div>
							<?
							else:?>
								<div class="item_img_blank"></div>
							<?endif;?>
						</td>
					<?
					endif;

					foreach ($arResult["GRID"]["HEADERS"] as $id => $arColumn):

						$class = ($arColumn["id"] == "PRICE_FORMATED") ? "price" : "";

						if (in_array($arColumn["id"], array("PROPS", "TYPE", "NOTES"))) // some values are not shown in columns in this template
							continue;

						if ($arColumn["id"] == "PREVIEW_PICTURE" && $bShowNameWithPicture)
							continue;

						$arItem = (isset($arData["columns"][$arColumn["id"]])) ? $arData["columns"] : $arData["data"];

						if ($arColumn["id"] == "NAME"):
						?>
							<td class="products">
								<strong>
									<?/*if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
										<?=$arItem[CATALOG][PARENT_NAME]?>
									<?if (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;*/?>
									
									<a href="<?=$arResult["EXTRA"][$arItem["PRODUCT_ID"]]["DETAIL_PAGE_URL"]?>">
										<?=isset($arResult["EXTRA"][$arItem["PRODUCT_ID"]]["NAME"]) ? $arResult["EXTRA"][$arItem["PRODUCT_ID"]]["NAME"] : $arItem["NAME"]?>
									</a>
									
								</strong><br>
								<span class="size-color">
									<?
									//if ($bPropsColumn):
										foreach ($arItem["NEW_PROPS"] as $val):
											echo $val["NAME"].": ".$val["VALUE"]."<br>";
										endforeach;
									//endif;
									?>
								</span>
								<?
								if (is_array($arItem["SKU_DATA"])):
									foreach ($arItem["SKU_DATA"] as $propId => $arProp):

										// is image property
										$isImgProperty = false;
										foreach ($arProp["VALUES"] as $id => $arVal)
										{
											if (isset($arVal["PICT"]) && !empty($arVal["PICT"]))
											{
												$isImgProperty = true;
												break;
											}
										}

										$full = (count($arProp["VALUES"]) > 5) ? "full" : "";

										if ($isImgProperty): // iblock element relation property
										?>
											<div class="bx_item_detail_scu_small_noadaptive <?=$full?>">

												<span class="bx_item_section_name_gray">
													<?=$arProp["NAME"]?>:
												</span>

												<div class="bx_scu_scroller_container">

													<div class="bx_scu">
														<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>" style="width: 200%;margin-left:0%;">
														<?
														foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

															$selected = "";
															foreach ($arItem["PROPS"] as $arItemProp):
																if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"])
																{
																	if ($arItemProp["VALUE"] == $arSkuValue["NAME"])
																		$selected = "class=\"bx_active\"";
																}
															endforeach;
														?>
															<li style="width:10%;" <?=$selected?>>
																<a href="javascript:void(0);">
																	<span style="background-image:url(<?=$arSkuValue["PICT"]["SRC"]?>)"></span>
																</a>
															</li>
														<?
														endforeach;
														?>
														</ul>
													</div>

													<div class="bx_slide_left" onclick="leftScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>);"></div>
													<div class="bx_slide_right" onclick="rightScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>);"></div>
												</div>

											</div>
										<?
										else:
										?>
											<div class="bx_item_detail_size_small_noadaptive <?=$full?>">

												<span class="bx_item_section_name_gray">
													<?=$arProp["NAME"]?>:
												</span>

												<div class="bx_size_scroller_container">
													<div class="bx_size">
														<ul id="prop_<?=$arProp["CODE"]?>_<?=$arItem["ID"]?>" style="width: 200%; margin-left:0%;">
															<?
															foreach ($arProp["VALUES"] as $valueId => $arSkuValue):

																$selected = "";
																foreach ($arItem["PROPS"] as $arItemProp):
																	if ($arItemProp["CODE"] == $arItem["SKU_DATA"][$propId]["CODE"])
																	{
																		if ($arItemProp["VALUE"] == $arSkuValue["NAME"])
																			$selected = "class=\"bx_active\"";
																	}
																endforeach;
															?>
																<li style="width:10%;" <?=$selected?>>
																	<a href="javascript:void(0);"><?=$arSkuValue["NAME"]?></a>
																</li>
															<?
															endforeach;
															?>
														</ul>
													</div>
													<div class="bx_slide_left" onclick="leftScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>);"></div>
													<div class="bx_slide_right" onclick="rightScroll('<?=$arProp["CODE"]?>', <?=$arItem["ID"]?>);"></div>
												</div>

											</div>
										<?
										endif;
									endforeach;
								endif;
								?>
							</td>
						<?
						elseif ($arColumn["id"] == "PRICE_FORMATED"):
						?>
							<td class="product-price">

								<div class="current_price"><?=$arItem["PRICE_FORMATED"]?></div>
								
								<?if(doubleval($arItem["DISCOUNT_PRICE"]) > 0):?>
									<div class="old_price">
										<s><?=SaleFormatCurrency($arItem["PRICE"] + $arItem["DISCOUNT_PRICE"], $arItem["CURRENCY"])?></s>
										<?$bUseDiscount = true;?>
									</div>
								<?endif?>
								
								<?if (strlen($arItem["NOTES"]) > 0):?>
									<div class="type_price">
										<?/*?><div><?=GetMessage("SALE_TYPE")?>:</div><?*/?>
										<div class="type_price_value"><?=$arItem["NOTES"]?></div>
									</div>
								<?endif;?>
							</td>
						<?
						elseif ($arColumn["id"] == "DISCOUNT"):
						?>
							<td class="custom right">
								<span><?=getColumnName($arColumn)?>:</span>
								<?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?>
							</td>
						<?
						elseif ($arColumn["id"] == "DETAIL_PICTURE" && $bPreviewPicture):
						?>
							<td class="itemphoto">
								<div class="bx_ordercart_photo_container">
									<?
									$url = "";
									if ($arColumn["id"] == "DETAIL_PICTURE" && strlen($arData["data"]["DETAIL_PICTURE_SRC"]) > 0)
										$url = $arData["data"]["DETAIL_PICTURE_SRC"];

									if ($url == "")
										//$url = $templateFolder."/images/no_photo.png";
										$url = "/assets/images/logo_transp.png";

									if (strlen($arData["data"]["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arData["data"]["DETAIL_PAGE_URL"] ?>"><?endif;?>
										<div class="bx_ordercart_photo" style="background-image:url('<?=$url?>')"></div>
									<?if (strlen($arData["data"]["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
								</div>
							</td>
						<?
						elseif (in_array($arColumn["id"], array("QUANTITY", "WEIGHT_FORMATED", "DISCOUNT_PRICE_PERCENT_FORMATED"))):
						?>
							<td class="quantity">
								<?=$arItem[$arColumn["id"]]?>
							</td>
						<?
						else:
						?>
							<td class="count">
								<?=$arItem[$arColumn["id"]]?>
							</td>
						<?
						endif;

					endforeach;
					?>
				</tr>
				<?endforeach;?>
			</tbody>
		</table>
	</div>

	<div class="bx_ordercart_order_pay">

		<div class="bx_ordercart_order_pay_right">

			<table class="bx_ordercart_order_sum">
				<tbody>
					<!--
					<tr>
						<td class="custom_t1" colspan="<?=$colspan?>" class="itog"><?=GetMessage("SOA_TEMPL_SUM_WEIGHT_SUM")?></td>
						<td class="custom_t2" class="price"><?=$arResult["ORDER_WEIGHT_FORMATED"]?></td>
					</tr>
					
					<tr>
						<td class="custom_t1" colspan="<?=$colspan?>" class="itog"><?=GetMessage("SOA_TEMPL_SUM_SUMMARY")?></td>
						<td class="custom_t2" class="price"><?=$arResult["ORDER_PRICE_FORMATED"]?></td>
					</tr>
					-->
					<?
					if (doubleval($arResult["DISCOUNT_PRICE"]) > 0)
					{
						?>
						<tr class="itogo">
							<td class="ruquered-message" colspan="<?=$colspan?>"><span class="red-star">* </span>Поля, обязательные для заполнения.</td>
							<td class="custom_t1 itog"><?=GetMessage("SOA_TEMPL_SUM_DISCOUNT")?><?if (strLen($arResult["DISCOUNT_PERCENT_FORMATED"])>0):?> (<?echo $arResult["DISCOUNT_PERCENT_FORMATED"];?>)<?endif;?>:</td>
							<td class="custom_t2 price"><?echo $arResult["DISCOUNT_PRICE_FORMATED"]?></td>
						</tr>
						<?
					}
					if(!empty($arResult["arTaxList"]))
					{
						foreach($arResult["arTaxList"] as $val)
						{
							?>
							<tr class="itogo">
								<td class="ruquered-message" colspan="<?=$colspan?>"><span class="red-star">* </span>Поля, обязательные для заполнения.</td>
								<td class="custom_t1 itog"><?=$val["NAME"]?> <?=$val["VALUE_FORMATED"]?>:</td>
								<td class="custom_t2 price"><?=$val["VALUE_MONEY_FORMATED"]?></td>
							</tr>
							<?
						}
					}
					if (doubleval($arResult["DELIVERY_PRICE"]) > 0)
					{
						?>
						<tr class="itogo">
							<td class="ruquered-message" colspan="<?=$colspan?>"><span class="red-star">* </span>Поля, обязательные для заполнения.</td>
							<td class="custom_t1 itog"><?=GetMessage("SOA_TEMPL_SUM_DELIVERY")?></td>
							<td class="custom_t2 price"><?=$arResult["DELIVERY_PRICE_FORMATED"]?></td>
						</tr>
						<?
					}
					if (strlen($arResult["PAYED_FROM_ACCOUNT_FORMATED"]) > 0)
					{
						?>
						<tr class="itogo">
							<td class="ruquered-message" colspan="<?=$colspan?>"><span class="red-star">* </span>Поля, обязательные для заполнения.</td>
							<td class="custom_t1 itog"><?=GetMessage("SOA_TEMPL_SUM_PAYED")?></td>
							<td class="custom_t2 price"><?=$arResult["PAYED_FROM_ACCOUNT_FORMATED"]?></td>
						</tr>
						<?
					}

					if ($bUseDiscount):
					?>
						<tr class="itogo">
							<td class="ruquered-message" colspan="<?=$colspan?>"><span class="red-star">* </span>Поля, обязательные для заполнения.</td>
							<td class="custom_t1 fwb itog"><?=GetMessage("SOA_TEMPL_SUM_IT")?></td>
							<td class="custom_t1 fwb price"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></td>
						</tr>
					<?
					else:
					?>
						<tr class="itogo">
							<td class="ruquered-message" colspan="<?=$colspan?>"><span class="red-star">* </span>Поля, обязательные для заполнения.</td>
							<td class="custom_t1 fwb itog"><?=GetMessage("SOA_TEMPL_SUM_IT")?></td>
							<td class="custom_t2 fwb price"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?></td>
						</tr>
					<?
					endif;
					?>
				</tbody>
			</table>
			<div style="clear:both;"></div>

		</div>
		<div style="clear:both;"></div>

		<div class="bx_section">
			<h4><?=GetMessage("SOA_TEMPL_SUM_ADIT_INFO")?></h4>
			<div class="property order-comment">
				<label>
					<span class="property-name"><?=GetMessage("SOA_TEMPL_SUM_COMMENTS")?></span>
					<textarea name="ORDER_DESCRIPTION" id="ORDER_DESCRIPTION" style="max-width:100%;min-height:120px"><?=$arResult["USER_VALS"]["ORDER_DESCRIPTION"]?></textarea>
					<?if(strLen(trim($arProperties["DESCRIPTION"]))>0):?>
					<br/><span><i><?=$arProperties["DESCRIPTION"]?></i></span>
					<?endif;?>
				</label>
			</div>
			<input type="hidden" name="" value="">
		</div>
