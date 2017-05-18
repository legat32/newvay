<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<p class="<?=$arParams["STYLE"]?>"><font><?=$arParams["MESSAGE"]?></font></p>

<script>
$(document).ready( function() {
	$(".errortext:first")
		.css("border-top", "5px solid #E04472")
		.css("padding-top", "10px")
		.css("background", "#FFCCCC url(/assets/images/ico_warning.png) no-repeat 15px 5px");
	$(".errortext:last")
		.css("border-bottom", "5px solid #E04472")
		.css("padding-bottom", "10px")
		.css("margin-bottom", "10px");
	});
</script>