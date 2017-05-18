<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои заявки");
?><?$APPLICATION->IncludeComponent("bitrix:form.result.list.my", ".default", array(
	"FORMS" => array(
		0 => "4",
		1 => "",
	),
	"NUM_RESULTS" => "10",
	"LIST_URL" => "my_result_list.php?WEB_FORM_ID=#FORM_ID#",
	"VIEW_URL" => "/personal/zayavka.php?WEB_FORM_ID=#FORM_ID#&RESULT_ID=#RESULT_ID#",
	"EDIT_URL" => ""
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>