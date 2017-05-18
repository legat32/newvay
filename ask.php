<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Задать вопрос");
?><?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"ask",
	Array(
		"SEF_MODE" => "N",
		"WEB_FORM_ID" => "1",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "ask_succesfull.php?blank=Y",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"VARIABLE_ALIASES" => Array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID"
		)
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>