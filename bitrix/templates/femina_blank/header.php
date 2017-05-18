<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CUtil::InitJSCore();
CJSCore::Init(array("jquery"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />
	<?echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";?>
	<?
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);
	$APPLICATION->ShowHeadStrings();
	$APPLICATION->ShowHeadScripts();
//	$APPLICATION->AddHeadScript("/assets/js/jquery.cookie.js");
//	$APPLICATION->AddHeadScript("/assets/js/plugins.js");
//	$APPLICATION->AddHeadScript("/assets/js/sly.min.js");
//	$APPLICATION->AddHeadScript("/assets/fancybox/jquery.fancybox.js");
//	$APPLICATION->SetAdditionalCSS("/assets/fancybox/jquery.fancybox.css");
	?>
	<title><?$APPLICATION->ShowTitle()?></title>

</head>
<body>
<?$APPLICATION->ShowPanel();?>
