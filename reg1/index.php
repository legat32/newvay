<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
//LocalRedirect("/reg/ooo.html");
?>

<?
$type = "";
$country = "";
if($_GET["type"] == "ooo") $type = "ooo";
if($_GET["type"] == "ip") $type = "ip";
if($_GET["type"] == "fiz") $type = "fiz";
if($_GET["country"] == "ru") $country = "ru";
if($_GET["country"] == "kz") $country = "kz";
if($_GET["country"] == "by") $country = "by";

if(empty($type))
	echo '<style>.select-block.type {display: none;}</style>';

if(!empty($type) && !empty($country))
	echo '<style>.select-block ul li {display: none;}</style>';

?>


<style>
.select-block {display: block; float: left; min-width:300px; margin-right:40px;}
.select-block i.fa {width: 30px; display: inline-block; text-align: center; cursor: pointer; font-size: 18px;}
.select-block ul {padding-left: 0px;}
.select-block ul li {margin:0; padding:3px 10px; list-style-type: none; cursor:pointer; text-decoration:underline;}
.select-block ul li:hover {background: #CCC; color: black;}
.select-block ul li.active {background:#b42e31; color:white; text-decoration:none; display:block;}
</style>

<script>
$(document).ready( function() {
	
	$(".select-block i.fa").on("click", function() {
		if($(this).hasClass("fa-caret-down")) {
			$(this).removeClass("fa-caret-down").addClass("fa-caret-up");
			$(this).closest(".select-block").find("ul li").show();
		} else {
			$(this).removeClass("fa-caret-up").addClass("fa-caret-down");
			$(this).closest(".select-block").find("ul li").hide();
			$(this).closest(".select-block").find("ul li.active").show();
		}
	});
	
	$(".select-block ul li").on("click", function() {
		if(!$(this).hasClass("active")) {
			$(this).parent("ul").find("li").removeClass("active");
			$(this).addClass("active");
			$(".select-block.type").show();
			if(($(".select-block.country ul li.active").length > 0) && ($(".select-block.type ul li.active").length > 0)) {
				var page = "//newvay.ru/reg1/?type=" + $(".select-block.type ul li.active").attr("id") + "&country=" + $(".select-block.country ul li.active").attr("id");
				document.location.href = page;
			}
		}
		return false;
	});
});
</script>

<div class="select-block country">
	<p>Выберите страну:<?if(!empty($country)):?> <i class="fa fa-caret-down"></i><?endif?></p>
	<ul>
		<li id="ru"<?=($country == "ru") ? " class='active'" : "";?>>Россия</li>
		<li id="kz"<?=($country == "kz") ? " class='active'" : "";?>>Казахстан</li>
		<li id="by"<?=($country == "by") ? " class='active'" : "";?>>Белоруссия</li>
	</ul>
</div>

<div class="select-block type">
	<p>Выберите тип сотрудничества:<?if(!empty($country)):?>  <i class="fa fa-caret-down"></i><?endif?></p>
	<ul>
		<li id="ooo"<?=($type == "ooo") ? " class='active'" : "";?>>Организация (оптовые цены)</li>
		<li id="ip"<?=($type == "ip") ? " class='active'" : "";?>>Индивидуальный предприниматель (оптовые цены)</li>
		<li id="fiz"<?=($type == "fiz") ? " class='active'" : "";?>>Физ.лицо (оптовые цены для физ.лиц)</li>
	</ul>
</div>

<div style="clear: both;"></div>

<?if(!empty($type) && !empty($country)):?>

	<?$APPLICATION->IncludeComponent("bitrix:main.register", "jur1", array(
		"SHOW_FIELDS" => array(
			0 => "NAME",
			1 => "SECOND_NAME",
			2 => "LAST_NAME",
			3 => "PERSONAL_CITY",
		),
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "LAST_NAME",
			2 => "PERSONAL_CITY",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			"UF_COMPANY_NAME", "UF_COMPANY_ADDRESS", "UF_INN", "UF_KPP", "UF_OGRN", "UF_CITY", "UF_OKRUG", "UF_ASSORTIMENT", "UF_BIZNES_TYPE", "UF_COMMENT"
		),
		"USER_PROPERTY_NAME" => " "
		),
		false
	);?>

<?endif?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>