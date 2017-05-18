<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?> 
<ul class="tab_nav"> 	
  <li><a href="/personal/" >Личные данные</a></li>
  <li><a href="/personal/orders.html?filter_history=Y" >Заказы</a></li>
  <li><a class="active" >Обращения</a></li>
  <li><a href="/personal/partner.html" >Сотрудничество</a></li>
 </ul>
 
<br />

<?$APPLICATION->IncludeComponent("bitrix:support.ticket", ".default", array(
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/",
	"TICKETS_PER_PAGE" => "50",
	"MESSAGES_PER_PAGE" => "20",
	"MESSAGE_MAX_LENGTH" => "70",
	"MESSAGE_SORT_ORDER" => "asc",
	"SET_PAGE_TITLE" => "Y",
	"SHOW_COUPON_FIELD" => "N",
	"SET_SHOW_USER_FIELD" => array(
	),
	"VARIABLE_ALIASES" => array(
		"ID" => "ID",
	)
	),
	false
);?>
 <?/*$APPLICATION->IncludeComponent("bitrix:support.ticket", "template2", array(
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/personal/",
	"TICKETS_PER_PAGE" => "50",
	"MESSAGES_PER_PAGE" => "20",
	"MESSAGE_MAX_LENGTH" => "70",
	"MESSAGE_SORT_ORDER" => "asc",
	"SET_PAGE_TITLE" => "Y",
	"SHOW_COUPON_FIELD" => "N",
	"SET_SHOW_USER_FIELD" => array(
	),
	"SEF_URL_TEMPLATES" => array(
		"ticket_list" => "index.php",
		"ticket_edit" => "#ID#.php",
	)
	),
	false
);*/?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>