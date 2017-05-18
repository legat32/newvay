<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
	
$APPLICATION->SetAdditionalCSS("/assets/kladr/jquery.kladr.min.css");
$APPLICATION->AddHeadScript("/assets/kladr/jquery.kladr.min.js");
$APPLICATION->AddHeadScript("/assets/js/jquery.maskedinput.min.js");	
	
unset($arResult["SHOW_FIELDS"][0]);
unset($arResult["REQUIRED_FIELDS"][0]);
//prn($arResult);
	

$arRequiredUserFields = $arParams["REQUIRED_USER_FIELDS"];
//prn($arParams["REQUIRED_USER_FIELDS"]);




if( ($_SERVER["SCRIPT_NAME"] == "/reg/fiz.php") || ($_SERVER["REAL_FILE_PATH"] == "/reg/fiz.php")) 
{
	$arRequiredUserFields = Array(
		"UF_ADDRESS",
		"UF_ASSORTIMENT",
		"UF_PASSPORT",
		"UF_FIO",
		"UF_CITY",
		"UF_FIZ_INN"
		);
}

if( ($_SERVER["SCRIPT_NAME"] == "/reg/ip.php") || ($_SERVER["REAL_FILE_PATH"] == "/reg/ip.php")) 
{
	$arResult["USER_PROPERTIES"]["DATA"]["UF_COMPANY_NAME"]["EDIT_FORM_LABEL"] = "Ф.И.О.";
}

$arResult["SHOW_FIELDS"] = Array(
	"PASSWORD",
	"CONFIRM_PASSWORD",
	"EMAIL",
	"NAME",
	"SECOND_NAME",
	"LAST_NAME",
	"PERSONAL_PHONE",
	"PERSONAL_NOTES"
	);
 
?>

<div class="bx-auth-reg">

<?//prn($arResult);?>

<?if(($arResult["VALUES"]["LOGIN"] == $arResult["VALUES"]["EMAIL"]) && (!empty($arResult["VALUES"]["LOGIN"])) &&(count($arResult["ERRORS"])<1) ):?>
	<p><i><?ShowMessage(Array("TYPE"=>"OK", "MESSAGE"=>GetMessage("REGISTER_EMAIL_WAS_SENT")));?></i></p>
<?endif?>

<p><i>Если Вы уже регистрировались на сайте и забыли пароль воспользуйтесь ссылкой <a href="/personal/?forgot_password=yes">Восстановить пароль</a></i></p>

