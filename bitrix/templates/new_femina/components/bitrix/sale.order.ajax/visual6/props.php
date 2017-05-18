<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props_format.php");
?>




<?
global $PARTNER_TYPES;
$arFilter = Array( "ID" => $USER->GetID());
$arParam["SELECT"] = Array("UF_*");
$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
$arUser = $rsUser->GetNext();


foreach($arResult["ORDER_PROP"]["USER_PROPS_N"] as $k=>&$prop)
{
	if($prop["CODE"] == "FIO") 				$prop["VALUE"] = $arUser["UF_FIO"];
	if($prop["CODE"] == "PASSPORT") 		$prop["VALUE"] = $arUser["UF_PASSPORT"];
	if($prop["CODE"] == "INN_FIZ") 			$prop["VALUE"] = $arUser["UF_FIZ_INN"];
	if($prop["CODE"] == "EMAIL") 			$prop["VALUE"] = $arUser["EMAIL"];
	if($prop["CODE"] == "PHONE") 			$prop["VALUE"] = $arUser["PERSONAL_PHONE"];
	if($prop["CODE"] == "DELIVERY_CITY")	$prop["VALUE"] = $arUser["UF_CITY"];
	if($prop["CODE"] == "DELIVERY_FIO")		$prop["VALUE"] = trim($arUser["NAME"]." ".$arUser["LAST_NAME"]);
	
	if($prop["CODE"] == "COMPANY") 			$prop["VALUE"] = $arUser["UF_COMPANY_NAME"];
	if($prop["CODE"] == "COMPANY_ADR") 		$prop["VALUE"] = $arUser["UF_COMPANY_ADDRESS"];
	if($prop["CODE"] == "INN")	 			$prop["VALUE"] = $arUser["UF_INN"];
	if($prop["CODE"] == "KPP") 				$prop["VALUE"] = $arUser["UF_KPP"];
	if($prop["CODE"] == "OGRN") 			$prop["VALUE"] = $arUser["UF_OGRN"];
	if($prop["CODE"] == "EMAIL") 			$prop["VALUE"] = $arUser["EMAIL"];
	if($prop["CODE"] == "PHONE") 			$prop["VALUE"] = $arUser["PERSONAL_PHONE"];
	if($prop["CODE"] == "JUR_DELIVERY_CITY")	$prop["VALUE"] = $arUser["UF_CITY"];
	if($prop["CODE"] == "JUR_DELIVERY_FIO")		$prop["VALUE"] = trim($arUser["NAME"]." ".$arUser["LAST_NAME"]);
	
	if(($prop["CODE"] == "KPP")&&($PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]] == "ИП")) unset($arResult["ORDER_PROP"]["USER_PROPS_N"][$k]);
	if(($prop["CODE"] == "COMPANY")&&($PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]] == "ИП")) 		$prop["NAME"] = "Ф.И.О. ИП";
	if(($prop["CODE"] == "COMPANY_ADR")&&($PARTNER_TYPES[$arUser["UF_PARTNER_TYPE"]] == "ИП")) 	$prop["NAME"] = "Адрес по прописке";
}

?>





<?//prn($arResult["ORDER_PROP"]);?>

<div class="bx_section">
	<div id="sale_order_props" <?=($bHideProps && $_POST["showProps"] != "Y")?"style='display:none;'":''?>>
		<?
		//prn("==1==");
		PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_N"], $arParams["TEMPLATE_LOCATION"]);
		//prn("==2==");
		PrintPropsForm($arResult["ORDER_PROP"]["USER_PROPS_Y"], $arParams["TEMPLATE_LOCATION"]);
		?>
	</div>
</div>

<script type="text/javascript">
	function fGetBuyerProps(el)
	{
		var show = '<?=GetMessageJS('SOA_TEMPL_BUYER_SHOW')?>';
		var hide = '<?=GetMessageJS('SOA_TEMPL_BUYER_HIDE')?>';
		var status = BX('sale_order_props').style.display;
		var startVal = 0;
		var startHeight = 0;
		var endVal = 0;
		var endHeight = 0;
		var pFormCont = BX('sale_order_props');
		pFormCont.style.display = "block";
		pFormCont.style.overflow = "hidden";
		pFormCont.style.height = 0;
		var display = "";

		if (status == 'none')
		{
			el.text = '<?=GetMessageJS('SOA_TEMPL_BUYER_HIDE');?>';

			startVal = 0;
			startHeight = 0;
			endVal = 100;
			endHeight = pFormCont.scrollHeight;
			display = 'block';
			BX('showProps').value = "Y";
			el.innerHTML = hide;
		}
		else
		{
			el.text = '<?=GetMessageJS('SOA_TEMPL_BUYER_SHOW');?>';

			startVal = 100;
			startHeight = pFormCont.scrollHeight;
			endVal = 0;
			endHeight = 0;
			display = 'none';
			BX('showProps').value = "N";
			pFormCont.style.height = startHeight+'px';
			el.innerHTML = show;
		}

		(new BX.easing({
			duration : 700,
			start : { opacity : startVal, height : startHeight},
			finish : { opacity: endVal, height : endHeight},
			transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
			step : function(state){
				pFormCont.style.height = state.height + "px";
				pFormCont.style.opacity = state.opacity / 100;
			},
			complete : function(){
					BX('sale_order_props').style.display = display;
					BX('sale_order_props').style.height = '';
			}
		})).animate();
	}
</script>

<div style="display:none;">
<?
	$APPLICATION->IncludeComponent(
		"bitrix:sale.ajax.locations",
		$arParams["TEMPLATE_LOCATION"],
		array(
			"AJAX_CALL" => "N",
			"COUNTRY_INPUT_NAME" => "COUNTRY_tmp",
			"REGION_INPUT_NAME" => "REGION_tmp",
			"CITY_INPUT_NAME" => "tmp",
			"CITY_OUT_LOCATION" => "Y",
			"LOCATION_VALUE" => "",
			"ONCITYCHANGE" => "submitForm()",
		),
		null,
		array('HIDE_ICONS' => 'Y')
	);
?>
</div>