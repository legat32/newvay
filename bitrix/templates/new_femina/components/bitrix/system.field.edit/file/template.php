<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach (GetModuleEvents("main", "system.field.edit.file", true) as $arEvent)
{
	if (ExecuteModuleEventEx($arEvent, array($arResult, $arParams)))
		return;
}

?>


<div id="main_<?=$arParams["arUserField"]["FIELD_NAME"]?>">
<?
$postFix = ($arParams["arUserField"]["MULTIPLE"] == "Y" ? "[]" : "");
foreach ($arResult["VALUE"] as $res):
	?>
	<div class="fields files">
		<?
		$dbFile = CFile::GetByID($res);
		if($arFile = $dbFile->Fetch()) 
		{
			$file_url = "/".COption::GetOptionString("main", "upload_dir")."/".$arFile["SUBDIR"]."/".$arFile["FILE_NAME"];
			echo $file_url;
		}
		?>
		<input type="hidden" name="<?=$arParams["arUserField"]["~FIELD_NAME"]?>_old_id<?=$postFix?>" value="<?=$res?>" />
		<?=CFile::InputFile($arParams["arUserField"]["FIELD_NAME"], 0, $res, false, 0, "", "", 0, "", ' value="'.$res.'"', true, isset($arParams['SHOW_FILE_PATH']) ? $arParams['SHOW_FILE_PATH'] : true).
		'<br><a href="'.$file_url.'" target="_blank">'.
		CFile::ShowImage($res, 150, 150, null, '', false, 0, 0, 0, !empty($arParams['FILE_URL_TEMPLATE']) ? $arParams['FILE_URL_TEMPLATE'] : '').'</a>';
		?>
	</div>
	<?
endforeach;
?>
</div>

<hr/>

<?if ($arParams["arUserField"]["MULTIPLE"] == "Y" && $arParams["SHOW_BUTTON"] != "N"):?>
	<div style="display:none" id="main_add_<?=$arParams["arUserField"]["FIELD_NAME"]?>" class="fields files">
		<input type="hidden" name="<?=$arParams["arUserField"]["~FIELD_NAME"]?>_old_id[]" value="" />
		<?=CFile::InputFile($arParams["arUserField"]["FIELD_NAME"], 0, "")?>
	</div>
	<input type="button" style="background: #EEE !important; width:100px; color: blue;" value="Добавить файл" onClick="addElement('<?=$arParams["arUserField"]["FIELD_NAME"]?>', this)">
<?endif;?>
