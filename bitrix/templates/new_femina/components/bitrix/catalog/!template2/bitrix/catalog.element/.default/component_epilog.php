<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
// удаляем отображаемый в данный момент товар из списка других товаров по коллекции
// сделано в javascript чтобы выводить перечень элементов кэшированный и удалять из него один элемент
// иначе выборка других моделей каждый раз подгрузит страницу
?>

<script>
$(document).ready( function() {
	var obj_li = $("#sly-section-centered").find(".other_<?=$arResult["ID"]?>");
	$("#sly-section-centered").sly('remove' , obj_li );
	
	// если на странице какой-нибудь цвет помечен классом color_to_show, а размер size_to_show то кликаем по указанным слоям
	// (означает что в URL был указан XML_ID торгового предложения для включения по умолчанию)
	$(".color_to_show").click();
	$(".size_to_show").click();
	
	});
</script>