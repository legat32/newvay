<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

//prn($arParams["REQUIRED_USER_FIELDS"]);
$APPLICATION->SetAdditionalCSS("/assets/kladr/jquery.kladr.min.css");
$APPLICATION->AddHeadScript("/assets/kladr/jquery.kladr.min.js");
$APPLICATION->AddHeadScript("/assets/js/jquery.maskedinput.min.js");

?>

    <div class="bx-auth-profile">

        <?ShowError($arResult["strProfileError"]);?>
        <?
        if ($arResult['DATA_SAVED'] == 'Y')
            ShowNote(GetMessage('PROFILE_DATA_SAVED'));
        ?>

        <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
            <?=$arResult["BX_SESSION_CHECK"]?>
            <input type="hidden" name="lang" value="<?=LANG?>" />
            <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />

                    <div class="left">

                        <?// ********************* User properties ***************************************************?>
                        <?//if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
                        <!--<div class="profile-link profile-user-div-link"><a title="<?=GetMessage("USER_SHOW_HIDE")?>" href="javascript:void(0)" onclick="SectionClick('user_properties')"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></a></div>
	<div id="user_div_user_properties" class="profile-block-<?=strpos($arResult["opened"], "user_properties") === false ? "hidden" : "shown"?>">-->

                            <?$first = true;?>
                            <?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
                            <div class="property ">
                            <label>
                            <span class="property-name">
                                        <?=$arUserField["EDIT_FORM_LABEL"]?>
                                        <?if(in_array($arUserField["FIELD_NAME"], $arParams["REQUIRED_USER_FIELDS"])):?>
                                            <span class="required">*</span>
                                        <?endif?>:
                                        <?if($arUserField["FIELD_NAME"] == "UF_FIZ_INN"):?><span class="additional">(ИНН или серия и № паспорта (цифры без пробелов))</span><?endif?>
                                        <?if($arUserField["FIELD_NAME"] == "UF_INN"):?><span class="additional">(10-12 цифр)</span><?endif?>
                            </span>
                                        

                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:system.field.edit",
                                            $arUserField["USER_TYPE"]["USER_TYPE_ID"],
                                            array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField), null, array("HIDE_ICONS"=>"Y"));?>
                                        <?//if($USER->isAdmin()):?>
                                        <?//prn($arUserField)?>
                                        <?if(is_array($arUserField["VALUE"])):?>
                                            <?$num=0?>
                                            <input type="hidden" name="<?=$arUserField["FIELD_NAME"]?>_NAME" value="<?=$arUserField["EDIT_FORM_LABEL"]?>" />
                                            <?foreach($arUserField["VALUE"] as $val):?>
                                                <input type="hidden" name="OLD_<?=$arUserField["FIELD_NAME"]?>[<?=$num?>]" value="<?=$val?>" />
                                                <?$num++;?>
                                            <?endforeach?>
                                        <?else:?>
                                            <input type="hidden" name="<?=$arUserField["FIELD_NAME"]?>_NAME" value="<?=$arUserField["EDIT_FORM_LABEL"]?>"/>
                                            <input type="hidden" name="OLD_<?=$arUserField["FIELD_NAME"]?>" value="<?=$arUserField["VALUE"]?>" />
                                        <?endif?>
                                        <?//endif?>
                            	</label>
                            </div>
                            <?endforeach;?>

                        <!--</div>-->
                        <?//endif;?>

                        <?// ******************** /User properties ***************************************************?>





                    </div>
                    <div class="right">
                            <div class="property ">
                            <label>
                            	<span class="property-name">
                                    <?=GetMessage('NEW_PASSWORD_REQ')?>
                                </span>
                                    <input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
    						</label>
                            </div>
                            <div class="property ">
                            <label>
                            	<span class="property-name">
                                    <?=GetMessage('NEW_PASSWORD_CONFIRM')?>
                                </span>
                                    <input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
    						</label>
                            </div>
                            <div class="property ">
                            <label>
                            	<span class="property-name">
                                    <?=GetMessage('EMAIL')?><span class="required">*</span>
                                </span>
                                    <input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
                                    <input type="hidden" name="EMAIL_NAME" value="E-mail" />
                                    <input type="hidden" name="OLD_EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>" />
                                    <input type="text" name="EMAIL" maxlength="50" value="<?=$arResult["arUser"]["EMAIL"]?>" />
    						</label>
                            </div>
