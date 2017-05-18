$(document).ready( function() {

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
		
		

	
	
		
		
});