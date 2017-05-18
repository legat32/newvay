<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
CJSCore::Init(array("fx"));
?>
<!--noindex-->
<div class="bx_filter_horizontal">
	<div class="bx_filter_section m4">
		<!--<div class="bx_filter_title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></div>-->
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
			<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input
					type="hidden"
					name="<?echo $arItem["CONTROL_NAME"]?>"
					id="<?echo $arItem["CONTROL_ID"]?>"
					value="<?echo $arItem["HTML_VALUE"]?>"
				/>
			<?endforeach;?>
			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?if(isset($arItem["PRICE"])):?>
					<?
					if (!$arItem["VALUES"]["MIN"]["VALUE"] || !$arItem["VALUES"]["MAX"]["VALUE"] || $arItem["VALUES"]["MIN"]["VALUE"] == $arItem["VALUES"]["MAX"]["VALUE"])
						continue;
					?>
					<div class="bx_filter_container price">
						<span class="bx_filter_container_title" onclick="hideFilterProps(this)"><?=$arItem["NAME"]?></span>
						<div class="bx_filter_param_area">
							<div class="bx_filter_param_area_block"><div class="bx_input_container">
									<input
										class="min-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
									/>
							</div></div>
							<div class="bx_filter_param_area_block"><div class="bx_input_container">
									<input
										class="max-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
									/>
							</div></div>
							<div style="clear: both;"></div>
						</div>
						<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
							<div class="bx_ui_slider_range" style="left: 0; right: 0%;"  id="drag_tracker_<?=$key?>"></div>
							<a class="bx_ui_slider_handle left" rel="nofollow" href="javascript:void(0)" style="left:0;" id="left_slider_<?=$key?>"></a>
							<a class="bx_ui_slider_handle right" rel="nofollow" href="javascript:void(0)" style="right:0%;" id="right_slider_<?=$key?>"></a>
						</div>
						<div class="bx_filter_param_area">
							<div class="bx_filter_param_area_block" id="curMinPrice_<?=$key?>"><?=$arItem["VALUES"]["MIN"]["VALUE"]?></div>
							<div class="bx_filter_param_area_block" id="curMaxPrice_<?=$key?>"><?=$arItem["VALUES"]["MAX"]["VALUE"]?></div>
							<div style="clear: both;"></div>
						</div>
					</div>

					<script type="text/javascript" defer="defer">
						var DoubleTrackBar<?=$key?> = new cDoubleTrackBar('drag_track_<?=$key?>', 'drag_tracker_<?=$key?>', 'left_slider_<?=$key?>', 'right_slider_<?=$key?>', {
							OnUpdate: function(){
								BX("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").value = this.MinPos;
								BX("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").value = this.MaxPos;
							},
							Min: parseFloat(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>),
							Max: parseFloat(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>),
							MinInputId : BX('<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'),
							MaxInputId : BX('<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'),
							FingerOffset: 8,
							MinSpace: 1,
							RoundTo: 1
						});
					</script>
				<?endif?>
			<?endforeach?>

			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?if($arItem["PROPERTY_TYPE"] == "N" ):?>
					<div class="bx_filter_container price">
						<?if(defined("PRICE_TYPE")):?>
							<span class="bx_filter_container_title" onclick="hideFilterProps(this)"><?=$arItem["NAME"]?></span>
							<div class="bx_filter_param_area">
								<div class="bx_filter_param_area_block"><div class="bx_input_container">
									<input
										class="min-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										placeholder="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>"
									/>
									</div></div>
								<div class="bx_filter_param_area_block"><div class="bx_input_container">
									<input
										class="max-price"
										type="text"
										name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
										id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
										value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
										size="5"
										onkeyup="smartFilter.keyup(this)"
										placeholder="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>"
									/>
								</div></div>
								<div style="clear: both;"></div>
							</div>
							<div class="bx_ui_slider_track" id="drag_track_<?=$key?>">
								<div class="bx_ui_slider_range" style="left: 0; right: 0%;"  id="drag_tracker_<?=$key?>"></div>
								<a class="bx_ui_slider_handle left"  href="javascript:void(0)" style="left:0;" id="left_slider_<?=$key?>"></a>
								<a class="bx_ui_slider_handle right" href="javascript:void(0)" style="right:0%;" id="right_slider_<?=$key?>"></a>
							</div>
						<?endif?>
					</div>
					<script type="text/javascript" defer="defer">
						var DoubleTrackBar<?=$key?> = new cDoubleTrackBar('drag_track_<?=$key?>', 'drag_tracker_<?=$key?>', 'left_slider_<?=$key?>', 'right_slider_<?=$key?>', {
							OnUpdate: function(){
								BX("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>").value = this.MinPos;
								BX("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>").value = this.MaxPos;
							},
							Min: parseFloat(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>),
							Max: parseFloat(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>),
							MinInputId : BX('<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>'),
							MaxInputId : BX('<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>'),
							FingerOffset: 8,
							MinSpace: 1,
							RoundTo: 1
						});
					</script>
				<?elseif(!empty($arItem["VALUES"]) && !isset($arItem["PRICE"])):?>
				<?if( ($arItem["CODE"] == "RASPRODAZHA") || ($arItem["CODE"] == "SEZONNOE_PREDLOZHENIE") ) $FIXED_PROPERTIES = true; else $FIXED_PROPERTIES = false; ?>
				<div class="bx_filter_container">
					<span class="bx_filter_container_title" onclick="hideFilterProps(this)"><?=$arItem["NAME"]?></span>
					<?if($arItem["CODE"] == "COLOR_TONE"):?>
						<div class="bx_filter_block color_tones">
							<?foreach($arItem["VALUES"] as $val => $ar):?>
								<?if((strtoupper(trim($ar["VALUE"])) != "НЕ УКАЗАНО")&&(strtoupper(trim($ar["VALUE"])) != "НЕ УКАЗАН")):?>
									<span class="<?echo $ar["DISABLED"] ? 'disabled': ''?>"<?if((!$ar["CHECKED"])&&(!$FIXED_PROPERTIES)):?> style="display:none;"<?endif?>>
										
										<input style="display:none;"
											type="checkbox"
											value="<?echo $ar["HTML_VALUE"]?>"
											name="<?echo $ar["CONTROL_NAME"]?>"
											id="<?echo $ar["CONTROL_ID"]?>"
											<?echo $ar["CHECKED"]? 'checked="checked"': ''?>
											onclick="smartFilter.click(this)"
											<?if ($ar["DISABLED"]):?>disabled<?endif?>
										/>
										<i class="color_var<?echo $ar["CHECKED"] ? ' selected' : ''?>" style="background-color:<?=$ar["COLOR_CODE"]?>" title="<?=strtolower($ar["VALUE"]);?>"></i>
									</span>
								<?endif?>
							<?endforeach;?>
							<div style="clear:both;"></div>
							<?if(!$FIXED_PROPERTIES):?>
							<a class="all_variants" rel="nofollow" href="#">все варианты</a>
							<?endif?>
						</div>
					<?else:?>
						<div class="bx_filter_block">
							<?foreach($arItem["VALUES"] as $val => $ar):?>
								<?if((strtoupper(trim($ar["VALUE"])) != "НЕ УКАЗАНО")&&(strtoupper(trim($ar["VALUE"])) != "НЕ УКАЗАН")):?>
									<span class="<?echo $ar["DISABLED"] ? 'disabled': ''?>"<?if((!$ar["CHECKED"])&&(!$FIXED_PROPERTIES)):?> style="display:none;"<?endif?>>
										<input
											type="checkbox"
											value="<?echo $ar["HTML_VALUE"]?>"
											name="<?echo $ar["CONTROL_NAME"]?>"
											id="<?echo $ar["CONTROL_ID"]?>"
											<?echo $ar["CHECKED"]? 'checked="checked"': ''?>
											onclick="smartFilter.click(this)"
											<?if ($ar["DISABLED"]):?>disabled<?endif?>
										/>
										<label for="<?echo $ar["CONTROL_ID"]?>"><?echo strtolower($ar["VALUE"]);?></label>
									</span>
								<?endif?>
							<?endforeach;?>
							<?if(!$FIXED_PROPERTIES):?>
							<a class="all_variants" rel="nofollow" href="#">все варианты</a>
							<?endif?>
						</div>
					<?endif?>
				</div>
				<?endif;?>
			<?endforeach;?>
			<div style="clear: both;"></div>
			<div class="bx_filter_control_section">
				<span class="icon"></span><input class="bx_filter_search_button" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" />
				<input class="bx_filter_search_button" type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" />

				<div class="bx_filter_popup_result" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;top: 75px;left: 25px;right: 25px;">
					<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
					<a href="<?echo $arResult["FILTER_URL"]?>" rel="nofollow"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
					<!--<span class="ecke"></span>-->
				</div>
			</div>
		</form>
		<div style="clear: both;"></div>
	</div>
</div>
<!--/noindex-->

<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>');
</script>