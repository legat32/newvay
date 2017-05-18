$(document).ready( function() {



	// переключение основной картинки из превьюшек
	$("body").on("click", ".photo-slide a", function(event){
		// определеим откуда вызван click
		var width_referer = event.target.width;
		var width_img = $(this).find("img").width();
		if(width_referer == width_img) var fancyfire = false; else fancyfire = true;
		// по умолчанию запускаем fancybox
		// а если надо только переключить основную картинку, то
		if(!fancyfire) {
			var href = $(this).attr('href');
			var title = $(this).attr('title');
			$(".full-image .item_img a").attr('href', href).attr('title', title);
			$(".full-image .item_img a img").attr('src', href).attr('alt', title);	
			return false;
			}
	});
	
	

	
	// запуск fancybox при клике по основному изображению (путем имитации клика по нужной превьюхе)
	$("body").on("click", ".full-image .item_img a", function(event){
		$(".photo-slide.slick-current a.fancybox").click();
		return false;
	});
	
	
	

	
	
	// подгрузка фото без аякса при клике на цвет
	$(".color_var").on( "click", function() {
		var code = $(this).find(".color_img").attr("title");
		code = $.trim(code.toUpperCase());

		// очистим slick слайдер
		for(var i=0; i<100; i++) $('.more-photo').slick('slickRemove',false);
		$('.more-photo').slick('slickRemove',0);
		
		// добавим подходящие фото из массива picts
		var first = 1000;
		for(var i=0; i<picts.length; i++) {
			//prompt('q', code+' = '+picts[i].COLOR);
			if(code == picts[i].COLOR) {
				//alert('in');
				$('.more-photo').slick('slickAdd','<div class="photo-slide"><a title="'+picts[i].DESCRIPTION+'" class="fancybox" data-fancybox-group="group" href="'+picts[i].ORIGINAL+'"><img alt="'+picts[i].DESCRIPTION+'" src="'+picts[i].PREVIEW+'"/></a></div>');	
				if(first>=1000) first=i;
			}
			
		};
		
		// в основное фото внесем первое
		$(".full-image .item_img a img").attr('src', picts[first].MAIN);
		$(".full-image .item_img a img").attr('alt', picts[first].DESCRIPTION);
		$(".full-image .item_img a").attr('title', picts[first].DESCRIPTION);

	});
	


	


	
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
	// открываем первый цвет
	$(".color_var").removeClass("active");
	$(".color_var:first").addClass("active");
	correct_by_color();
	//alert($(".size_var.active").html());
	if(!$(".size_var.active").hasClass("exists")) $(".size_var.exists:first").click();
	show_price('color');
		
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
				$(".offer_block").eq(index).fadeIn(1000);
				
			});
		}
		
		
	// скролл картинок изделия
	$('.more-photo').slick({
		vertical:true,
		verticalSwiping:true,
		draggable:true,
		swipeToSlide:true,
		dots: true,
        arrows: false,
        speed: 300,
        infinite: false,
        //centerMode:true,
        focusOnSelect: true,
       	//autoplay:true,
        //autoplaySpeed:5000,
        //pauseOnHover:true,
        slidesToShow: 3,
  		slidesToScroll: 1,
  		responsive: [
			{
			  breakpoint: 992,
			  settings: {
				vertical:false,
				verticalSwiping:false,
				draggable:true,
				swipeToSlide:true,
				dots: true,
				arrows: false,
				speed: 300,
				//centerMode:false,
				focusOnSelect: true,
				//autoplay:true,
				//autoplaySpeed:5000,
			   // pauseOnHover:true,
			  }
			}]
		}).on("mousewheel", function (event) {
			event.preventDefault();
			if ((event.deltaX > 0 || event.deltaY < 0)&&($('.more-photo .slick-dots .slick-active').index()<$('.more-photo .slick-dots li').length)) {
				$(this).stop(true,true).slick('slickNext');
			} 
			else if ((event.deltaX < 0 || event.deltaY > 0)&&($('.more-photo .slick-dots .slick-active').index()!=0)) {
				$(this).stop(true,true).slick('slickPrev');
				}
			});

			
			
	$('.more-photo').css({'opacity':'1'});

	
	
	// скролл цветов изделия
	
	var $frame = $('#smart');
	var $wrap  = $frame.parent();
	$frame.sly({
		horizontal: 0,
		itemNav: 'basic',
		smart: 1,
		activateOn: 'click',
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		scrollBar: $wrap.parent().find('.scrollbar'),
		elasticBounds: 1,
		speed: 300,
		easing: 'easeOutExpo',
		activatePageOn: 'click',
		scrollBy: 1,
		startAt: 1,  
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,
		});


			if($('.scrollbar').height()>$('.scrollbar .handle').height()){
				$('.scrollbar').css({'opacity':'1'});
			}
	
	

	
	
	// ajax покупка
	
	$("input.btn_buy").on("click", function() {
		var forma = $(this).closest("form");
		var id = forma.find("input[name=id]").val();
		var q = forma.find("input[name=quantity]").val();		
		$.fancybox.open(
			{
				maxWidth: '480',
				maxHeight: '220',
				minHeight: '210',
				type: 'iframe',
				href : 'http://newvay.ru/ajax/basket.php?cmd=buy&id='+id+'&quantity='+q,
				afterClose : function() {				
					$("span.korz").load("http://newvay.ru/ajax/basket.php?cmd=refresh");
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