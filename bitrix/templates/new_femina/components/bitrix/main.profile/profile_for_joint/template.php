<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>

<?if($_REQUEST["send"]=="joint"):?>
	<script>
	$(document).ready( function() {
		$.fancybox.open(
			{
				href : '/forms/partner.php?blank=Y&type=joint',
				type : 'iframe'
			}, 
			{
				padding : 20   
			}
			);
		});
	</script>
<?endif?>


<div class="bx-auth-profile">

	<?if($_POST["FORM_TYPE"]=="JOINT_FORM"):?>
		<?ShowError($arResult["strProfileError"]);?>
		<?
		if ($arResult['DATA_SAVED'] == 'Y')
			ShowNote(GetMessage('PROFILE_DATA_SAVED'));
		?>
	<?endif?>

	<form method="post" name="form2" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
		<?=$arResult["BX_SESSION_CHECK"]?>
		<input type="hidden" name="lang" value="<?=LANG?>" />
		<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
		<input type="hidden" name="FORM_TYPE" value="JOINT_FORM" />
		<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />
		<input type="hidden" name="NAME" value="<?=$arResult["arUser"]["NAME"]?>" />
		<input type="hidden" name="LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
		<input type="hidden" name="SECOND_NAME" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
		<input type="hidden" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" />
		<input type="hidden" name="PERSONAL_CITY" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" />
		
	<table border="0" cellpadding="0" cellspacing="0" class="data_uf">
		<?// ********************* User properties ***************************************************?>
		<?$first = true;?>
		<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
		<tr><td class="field-name">
			<?if ($arUserField["MANDATORY"]=="Y"):?>
				<span class="starrequired">*</span>
			<?endif;?>
			<?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td class="field-value">
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.field.edit",
					$arUserField["USER_TYPE"]["USER_TYPE_ID"],
					array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
		</td></tr>
		<?endforeach;?>
		<?// ******************** /User properties ***************************************************?>
	</table>
	
	<p>Для подтверждения выше указанных данных необходимо прислать копии паспорта (1 разворот и прописка), свидетельства ИНН.</li>
	<p>
		<input type="submit" name="save" value="Сохранить">
		&nbsp;&nbsp;
		<input type="submit" name="save" id="jointsaveandsend" value="Сохранить и Отправить">
	</p>
	<!--<input type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;<input type="reset" value="<?=GetMessage('MAIN_RESET');?>"></p>-->
	
	</form>

</div>

<script>
$("#jointsaveandsend").on("click", function() {
	$("form[name=form2]").attr("action", "<?=$arResult["FORM_TARGET"]?>?send=joint");
	});
</script>