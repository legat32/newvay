<?if(!isset($arResult['DATA'])){?>
<?if(!empty($arResult["ERRORS"])) echo "<font color='red'>".implode("<br>",$arResult["ERRORS"])."</font><br />";?>
	<?=GetMessage("EEI_CHF")?>:
	<form name="import_settings" method="post" enctype="multipart/form-data">
	<?=CFile::InputFile("IMAGE_ID", 20, $str_IMAGE_ID)?>
	<input type="hidden" name="config_import" value="Y" />
	<input type="submit" value="<?=GetMessage("EEI_DOWNLOAD")?>" />
	</form>
<?}elseif($_REQUEST['config_import']=="Y"){?>
	<form name="import_settings" method="post" enctype="multipart/form-data">
		<input type="hidden" name="start_import" value="Y" />
		<input type="hidden" name="FILE_ID" value="<?=$arResult["FILE_ID"]?>" />
		<?=GetMessage("EEI_CFT")?>:
			<table>
			<?foreach(current($arResult["DATA"]) as $k=>$pName){?>
			<tr><td><?=$pName?></td><td><select name="PROP[<?=$k?>]">
			<option value=""><?=GetMessage("EEI_SEL")?></option>
			<?foreach($arResult["SELECT"] as $c=>$v){
				if($v==$pName||$v." "==$pName) $sel=" selected='selected'";else $sel="";
				echo "<option value='".$c."'".$sel.">".$v."</option>";
			}
			?>
			</select></td></tr>
			<?}?>
		</table>
		<input type="submit" value="<?=GetMessage("EEI_NEXT")?>" />
	</form>
<?}else{?>
<?=GetMessage("EEI_EUPD")?>:<?=count($arResult["UPDATED"])?><br />
<?=GetMessage("EEI_EADD")?>:<?=count($arResult["ADDED"])?>
<?}?>