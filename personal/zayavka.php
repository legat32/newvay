<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("zayavka");
?><?$APPLICATION->IncludeComponent(
	"bitrix:form.result.view",
	"",
	Array(
		"SEF_MODE" => "N",
		"RESULT_ID" => $_REQUEST[RESULT_ID],
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_STATUS" => "Y",
		"EDIT_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => ""
	),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>