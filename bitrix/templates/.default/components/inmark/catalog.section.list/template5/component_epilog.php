<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript">
$(document).ready( function() {

	var cur_lev = $("#accordion-1 li.active").attr("class");
	cur_lev = parseInt(cur_lev.substr(4, cur_lev.indexOf(' ')-4)); 
	
	$("#accordion-1 li.active.lev-"+cur_lev).show();
	$("#accordion-1 li.active.lev-"+cur_lev+" a").eq(0).css("background-color", "#DDD");
	$("#accordion-1 li.active ul li.lev-"+(cur_lev+1)).each(function() {$(this).show()});
	$("#accordion-1 li.active").closest("li.lev-"+(cur_lev-1)).find("ul li.lev-"+cur_lev).each(function() {$(this).show()});
	$("#accordion-1 li.active").closest("li.lev-"+(cur_lev-2)).find("ul li.lev-"+(cur_lev-1)).each(function() {$(this).show()});
	});

</script>