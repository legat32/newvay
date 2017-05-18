<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	$url = explode('arrFilter_61_',$_SERVER['QUERY_STRING']);
	if($url[1]){
		$filter = explode('=',$url[1]);
		$filter = $filter[0];
	}
?>

<?//prn($arResult)?>

<div class="smFilter_div">
	<div class="smFilter_name">Фильтр</div>
<?//prn($arResult);?>
<script>

	$(function(){

		$('select').live('change',function(){
			/*
			var elem = document.getElementById($('option:selected').attr('id'));
			smartFilter.click(elem);
			*/
			
			$('.color_checkbox').attr('id',$('option:selected').attr('id'));
			$('.color_checkbox').val($('option:selected').val());
			$('.color_checkbox').attr('name',$('option:selected').attr('name'));
			$('.color_checkbox').attr('onclick','smartFilter.click(this)');
			$('.color_checkbox').attr('checked','checked');
			
			var elem = document.getElementsByClassName('color_checkbox');
			elem = $(elem).get(0);
			smartFilter.click(elem);
		});
		
		/*
		var url = window.location.href.split('arrFilter_153_');
		if(url[1]){
			var selectFilter = url[1].split('=')[0];
			$('select option').each(function(i,el){
				if($(this).attr('id') == 'arrFilter_153_'+selectFilter){
					console.log($(this));
					alert('arrFilter_153_'+selectFilter);
					$(this).attr('selected');
					$(this).select();
				}
			});
		}
		*/


	});
</script>

	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">

		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>"/>
		<?endforeach;?>




		<!-- Цвета -->
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<?if($arItem["CODE"]!=="COLOR") continue;?>
			<div class="smFilter_<?=$arItem["CODE"]?>">
				<div class="lvl2">
					<span class="">Цвет:</span>
					<select class="lvl2">
						<span class="">Цвет:</span>
						<option selected="selected" >не выбрано</option>
						<?foreach($arItem["VALUES"] as $val => $ar):?>
						<option value="<?echo $ar["HTML_VALUE"]?>" name="<?echo $ar["CONTROL_NAME"]?>" <?=($ar['CONTROL_ID'] == 'arrFilter_61_'.$filter)?'selected="selected"':null;?> id="<?echo $ar["CONTROL_ID"]?>"  ><?=strLen($ar["DISPLAY_VALUE"])>0 ? $ar["DISPLAY_VALUE"] : $ar["VALUE"]?></option>
						<?endforeach;?>
					</select>
					<input type="checkbox" value="" name="" id="" class="color_checkbox" hidden="hidden" />
				</div>
			</div>
		<?endforeach?>




		<!-- Цены -->
		<?
		if(defined("DEALER_USER")) 		$code="DEALER_PRICE_MIN"; 
		elseif(defined("JOINT_USER")) 	$code="JOINT_PRICE_MIN"; 
		else 							$code="RETAIL_PRICE_MIN";
		?>
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<?if($arItem["CODE"]==$code):?>
			<div class="smFilter_price">
				<table cellpadding="5">
					<?
						if (empty($arItem["VALUES"]["MIN"]["VALUE"])) $arItem["VALUES"]["MIN"]["VALUE"] = 0;
						if (empty($arItem["VALUES"]["MAX"]["VALUE"])) $arItem["VALUES"]["MAX"]["VALUE"] = 100000;
					?>
					<tr class="cnt" id="<?=$arItem["CODE"]?>">
						<td style="width:180px; padding-right:10px;" align="right" class="<?=$arItem["CODE"]?>" ><?=str_replace(" MIN", "", str_replace(" MAX" , "", $arItem["NAME"]))?></td>
						<td style="width:75px;"><?if ($IsIe):?><span style="position: absolute; margin-top: 11px;margin-left: -21px;"><?echo GetMessage("CT_BCSF_FILTER_FROM")?></span><?endif?><input class="min-price" type="text"  name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" placeholder="<?echo GetMessage("CT_BCSF_FILTER_FROM")?>" id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)"/></td>
						<td style="width:75px;;"><?if ($IsIe):?><span style="position: absolute; margin-top: 11px;margin-left: -21px;"><?echo GetMessage("CT_BCSF_FILTER_TO")?></span><?endif?><input class="max-price" type="text"  name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" placeholder="<?echo GetMessage("CT_BCSF_FILTER_TO")?>" id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)" /></td>
						<td>руб.</td>
					</tr>
				</table>
			</div>
			<?endif?>
		<?endforeach?>




		<!-- Распродажа -->
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<?if($arItem["CODE"]!=="RASPRODAZHA") continue;?>
			<div class="smFilter_<?=$arItem["CODE"]?>">
				<span class="">Распродажа:</span>
				<?if(count($arItem["VALUES"])>0):?>
					<?foreach($arItem["VALUES"] as $val => $ar):?>
						<?if($_SERVER["SCRIPT_NAME"]=="/sale/index.php"):?>
							<input disabled="disabled" readonly="readonly" checked="checked" type="checkbox" value="<?echo $ar["HTML_VALUE"]?>" name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?> onclick="smartFilter.click(this)"/>
						<?else:?>
							<input type="checkbox" value="<?echo $ar["HTML_VALUE"]?>" name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?> onclick="smartFilter.click(this)"/>
						<?endif?>
					<?endforeach;?>
				<?else:?>
					<span class="no_sales">нет</span>
				<?endif;?>
			</div>
		<?endforeach?>




		<div class="clear"></div>



		<!-- Размеры -->
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<?if($arItem["CODE"]!=="SIZE") continue;?>
			<?
			$num_cols=8;
			$num_in_col=ceil(count($arItem["VALUES"])/$num_cols);
			?>
			<div class="smFilter_<?=$arItem["CODE"]?>">
				<span class="">Размер:</span>

				<table border="0"><tr>
					<?foreach($arItem["VALUES"] as $val => $ar):?>
					<?if(!isset($num)):?>
						<?$num=0;?>
					<td valign="top" style="padding-right:15px;">
					<?elseif($num==0):?>
						</td><td valign="top" style="padding-right:15px;">
					<?endif?>
							<input type="checkbox" value="<?echo $ar["HTML_VALUE"]?>" name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?> onclick="smartFilter.click(this)"/>
							<label for="<?echo $ar["CONTROL_ID"]?>"><?echo $ar["VALUE"];?></label>
							<br/>
						<?$num++;?>
						<? if($num==$num_in_col) $num=0;?>
					<?endforeach;?>
					</td></tr>
				</table>
			</div>
		<?endforeach?>




			<div class="clear"></div>




			<div class="posabo">
				<input type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" class="btn lupe"/>
				<input type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" class="btn"/>
			</div>


			<div class="modef" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
				<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
				<a href="<?echo $arResult["FILTER_URL"]?>" ><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
				<span class="ecke"></span>
			</div>

			<div class="clear"></div>
		
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