<h4>Контактное лицо</h4>
                           	<div class="property ">
                            <label>
                            	<span class="property-name">
                                    
                                    <?=GetMessage('NAME')?><span class="required">*</span>
                                </span>
                                    <input type="hidden" name="NAME_NAME" value="Имя" />
                                    <input type="hidden" name="OLD_NAME" value="<?=$arResult["arUser"]["NAME"]?>" />
                                    <input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
    						</label>
                            </div>
                            <div class="property ">
                            <label>
                            	<span class="property-name">
                                    <?=GetMessage('LAST_NAME')?>
                                </span>
                                    <input type="hidden" name="LAST_NAME_NAME" value="Фамилия" />
                                    <input type="hidden" name="OLD_LAST_NAME" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
                                    <input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
    						</label>
                            </div>
                           <div class="property ">
                            <label>
                            	<span class="property-name">
                                    <?=GetMessage('SECOND_NAME')?>
                                </span>
                                    <input type="hidden" name="SECOND_NAME_NAME" value="Отчество" />
                                    <input type="hidden" name="OLD_SECOND_NAME" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
                                    <input type="text" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
    						</label>
                            </div>

                            <!--
		<tr>
			<td><?=GetMessage('LOGIN')?><span class="starrequired">*</span></td>
			<td><input type="text" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" /></td>
		</tr>
		-->

                           <div class="property ">
                            <label>
                            	<span class="property-name">
                                    <?=GetMessage('USER_PHONE')?><span class="required">*</span>
                                    </span>
                                    <input type="hidden" name="PERSONAL_PHONE_NAME" value="Телефон" />
                                    <input type="hidden" name="OLD_PERSONAL_PHONE" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
                                    <input type="text" name="PERSONAL_PHONE" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" class="input_PERSONAL_PHONE"/>
    						</label>
                            </div>
                            <?/*?>
		<tr>
			<td colspan="2">
				Дополнительные заметки:
				<br/>
				<input type="hidden" name="PERSONAL_NOTES_NAME" value="Дополнительные заметки" />
				<input type="hidden" name="OLD_PERSONAL_NOTES" value="<?=$arResult["arUser"]["PERSONAL_NOTES"]?>" />
				<textarea name="PERSONAL_NOTES" rows="6" cols="32" /><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea>
			</td>
		</tr>
		<? */ ?>
                            <?if($arResult["TIME_ZONE_ENABLED"] == true):?>
                                  <div class="property ">
                            			<label><span class="property-name"><?echo GetMessage("main_profile_time_zones")?></span></label>
                                </div>
                                  <div class="property ">
                            <label>
                            <span class="property-name"><?echo GetMessage("main_profile_time_zones_auto")?></span>
                
                                        <select name="AUTO_TIME_ZONE" onchange="this.form.TIME_ZONE.disabled=(this.value != 'N')">
                                            <option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
                                            <option value="Y"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "Y"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
                                            <option value="N"<?=($arResult["arUser"]["AUTO_TIME_ZONE"] == "N"? ' SELECTED="SELECTED"' : '')?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
                                        </select>
                                   </label>
                                </div>
                                    <div class="property ">
                            <label>
                            <span class="property-name"><?echo GetMessage("main_profile_time_zones_zones")?></span>
                                    <td>55555
                                        <select name="TIME_ZONE"<?if($arResult["arUser"]["AUTO_TIME_ZONE"] <> "N") echo ' disabled="disabled"'?>>
                                            <?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
                                                <option value="<?=htmlspecialcharsbx($tz)?>"<?=($arResult["arUser"]["TIME_ZONE"] == $tz? ' SELECTED="SELECTED"' : '')?>><?=htmlspecialcharsbx($tz_name)?></option>
                                            <?endforeach?>
                                        </select>
                                   </label>
                                </div>
                            <?endif?>
                    </div>
            <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
            <p>
                <input type="submit" name="save" value="Отправить измененные данные">&nbsp;&nbsp;
                <!--<input type="reset" value="<?=GetMessage('MAIN_RESET');?>">-->
            </p>
        </form>
    </div>


<?//prn($arResult)?>