<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



<?
$arFilter = Array( "ID" => $USER->GetID());
$arParam["SELECT"] = Array("UF_*");
$rsUser = CUser::GetList(($by="personal_country"), ($order="desc"), $arFilter, $arParam); 
$arUser = $rsUser->GetNext(); 
$fiz = false;
if($arUser["UF_PARTNER_TYPE"] == 21) $fiz = true;

?>





<?
if(count($arResult["PERSON_TYPE"]) > 1)
{
	?>
	<div class="section">
		<div class="title"><?=GetMessage("SOA_TEMPL_PERSON_TYPE")?></div>
		<input type="radio"<?=$fiz ? ' style="display:none;"' : ''?> id="PERSON_TYPE_2" name="PERSON_TYPE" value="2"<?=$arResult["PERSON_TYPE"][2]["CHECKED"]=="Y" ? ' checked="checked"' : ''?> onClick="if(!($(this).is(':checked'))) submitForm()"> <label<?=$fiz ? ' style="display:none;"' : ''?> for="PERSON_TYPE_2">Общество с ограниченной ответственностью / Индивидуальный предприниматель</label>
		<input type="radio"<?=!($fiz) ? ' style="display:none;"' : ''?> id="PERSON_TYPE_1" name="PERSON_TYPE" value="1"<?=$arResult["PERSON_TYPE"][1]["CHECKED"]=="Y" ? ' checked="checked"' : ''?> onClick="if(!($(this).is(':checked'))) submitForm();"> <label<?=!($fiz) ? ' style="display:none;"' : ''?> for="PERSON_TYPE_1">Физическое лицо</label>		
		<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>" />
	</div>
	<?
}
else
{
	if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
	{
		//for IE 8, problems with input hidden after ajax
		?>
		<span style="display:none;">
		<input type="text" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
		<input type="text" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
		</span>
		<?
	}
	else
	{
		foreach($arResult["PERSON_TYPE"] as $v)
		{
			?>
			<input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>" />
			<input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>" />
			<?
		}
	}
}
?>

<?//prn($arResult)?>