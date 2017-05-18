<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($arResult["ID"] < 1) define("ERROR_404", 1);
?>

<script>
	$(".items_count.at-top span").text( $(".items_count.at-bottom span").text() );
</script>