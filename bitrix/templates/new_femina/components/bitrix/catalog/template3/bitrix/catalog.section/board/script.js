$(document).ready( function() {
	
//	$(".item_img").on( "mouseenter", function() {
//		$(this).find("div").show();
//		});
	
//	$(".item_img").on( "mouseleave", function() {
		//$(this).find("div").hide();
//		});
	
	
	$('.fancybox-html').fancybox({
		'padding'			: 20,
		'margin'			: 20,
		'type'				: 'html',
		'content'			: '<h2 style="margin-top:0;">Ожидает проверки менеджером</h2><p>Наши менеджеры еще не проверили ваши регистрационные данные.<br/>По результатам проверки вы получите доступ к оптовым ценам и сообщение об этом на e-mail</p>'
		});
	
	});