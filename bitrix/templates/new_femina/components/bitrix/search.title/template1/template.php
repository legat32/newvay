<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);
?>
<?
if($arParams["SHOW_INPUT"] !== "N"):?>

	<form action="<?echo $arResult["FORM_ACTION"]?>">
		<input<?=strLen(trim($_REQUEST["q"])>0) ? "" : " class='empty_field'"?> id="<?echo $INPUT_ID?>" type="text" name="q" placeholder="НАЙТИ ТОВАР" value="<?=strLen(trim($_REQUEST["q"])>0) ? $_REQUEST["q"] : ""?>" size="40" maxlength="50" autocomplete="off" />&nbsp;<input name="s" id="btn_search" type="submit" value="Найти товар" />
	</form>

<?endif?>

<script type="text/javascript">
var jsControl = new JCTitleSearch({
	//'WAIT_IMAGE': '/bitrix/themes/.default/images/wait.gif',
	'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
	'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
	'INPUT_ID': '<?echo $INPUT_ID?>',
	'MIN_QUERY_LEN': 2
});
</script>
