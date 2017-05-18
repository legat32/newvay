<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// удаляем отображаемый в данный момент товар из списка других товаров по коллекции
// сделано в javascript чтобы выводить перечень элементов кэшированный и удалять из него один элемент
// иначе выборка других моделей каждый раз подгрузит страницу
//prn($_SERVER["REQUEST_URI"]);

$url = $_SERVER["REQUEST_URI"];
if(strpos($_SERVER["REQUEST_URI"], "?") > 0)
{
	$t = explode("?", $_SERVER["REQUEST_URI"]);
	$url = $t[0];
} 
//echo $url; 
?>

<script>
$(document).ready( function() {
	$("ul.menu li").removeClass("root-item-selected");
	$("ul.menu li ul li").removeClass("item-selected");
	$("a[href='<?=$url?>']").parent("li").addClass("item-selected");
	$("a[href='<?=$url?>']").parent("li").parent("ul").parent("li").addClass("root-item-selected");
//	var obj_li = $("#sly-section-centered").find(".other_<?=$arResult["ID"]?>");
//	$("#sly-section-centered").sly('remove' , obj_li );
//	alert( $("a[href='<?=$url?>']").attr("href") );
	//alert("456");
	});
//alert("12");
</script>