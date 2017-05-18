<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Каталог продукции компании Фемина-Трейд");
$APPLICATION->SetPageProperty("keywords", "Каталог продукции компании Фемина-Трейд");
$APPLICATION->SetPageProperty("description", "Каталог продукции компании Фемина-Трейд");
$APPLICATION->SetTitle("Каталог Фемина Трейд");?> 



<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	SITE_TEMPLATE_ID == "new_femina" ? "catalog-root" : "structure", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "6",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"COUNT_ELEMENTS" => "Y",
		"TOP_DEPTH" => "2",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_USER_FIELDS" => array(
			0 => "UF_COLLECTION_COLOR",
			1 => "",
		),
		"SECTION_URL" => "/#SECTION_CODE_PATH#/",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"COMPONENT_TEMPLATE" => "catalog-root"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>