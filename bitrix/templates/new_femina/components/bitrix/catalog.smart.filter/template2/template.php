<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<style>
.smFilter_div { border:1px dashed #ac496e; background-color:#f4f4f4; }
.smFilter_name { background: url(/assets/ico_filter.png) no-repeat left; padding-left:30px; padding-top:5px; font-weight:bold; min-height:25px;}
.smFilter_price, .smFilter_RASPRODAZHA, .smFilter_COLOR, .smFilter_SIZE { float:left; width:150px;}
</style>

<div class="smFilter_div">
	<div class="smFilter_name">Фильтр</div>


	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>"/>
		<?endforeach;?>

		
		
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
		
			<?if(isset($arItem["PRICE"])):?>
			
				<?if(($USER->isAuthorized())&&($arItem["CODE"]!='Оптовые')) continue;?>
				<div class="smFilter_price">
					<table cellpadding="5">
						<?
							if (empty($arItem["VALUES"]["MIN"]["VALUE"])) $arItem["VALUES"]["MIN"]["VALUE"] = 0;
							if (empty($arItem["VALUES"]["MAX"]["VALUE"])) $arItem["VALUES"]["MAX"]["VALUE"] = 100000;
						?>
						<tr class="cnt" id="<?=$arItem["CODE"]?>">
							<td style="padding:10px;width: 180px" class="<?=$arItem["CODE"]?>" ><?=$arItem["NAME"]?></td>
							<td style="width:75px;padding:10px;"><?if ($IsIe):?><span style="position: absolute; margin-top: 11px;margin-left: -21px;"><?echo GetMessage("CT_BCSF_FILTER_FROM")?></span><?endif?><input class="min-price" type="text"  name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" placeholder="<?echo GetMessage("CT_BCSF_FILTER_FROM")?>" id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)"/></td>
							<td style="width:75px;padding:10px;"><?if ($IsIe):?><span style="position: absolute; margin-top: 11px;margin-left: -21px;"><?echo GetMessage("CT_BCSF_FILTER_TO")?></span><?endif?><input class="max-price" type="text"  name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" placeholder="<?echo GetMessage("CT_BCSF_FILTER_TO")?>" id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)" /></td>
						</tr>
					</table>
				</div>
			
			<?endif;?>
				
				
				
			<?if($arItem["CODE"]=="RASPRODAZHA"):?>
				<div class="smFilter_<?=$arItem["CODE"]?>">
					<span class="">Распродажа:</span>
					<?if(count($arItem["VALUES"])>0):?>
						<?foreach($arItem["VALUES"] as $val => $ar):?>
							<input type="checkbox" value="<?echo $ar["HTML_VALUE"]?>" name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?> onclick="smartFilter.click(this)"/>
						<?endforeach;?>
					<?else:?>
						<span class="no_sales">нет</span>
					<?endif;?>
				</div>
			<?endif;?>
			
			
			
			<?if($arItem["CODE"]=="SIZE"):?>
				<div class="smFilter_<?=$arItem["CODE"]?>">
					<span class="">Размер:</span>
					<ul>
						<?foreach($arItem["VALUES"] as $val => $ar):?>
						<li class="lvl2<?echo $ar["DISABLED"]? ' lvl2_disabled': ''?>" >
							<input type="checkbox" value="<?echo $ar["HTML_VALUE"]?>" name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?> onclick="smartFilter.click(this)"/>
							<label for="<?echo $ar["CONTROL_ID"]?>"><?echo $ar["VALUE"];?></label>
						</li>
						<?endforeach;?>
					</ul>
				</div>
			<?endif;?>
			
			
			
			<?if($arItem["CODE"]=="COLOR"):?>
				<div class="smFilter_<?=$arItem["CODE"]?>">
					<span class="">Цвет:</span>
					
					<!--
					<input id="color" type="hidden" name="" value="Y"/>
					<select onchange="$('#color').attr('name', $(this).val()); smartFilter.click(this);">
						<?foreach($arItem["VALUES"] as $val => $ar):?>
						<option value="<?=$ar["VALUE"]?>"><?=$ar["VALUE"]?></option>
						<?endforeach?>
					</select>
					-->
					
					<ul>
						<?foreach($arItem["VALUES"] as $val => $ar):?>
						<li class="lvl2<?echo $ar["DISABLED"]? ' lvl2_disabled': ''?>" >
							<input type="checkbox" value="<?echo $ar["HTML_VALUE"]?>" name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?> onclick="smartFilter.click(this)"/>
							<label for="<?echo $ar["CONTROL_ID"]?>"><?=strLen($ar["DISPLAY_VALUE"])>0 ? $ar["DISPLAY_VALUE"] : $ar["VALUE"] ;?></label>
						</li>
						<?endforeach;?>
					</ul>

				</div>
			<?endif;?>
				
				
		
		<?endforeach;?>
		
		<div class="clear"></div>
			
			
			
			
			
			<div class="posabo">
				<input type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" class="bt1 lupe"/>
				<input type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" class="bt2"/>
			</div>
			
			
			<div class="modef" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
				<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
				<a href="<?echo $arResult["FILTER_URL"]?>" ><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
				<span class="ecke"></span>
			</div>
		
	</form>

</div>

<script>
	var smartFilter = new JCSmartFilter('<?echo $arResult["FORM_ACTION"]?>');
	var height = $(".catf").height();
	if ($.cookie("acstatus") == "open"){
		$(".more-options-hfilter").css({"min-height":height+"px"});	
	} else {	
		$.cookie("acstatus", "close",{expires:14});
		$(".more-options-hfilter").css({"overflow":"hidden", "height":"0px"});
		$(".more-options-hfilter-button").text("<?=GetMessageJS("CT_BCSF_SHOW_PROPS")?>");
	}
	$(".more-options-hfilter-button").click(function(){
		if ($.cookie("acstatus") == "close"){
			$.cookie("acstatus", "open",{expires:14});
			$(".more-options-hfilter").animate({"min-height":height+"px"},300);
			setTimeout(function() {
				$(".more-options-hfilter").css({"min-height":height+"px","height":"auto","overflow":"visible"}); 
			}, 300)	
			$(".more-options-hfilter-button").text("<?=GetMessageJS("CT_BCSF_HIDE_PROPS")?>");
		} else {
			$.cookie("acstatus", "close",{expires:14});
			$(".more-options-hfilter").css({"overflow":"hidden","min-height":"auto"});
			$(".more-options-hfilter").animate({"height":0},300);
			$(".more-options-hfilter-button").text("<?=GetMessageJS("CT_BCSF_SHOW_PROPS")?>");
			$.cookie("acstatus", "close");
		}
		return false;
	});
</script>



<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>