<?if($USER->IsAuthorized()):?>

	<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>

	<?if(count($arResult["ERRORS"]) > 0):
		foreach ($arResult["ERRORS"] as $key => $error)
			if (intval($key) == 0 && $key !== 0) 
				$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);
		ShowError(implode("<br />", $arResult["ERRORS"]));
	elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
		<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
	<?endif?>
	
	<?if( empty($arResult["bVarsFromForm"]) || count($arResult["ERRORS"]) > 0 ):?>
	
		<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
			<input type="hidden" name="REGISTER[LOGIN]" value="<?=RandString(20)?>" />
			
			<?if($arResult["BACKURL"] <> ''):?>
				<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
			<?endif;?>
			
			
			<?if($_SERVER["REAL_FILE_PATH"]=="/reg/ooo.php"):?><input type="hidden" name="UF_PARTNER_TYPE" value="19"/><?endif?>
			<?if($_SERVER["REAL_FILE_PATH"]=="/reg/ip.php"):?><input type="hidden" name="UF_PARTNER_TYPE" value="20"/><?endif?>
			<?if($_SERVER["REAL_FILE_PATH"]=="/reg/fiz.php"):?><input type="hidden" name="UF_PARTNER_TYPE" value="21"/><?endif?>
						
			<br/>
			<table border="0">
				<tbody>
					<tr>
						<td valign="top" style="padding-right:50px;">
						
							<table>
							<?// ********************* User properties ***************************************************?>
							<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
								<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
								
								<?/*if($arUserField["FIELD_NAME"] == "UF_MAILING"):?>
									<tr><td><input type="hidden" name="UF_MAILING" value="5"></td></tr>
									<?continue;?>
								<?endif*/?>
								
								<tr>
									<td colspan="2"><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if(in_array($arUserField["FIELD_NAME"], $arRequiredUserFields)):?><span class="required">*</span><?endif;?><br/>
									
										<?if($arUserField["FIELD_NAME"] == "UF_FIZ_INN"):?><span class="additional">ИНН или серия и № паспорта (цифры без пробелов)</span><?endif?>
										<?if($arUserField["FIELD_NAME"] == "UF_INN"):?><span class="additional">10-12 цифр</span><?endif?>
									
										<?$APPLICATION->IncludeComponent(
											"bitrix:system.field.edit",
											$arUserField["USER_TYPE"]["USER_TYPE_ID"],
											array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?>
									</td>
								</tr>
								<?endforeach;?>
							<?endif;?>
							</table>
						
						</td>
						<td valign="top">
						
						
						<table>
						<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
						
							<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
								<tr>
									<td><?echo GetMessage("main_profile_time_zones_auto")?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?></td>
									<td>
										<select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
											<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
											<option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
											<option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
										</select>
									</td>
								</tr>
								<tr>
									<td><?echo GetMessage("main_profile_time_zones_zones")?></td>
									<td>
										<select name="REGISTER[TIME_ZONE]"<?if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"'?>>
								<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
											<option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
								<?endforeach?>
										</select>
									</td>
								</tr>
							<?else:?>
								<tr>
									<td colspan="2">
									<?if($FIELD == "NAME"):?>
										<p><b>Контактное лицо</b></p>
									<?endif?>
									<?=GetMessage("REGISTER_FIELD_".$FIELD)?>:<?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>
									<?if($FIELD == "PASSWORD"):?>(не менее 6 символов)<?endif?>
									<span class="starrequired">*</span><?endif?><br/>
									<?
							switch ($FIELD)
							{
								case "PASSWORD":
									?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
							<?if($arResult["SECURE_AUTH"]):?>
											<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
												<div class="bx-auth-secure-icon"></div>
											</span>
											<noscript>
											<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
												<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
											</span>
											</noscript>
							<script type="text/javascript">
							document.getElementById('bx_auth_secure').style.display = 'inline-block';
							</script>
							<?endif?>
							<?
									break;
								case "CONFIRM_PASSWORD":
									?><input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" /><?
									break;

								case "PERSONAL_GENDER":
									?><select name="REGISTER[<?=$FIELD?>]">
										<option value=""><?=GetMessage("USER_DONT_KNOW")?></option>
										<option value="M"<?=$arResult["VALUES"][$FIELD] == "M" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_MALE")?></option>
										<option value="F"<?=$arResult["VALUES"][$FIELD] == "F" ? " selected=\"selected\"" : ""?>><?=GetMessage("USER_FEMALE")?></option>
									</select><?
									break;

								case "PERSONAL_COUNTRY":
								case "WORK_COUNTRY":
									?><select name="REGISTER[<?=$FIELD?>]"><?
									foreach ($arResult["COUNTRIES"]["reference_id"] as $key => $value)
									{
										?><option value="<?=$value?>"<?if ($value == $arResult["VALUES"][$FIELD]):?> selected="selected"<?endif?>><?=$arResult["COUNTRIES"]["reference"][$key]?></option>
									<?
									}
									?></select><?
									break;

								case "PERSONAL_PHONE":	
									?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" class="input_<?=$FIELD?>" /><?
									break;
									
								case "PERSONAL_PHOTO":
								case "WORK_LOGO":
									?><input size="30" type="file" name="REGISTER_FILES_<?=$FIELD?>" /><?
									break;

								case "PERSONAL_NOTES":
								case "WORK_NOTES":
									?><textarea cols="30" rows="5" name="REGISTER[<?=$FIELD?>]"><?=$arResult["VALUES"][$FIELD]?></textarea><?
									break;
								default:
									if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br /><?endif;
									?><input size="30" type="text" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" /><?
										if ($FIELD == "PERSONAL_BIRTHDAY")
											$APPLICATION->IncludeComponent(
												'bitrix:main.calendar',
												'',
												array(
													'SHOW_INPUT' => 'N',
													'FORM_NAME' => 'regform',
													'INPUT_NAME' => 'REGISTER[PERSONAL_BIRTHDAY]',
													'SHOW_TIME' => 'N'
												),
												null,
												array("HIDE_ICONS"=>"Y")
											);
										?><?
							}?></td>
								</tr>
							<?endif?>
						
						<?endforeach?>
						</table>
						
						
						
						</td>
					</tr>
				</tbody>
			</table>
				
				
			
				

			
			
			
			
			<?// ******************** /User properties ***************************************************?>
			<?
			/* CAPTCHA */
			if ($arResult["USE_CAPTCHA"] == "Y")
			{
				?>
					<tr>
						<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
						</td>
					</tr>
					<tr>
						<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></td>
						<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
					</tr>
				<?
			}
		/* !CAPTCHA */
		?>

			</tbody>
				<tfoot>
					<tr>
						<td></td>
						<td><input type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" onclick="yaCounter18911821.reachGoal('REGISTR'); return true;"/></td>
					</tr>
				</tfoot>
			</table>
			
			<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
			<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

		</form>
		
		<?endif?>
		
	<?endif?>

	<?//prn($arResult)?>
</div>