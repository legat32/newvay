<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script>
<!--
function ChangeGenerate(val)
{
	if(val)
	{
		document.getElementById("sof_choose_login").style.display='none';
	}
	else
	{
		document.getElementById("sof_choose_login").style.display='block';
		document.getElementById("NEW_GENERATE_N").checked = true;
	}

	try{document.order_reg_form.NEW_LOGIN.focus();}catch(e){}
}
//-->
</script>
<div class="change-order-user">
		<div class="login-user">
			<h4>
				<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
					<?echo GetMessage("STOF_2REG")?>
				<?endif;?>
			</h4>
			<form method="post" action="" name="order_auth_form">
				<?=bitrix_sessid_post()?>
				<?
				foreach ($arResult["POST"] as $key => $value)
				{
				?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?
				}
				?>
					
				<div class="property message"><?echo GetMessage("STOF_LOGIN_PROMT")?></div>
				<div class="property">
					<label>
					<span class="property-name"><?echo GetMessage("STOF_LOGIN")?> <span class="required">*</span></span>
						<input type="text" name="USER_LOGIN" maxlength="30" size="30" value="<?=$arResult["AUTH"]["USER_LOGIN"]?>">
					</label>
				</div>
				<div class="property">
					<label>
					<span class="property-name"><?echo GetMessage("STOF_PASSWORD")?> <span class="required">*</span></span>
						<input type="password" name="USER_PASSWORD" maxlength="30" size="30">
					</label>
				</div>
				<div class="property message"><a href="<?=$arParams["PATH_TO_AUTH"]?>?forgot_password=yes&back_url=<?= urlencode($APPLICATION->GetCurPageParam()); ?>"><?echo GetMessage("STOF_FORGET_PASSWORD")?></a>
				</div>
				<div class="property submit">
						<input type="submit" value="<?echo GetMessage("STOF_NEXT_STEP")?>">
						<input type="hidden" name="do_authorize" value="Y">
				</div>
				

			</form>
		</div>		
		<div class="reg-user">
			<h4>
				<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
					<?echo GetMessage("STOF_2NEW")?>
				<?endif;?>
			</h4>
			<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
				<form method="post" action="" name="order_reg_form">
					<?=bitrix_sessid_post()?>
					<?
					foreach ($arResult["POST"] as $key => $value)
					{
					?>
					<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
					<?
					}
					?>
					<div class="property">
						<label>
							<span class="property-name"><?echo GetMessage("STOF_NAME")?> <span class="required">*</span></span>
							<input type="text" name="NEW_NAME" size="40" value="<?=$arResult["AUTH"]["NEW_NAME"]?>">
						</label>
					</div>
					<div class="property">
						<label>
							<span class="property-name"><?echo GetMessage("STOF_LASTNAME")?> <span class="required">*</span></span>
							<input type="text" name="NEW_LAST_NAME" size="40" value="<?=$arResult["AUTH"]["NEW_LAST_NAME"]?>">
						</label>
					</div>
					<div class="property">
						<label>
							<span class="property-name">E-Mail <span class="required">*</span></span>
							<input type="text" name="NEW_EMAIL" size="40" value="<?=$arResult["AUTH"]["NEW_EMAIL"]?>">
						</label>
					</div>

						<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
						<div>
							<input type="radio" id="NEW_GENERATE_N" name="NEW_GENERATE" value="N" OnClick="ChangeGenerate(false)"<?if ($_POST["NEW_GENERATE"] == "N") echo " checked";?>> 
							<label for="NEW_GENERATE_N"><?echo GetMessage("STOF_MY_PASSWORD")?></label>
						</div>
						<?endif;?>
						<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
						<div id="sof_choose_login">
						<?endif;?>

					<div class="property">
						<label>
							<span class="property-name"><?echo GetMessage("STOF_LOGIN")?> <span class="required">*</span></span>
							<input type="text" name="NEW_LOGIN" size="30" value="<?=$arResult["AUTH"]["NEW_LOGIN"]?>">
						</label>
					</div>
					<div class="property">
						<label>
							<span class="property-name"><?echo GetMessage("STOF_PASSWORD")?> <span class="required">*</span></span>
							<input type="password" name="NEW_PASSWORD" size="30">
						</label>
					</div>
					<div class="property">
						<label>
							<span class="property-name"><?echo GetMessage("STOF_RE_PASSWORD")?> <span class="required">*</span></span>
							<input type="password" name="NEW_PASSWORD_CONFIRM" size="30">
						</label>
					</div>

						<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
						</div>
						<?endif;?>
						<?if($arResult["AUTH"]["new_user_registration_email_confirmation"] != "Y"):?>
						<div>
								<input type="radio" id="NEW_GENERATE_Y" name="NEW_GENERATE" value="Y" OnClick="ChangeGenerate(true)"<?if ($POST["NEW_GENERATE"] != "N") echo " checked";?>> <label for="NEW_GENERATE_Y"><?echo GetMessage("STOF_SYS_PASSWORD")?></label>
								<script language="JavaScript">
								<!--
								ChangeGenerate(<?= (($_POST["NEW_GENERATE"] != "N") ? "true" : "false") ?>);
								//-->
								</script>
						</div>
						<?endif;?>
						<?
						if($arResult["AUTH"]["captcha_registration"] == "Y") //CAPTCHA
						{
						?>

						<div class="capcha">
							<div class="capcha-img">
								<input type="hidden" name="captcha_sid" value="<?=$arResult["AUTH"]["capCode"]?>">
								<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["AUTH"]["capCode"]?>" width="180" height="40" alt="CAPTCHA">
								<span>Защита от автоматической регистрации</span>
							</div>
							<div class="capcha-field">
								<input type="text" name="captcha_word" size="30" maxlength="50" value="">
								<span>Введите слово на картинке:<span class="required">*</span></span>
							</div>
						</div>
						<?
						}
						?>
						<div class="property submit">
								<input type="submit" value="<?echo GetMessage("STOF_NEXT_STEP")?>">
								<input type="hidden" name="do_register" value="Y">
						</div>
				</form>
			<?endif;?>
		</div>
</div>
<?echo GetMessage("STOF_REQUIED_FIELDS_NOTE")?>
<?if($arResult["AUTH"]["new_user_registration"]=="Y"):?>
	<?echo GetMessage("STOF_EMAIL_NOTE")?>
<?endif;?>
<?echo GetMessage("STOF_PRIVATE_NOTES")?>
