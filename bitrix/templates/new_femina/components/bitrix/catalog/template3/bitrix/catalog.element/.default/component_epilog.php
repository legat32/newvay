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
	});
</script>