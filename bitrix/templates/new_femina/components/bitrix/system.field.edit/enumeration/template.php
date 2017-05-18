<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2013 Bitrix
 */

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 */

$bWasSelect = false;

?><input type="hidden" name="<?=$arParams["arUserField"]["FIELD_NAME"]?>" value=""><?

if ($arParams["arUserField"]["SETTINGS"]["DISPLAY"] == "CHECKBOX")
{

	?><div class="checkbox-box"><?
	
	foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val)
	{
		$bSelected = in_array($key, $arResult["VALUE"]) && (
			(!$bWasSelect) ||
			($arParams["arUserField"]["MULTIPLE"] == "Y")
		);
		$bWasSelect = $bWasSelect || $bSelected;

		?><?if($arParams["arUserField"]["MULTIPLE"]=="Y"):?>
		<label>
			<input
				type="checkbox"
				value="<?echo $key?>"
				name="<?echo $arParams["arUserField"]["FIELD_NAME"]?>"
				<?echo ($bSelected? "checked" : "")?>>
			<span><?=$val?></span>
			</label>
		<?else:?>
		<label>
			<input
				type="radio"
				value="<?echo $key?>"
				name="<?echo $arParams["arUserField"]["FIELD_NAME"]?>"
				<?echo ($bSelected? "checked" : "")?>
			><span><?=$val?></span></label>
		<?endif;?><?
	}
	
	?></div><?
	
}
else
{
	?>
	
	<?
	if($arParams["arUserField"]["FIELD_NAME"] == "UF_OKRUG")
	{
		unset($arParams["arUserField"]["USER_TYPE"]["FIELDS"][""]);
	}
	?>
	
	<select
		class="bx-user-field-enum"
		name="<?=$arParams["arUserField"]["FIELD_NAME"]?>"
		<?if($arParams["arUserField"]["SETTINGS"]["LIST_HEIGHT"] > 1):?>
			size="<?=$arParams["arUserField"]["SETTINGS"]["LIST_HEIGHT"]?>"
		<?endif;?>
		<?if ($arParams["arUserField"]["MULTIPLE"]=="Y"):?>
			multiple="multiple"
		<?endif;?>
	>
	<?
	
	//prn($arParams);
	
	foreach ($arParams["arUserField"]["USER_TYPE"]["FIELDS"] as $key => $val)
	{
		$bSelected = in_array(strval($key), $arResult["VALUE"], true) && (
			(!$bWasSelect) ||
			($arParams["arUserField"]["MULTIPLE"] == "Y")
		);
		$bWasSelect = $bWasSelect || $bSelected;

		?><option value="<?echo $key?>"<?echo ($bSelected? " selected" : "")?>><?echo $val?></option><?
	}
	?></select><?
}
