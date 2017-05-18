<?
//echo "404";
//die();
?>


<div style="width:500px; height:250px; left:50%; top:50%; margin-left:-250px; margin-top:-150px; position:absolute; border:1px solid gray; padding:20px;">
<h1 align="center">Страница не найдена</h1>

<p>Вы можете воспользоваться одним из следующих вариантов:</p>
<ul>
<li>Перейдите на главную страницу сайта</li>
<li>Воспользуйтесь текстовым поиском по сайту</li>
<li>Перейдите на одну из страниц <a href="/catalog/">каталога</a> и выберите интересующую Вас продукцию</li>
</ul>
</div>

<?
die();






include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");  

$APPLICATION->SetTitle("Страница не найдена");

?>
<br/>
<p style="text-align: center; font-weight:bold; font-size:22px;">Страница не найдена</p>
<br/>
<p>Вы можете воспользоваться одним из следующих вариантов:</p>
<ul style="list-style: disc; margin-left:30px; line-height:22px;">
	<li>Перейдите на <a href="/">главную страницу сайта</a></li>
	<li>Воспользуйтесь текстовым поиском по сайту</li>
	<li>Перейдите на одну из страниц каталога и выберите интересующую Вас продукцию</li>
</ul>
<br/>
<hr/>
<?/*
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "structure", array(
	"IBLOCK_TYPE" => "1c_catalog",
	"IBLOCK_ID" => "6",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"COUNT_ELEMENTS" => "N",
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
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "N",
	"ADD_SECTIONS_CHAIN" => "Y"
	),
	false
);
*/
?>
<hr/>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>