$(document).ready( function() {

	
	
	// развораичвнаие/сворачивание списка цветов
	//alert($(".color_vars").height());
	/*
	var allcolorsh = 50;
	var colorvarsh = $(".color_vars").height();
	if( colorvarsh > allcolorsh ) {
		$(".color_vars").height(allcolorsh);
		$(".all-colors").show();
		}
	else {
		$(".all-colors").hide();
		}
	*/
	$(".all-colors").hide();


	// навешиваем обработчики для кликов по цветам
	$(".color_var").bind( "click", function() {
		//alert($(this).attr("class"));
		if($(this).hasClass("exists")) {
			$(".color_var").removeClass("active");
			$(this).addClass("active");
			correct_by_color();
			//alert($(".size_var.active").html());
			if(!$(".size_var.active").hasClass("exists")) $(".size_var.exists:first").click();
			show_price('color');
			}
		
		/*
		ЗАГОТОВКА ДЛЯ СМЕНЫ ФОТО ПО КЛИКУ
		
		var cc = $(this).find(".color_img").find("img").attr("alt");
		var ccode = cc.substr(0, cc.indexOf(" "));
		
		var find_img = false;
		$(".wrap_more .wrap .frame ul li a").each( function(index) {
			var ccc = $(this).attr("title");
			if((ccc.indexOf(ccode)>0)&&(!find_img)) {
				//alert($(this).next("span").text());
				var new_src = $(this).next("span").text();
				$(".item_img img").attr("src", new_src);
				find_img = true;
				}
			});
		*/	
		});
		
		
	// навешиваем обработчики для кликов по размерам
	$(".size_var").bind( "click", function() {
		if($(this).hasClass("exists")) {
			$(".size_var").removeClass("active");
			$(this).addClass("active");
			//correct_by_size();
			show_price('size');
			}
		});
	
	$(".color_var.exists:first").click();
		
	// подсветка существующих размеров при клике по цвету
	function correct_by_color() {
		var var_ar=Array();
		$(".offer_block").each( function(index) {
			var mas=$(this).attr("class").split(" ");
			for (var i = 0; i < mas.length; i++) {
				if(mas[i].indexOf("color_")>=0) var_color=mas[i].substr(6);
				if(mas[i].indexOf("size_")>=0) var_size=mas[i].substr(5);
				};
			if($(".color_var.active").hasClass(var_color)) var_ar.push(var_size);
			});
		$(".size_var").removeClass("exists");
		for (var i = 0; i < var_ar.length; i++) {
			$(".size_var").each( function(index) {
				if($(this).hasClass(var_ar[i])) 
					$(this).addClass("exists");
				});
			};
		};

	// вывод блока с ценой, наличием и кнопкой купить при выборе размера и цвета 
	function show_price(from) {
	
		$(".offer_block").hide();
		$(".offer_block").each( function(index) {
			
			var mas=$(this).attr("class").split(" ");

			for (var i = 0; i < mas.length; i++) {
				if(mas[i].indexOf("color_")>=0) var_color=mas[i].substr(6);
				if(mas[i].indexOf("size_")>=0) var_size=mas[i].substr(5);
				};
			
			if( ($(".color_var.active").hasClass(var_color)) && ($(".size_var.active").hasClass(var_size)) ) 
				$(".offer_block").eq(index).show();
				
			});
		}
		
	
	// Sly-галерея для MORE_PHOTO
	var $frame = $('#centered');
	var $wrap  = $frame.parent();
	$frame.sly({
		horizontal: 1,
		itemNav: 'centered',
		smart: 1,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: 1,
		scrollBar: $wrap.parent().find('.scrollbar'),
		scrollBy: 1,
		speed: 300,
		elasticBounds: 1,
		easing: 'easeOutExpo',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1
		});
		


	// ajax покупка
	
	$("input.btn_buy").live("click", function() {
		var forma = $(this).closest("form");
		var id = forma.find("input[name=id]").val();
		var q = forma.find("input[name=quantity]").val();		
		$.fancybox.open(
			{
				maxWidth: '480',
				maxHeight: '220',
				minHeight: '210',
				type: 'iframe',
				href : 'http:/ajax/basket.php?cmd=buy&id='+id+'&quantity='+q,
				afterClose : function() {				
					$("span.korz").load("/ajax/basket.php?cmd=refresh");
					}
			},
			{
				padding : 15   
			}
			);
		return false;
		});
		
		
	$('.fancybox-html').fancybox({
		'padding'			: 20,
		'margin'			: 20,
		'type'				: 'html',
		'content'			: '<h2 style="margin-top:0;">Ожидает проверки менеджером</h2><p>Наши менеджеры еще не проверили ваши регистрационные данные.<br/>По результатам проверки вы получите доступ к оптовым ценам и сообщение об этом на e-mail</p>'
		});
	
	
		
		
});