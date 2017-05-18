<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//if($USER->GetID() == 1):?>
	<?
	$APPLICATION->IncludeComponent(
		"inmark:catalog.section.list", 
		"template5", 
		array(
			"VIEW_MODE" => "LINE",
			"SHOW_PARENT_NAME" => "N",
			"IBLOCK_TYPE" => "1c_catalog",
			"IBLOCK_ID" => "6",
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"SECTION_URL" => "/#SECTION_CODE_PATH#/",
			"COUNT_ELEMENTS" => "Y",
			"TOP_DEPTH" => "3",
			"SECTION_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"SECTION_USER_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"ADD_SECTIONS_CHAIN" => "Y",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"CACHE_GROUPS" => "N"
		),
		false
	);
	?>
<?/*else:?>
	<?
	$APPLICATION->IncludeComponent(
		"inmark:catalog.section.list", 
		"template4", 
		array(
			"VIEW_MODE" => "LINE",
			"SHOW_PARENT_NAME" => "N",
			"IBLOCK_TYPE" => "1c_catalog",
			"IBLOCK_ID" => "6",
			"SECTION_ID" => "",
			"SECTION_CODE" => "",
			"SECTION_URL" => "/#SECTION_CODE_PATH#/",
			"COUNT_ELEMENTS" => "Y",
			"TOP_DEPTH" => "3",
			"SECTION_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"SECTION_USER_FIELDS" => array(
				0 => "",
				1 => "",
			),
			"ADD_SECTIONS_CHAIN" => "Y",
			"CACHE_TYPE" => "N",
			"CACHE_TIME" => "3600",
			"CACHE_GROUPS" => "N"
		),
		false
	);
	?>
<?endif*/?>



<div class="sideblock" id="usl_pokupki"> 	
  <div class="sideblock_title">Условия покупки</div>
   <ul> 		
    <li><a href="/pokupka.html" >Как сделать заказ</a></li>   		
    <li><a href="/partneram/" >Условия сотрудничества</a></li>
   	</ul>
 </div> 
<?/*?>
<div class="sideblock" id="left_shop"> 	
  <div class="sideblock_title">Розничный магазин</div>
 	<a href="/magazin/" ><img alt="Розничный магазин NEWVAY Москва, Измайловское шоссе, дом 71А, Торговый комплекс AST" src="/upload/shop.jpg"  /></a> 	
  <p class="left-address">Москва, Измайловское шоссе, дом 71А, Торговый комплекс &quot;AST&quot;</p>
 	<a href="/magazin/" >Подробнее</a> 	
  <br />
  <br />
 </div>
 <?*/?>
<div class="sideblock" id="random_image"> 	
  <div class="sideblock_title">Случайное фото</div>
 	<?$APPLICATION->IncludeComponent(
	"inmark:photo.random",
	"leftside",
	Array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCKS" => array(0=>"6",),
		"DETAIL_URL" => "/#SECTION_CODE_PATH#/#ELEMENT_CODE#.html",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "5",
		"CACHE_GROUPS" => "Y",
		"PARENT_SECTION" => ""
	)
);?> </div>
